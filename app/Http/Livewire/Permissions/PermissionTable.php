<?php

namespace App\Http\Livewire\Permissions;

use WireUi\Traits\Actions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class PermissionTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;
    use Actions;

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
                ->showPerPage()
                ->showRecordCount(),
        ];
    }
    public function rowDeleteConfirm($id)
    {
        $this->notification()->confirm([
            'title' => 'Apakah anda yakin ?',
            'description' => 'Hapus Permission?',
            'acceptLabel' => 'Ya, Hapus!',
            'rejectLabel' => 'Batalkan',
            'method' => 'rowDelete',
            'params' => [
                'key' => $id,
            ],
        ]);
    }

    public function rowDelete($id)
    {
        $roles  = Permission::find($id);
        dd($roles);
        $permission=Permission::find($id);
        if ($roles->isEmpty())
        {
            $permission->delete();
            $this->notification()->send([
                'title' => 'Hapus Permission',
                'description' => 'Anda berhasil menghapus permission!',
                'icon' => 'success',
            ]);
        }
        
        $this->notification()->send([
            'title' => 'Hapus Perizinan',
            'description' => 'Gagal menghapus ' . $organization->name . ' masih ada relasi!',
            'icon' => 'error',
        ]);
        return;
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
     * @return Builder<\Spatie\Permission\Models\Permission>
     */
    public function datasource(): Builder
    {
        return Permission::query();
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
            ->addColumn('created_at_formatted', fn (Permission $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('Name', 'name'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
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
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Permission Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('edit')
                ->render(function (Permission $permission) {
                    return Blade::render(<<<HTML
                    <x-button primary icon="pencil" wire:click="editPermission('$permission->id')" />
                    HTML);
                }),

            Button::add('delete')
                ->render(function (Permission $permission) {
                    return Blade::render(<<<HTML
                    <x-button negative icon="trash" wire:click="rowDeleteConfirm('$permission->id')"  />
                    HTML);
                }),

        ];
    }
    public function editPermission($id)
    {
        $this->emit('editPermission', $id);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Permission Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($permission) => $permission->id === 1)
                ->hide(),
        ];
    }
    */
}
