<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Rules\RuleActions;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;use WireUi\Traits\Actions;
use PowerComponents\LivewirePowerGrid\Exportable;use PowerComponents\LivewirePowerGrid\Filters\Filter;

final class UserTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;
    use Actions;

    protected $listeners = ['newUser'];

    public function newUser()
    {
        $this->emit('pg:eventRefresh-default');
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
     */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage(10)
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Header Setup
    |--------------------------------------------------------------------------
    | Setup Table's header bulk action
    |
     */
    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->caption(__('Hapus'))
                ->class('
                    text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center mr-1 mb-1 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900
                ')
                ->emit('bulkDeleteEvent', [])
        ];
    }

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), [
                'eventX',
                'eventY',
                'bulkDeleteEvent',
                'newUser',
            ]);
    }

    public function bulkDeleteEvent(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->notification()->send([
                'title' => 'Hapus Pengguna',
                'description' => 'Anda belum memilih pengguna!',
                'icon' => 'warning',
            ]);
            return;
        }
        $ids = implode(', ', $this->checkboxValues);
        $this->notification()->confirm([
            'title' => 'Apakah anda yakin ?',
            'description' => 'Hapus Pengguna?',
            'acceptLabel' => 'Ya, Hapus!',
            'rejectLabel' => 'Batalkan',
            'method' => 'bulkDelete',
            'params' => 'Terhapus!',
        ]);
    }

    public function bulkDelete()
    {
        foreach ($this->checkboxValues as $item) {
            $user = User::findOrFail($item);
            if ($user->relatedModel()->exists()) {
                $this->notification()->send([
                    'title' => 'Hapus Pengguna',
                    'description' => 'Gagal menghapus ' . $user->name . ' masih ada relasi!',
                    'icon' => 'error',
                ]);
                return;
            }
            $user->delete();
        }
        $this->notification()->send([
            'title' => 'Hapus Organisasi',
            'description' => 'Anda berhasil menghapus pengguna!',
            'icon' => 'success',
        ]);
    }

    public function rowDeleteConfirm($slug)
    {
        $this->notification()->confirm([
            'title' => 'Apakah anda yakin ?',
            'description' => 'Hapus Organisasi?',
            'acceptLabel' => 'Ya, Hapus!',
            'rejectLabel' => 'Batalkan',
            'method' => 'rowDelete',
            'params' => [
                'key' => $slug,
            ],
        ]);
    }

    public function rowDelete($userId)
    {
        $organization = Organization::findOrFail($userId);
        // if ($organization->relatedModel()->exists()) {
        //     $this->notification()->send([
        //         'title' => 'Hapus Organisasi',
        //         'description' => 'Gagal menghapus ' . $organization->name . ' masih ada relasi!',
        //         'icon' => 'error',
        //     ]);
        //     return;
        // }
        $organization->delete();
        $this->notification()->send([
            'title' => 'Hapus Pengguna',
            'description' => 'Anda berhasil menghapus pengguna!',
            'icon' => 'success',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
     */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        //TODO make list by role and organization
        $users = User::query()->with('organization');
        return $users;
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
     */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
     */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')

        /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn(User $model) => strtolower(e($model->name)))

            ->addColumn('nip')
            ->addColumn('phone')
            ->addColumn('email')
            ->addColumn('organization_name', fn(User $model) => $model->organization->name)
            ->addColumn('organization_id', fn(User $model) => $model->organization->id)
            ->addColumn('is_online')
            ->addColumn('is_online', function (User $model) {
                if ($model->is_online == true) {
                    return '<button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 3.636a1 1 0 010 1.414 7 7 0 000 9.9 1 1 0 11-1.414 1.414 9 9 0 010-12.728 1 1 0 011.414 0zm9.9 0a1 1 0 011.414 0 9 9 0 010 12.728 1 1 0 11-1.414-1.414 7 7 0 000-9.9 1 1 0 010-1.414zM7.879 6.464a1 1 0 010 1.414 3 3 0 000 4.243 1 1 0 11-1.415 1.414 5 5 0 010-7.07 1 1 0 011.415 0zm4.242 0a1 1 0 011.415 0 5 5 0 010 7.072 1 1 0 01-1.415-1.415 3 3 0 000-4.242 1 1 0 010-1.415zM10 9a1 1 0 011 1v.01a1 1 0 11-2 0V10a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </button>';
                } else {
                    return '<button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3.707 2.293a1 1 0 00-1.414 1.414l6.921 6.922c.05.062.105.118.168.167l6.91 6.911a1 1 0 001.415-1.414l-.675-.675a9.001 9.001 0 00-.668-11.982A1 1 0 1014.95 5.05a7.002 7.002 0 01.657 9.143l-1.435-1.435a5.002 5.002 0 00-.636-6.294A1 1 0 0012.12 7.88c.924.923 1.12 2.3.587 3.415l-1.992-1.992a.922.922 0 00-.018-.018l-6.99-6.991zM3.238 8.187a1 1 0 00-1.933-.516c-.8 3-.025 6.336 2.331 8.693a1 1 0 001.414-1.415 6.997 6.997 0 01-1.812-6.762zM7.4 11.5a1 1 0 10-1.73 1c.214.371.48.72.795 1.035a1 1 0 001.414-1.414c-.191-.191-.35-.4-.478-.622z" />
                                </svg>
                            </button>';
                }
            })
            ->addColumn('is_active')
            ->addColumn('created_at_formatted', fn(User $model) => Carbon::parse($model->created_at)->diffForHumans());
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
     */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nama', 'name')
                ->sortable()
                ->searchable(),

            Column::make('NIP', 'nip')
                ->searchable(),

            Column::make('WA', 'phone')
                ->searchable(),

            Column::make('Email', 'email')
                ->searchable(),

            Column::make('Organisasi', 'organization_name')
                ->sortable()
                ->searchable(),

            Column::make('Online ?', 'is_online'),

            Column::make('Aktif ?', 'is_active')
                ->toggleable(),

            Column::make('Dibuat', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('nip')->operators(['contains']),
            Filter::inputText('nik')->operators(['contains']),
            Filter::inputText('phone')->operators(['contains']),
            Filter::inputText('address')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            // Filter::inputText('organization')->operators(['contains']),
            Filter::select('organization_name', 'organization_id')
                ->dataSource(Organization::all())
                ->optionValue('id')
                ->optionLabel('abbreviation'),
            Filter::boolean('is_online')->label('ya', 'tidak'),
            Filter::boolean('is_active')->label('ya', 'tidak'),
        ];
    }

    //TODO add role
    public function onUpdatedToggleable($id, $field, $value): void
    {
        User::query()->find($id)->update([
            $field => $value,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
     */

    /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('edit')
                ->render(function (User $user) {
                    return Blade::render(<<<HTML
                    <x-button primary icon="pencil" wire:click="editUser('$user->id')" />
                    HTML);
                }),

            Button::add('delete')
                ->render(function (User $user) {
                    return Blade::render(<<<HTML
                    <x-button negative icon="trash" wire:click="rowDeleteConfirm('$user->id')"  />
                    HTML);
                }),

        ];
    }

    public function editUser($id)
    {
        $this->emit('editUser', $id);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
     */

    /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
public function actionRules(): array
{
return [

//Hide button edit for ID 1
Rule::button('edit')
->when(fn($user) => $user->id === 1)
->hide(),
];
}
 */
}
