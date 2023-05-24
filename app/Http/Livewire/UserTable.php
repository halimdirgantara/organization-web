<?php

namespace App\Http\Livewire;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

use PowerComponents\LivewirePowerGrid\Button;

use PowerComponents\LivewirePowerGrid\Column;

use PowerComponents\LivewirePowerGrid\Exportable;use PowerComponents\LivewirePowerGrid\Filters\Filter;

use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;

use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\Rules\RuleActions;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;use WireUi\Traits\Actions;

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
            ->addColumn('organization_abbreviation', fn(User $model) => $model->organization->abbreviation)
            ->addColumn('organization_name', fn(User $model) => $model->organization->name)
            ->addColumn('organization_id', fn(User $model) => $model->organization->id)
            ->addColumn('is_online')
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

            Column::make('Online ?', 'is_online')
                ->toggleable(),

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

    /*
    public function actions(): array
    {
    return [
    Button::make('edit', 'Edit')
    ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
    ->route('user.edit', function(\App\Models\User $model) {
    return $model->id;
    }),

    Button::make('destroy', 'Delete')
    ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
    ->route('user.destroy', function(\App\Models\User $model) {
    return $model->id;
    })
    ->method('delete')
    ];
    }
     */

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
