<?php

namespace App\Http\Livewire\Permissions;

use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends Component
{
    use Actions;
    use WithFileUploads;

    public $createForm = false;
    public $editForm = false;
    protected $listeners = ['editPermission'];
    public $permission;

    public $name;

    public function render()
    {
        return view('livewire.permissions.permission');
    }

    public function toggleForm()
    {
        $this->createForm = !$this->createForm;
        if ($this->editForm) {
            $this->editForm = false;
            $this->createForm = false;
        }
    }
    
    public function toggleEditForm()
    {
        $this->editForm = !$this->editForm;
    }

    public function editPermission($id)
    {
        $this->editForm = true;
        $this->permission = PermissionModel::findOrFail($id);
        $this->mount();
    }

    public function mount()
    {
        if ($this->permission) {
            $this->permission_id = $this->permission->id;
            $this->name = $this->permission->name;
        }
    }

    public function confirmSave()
    {
        $this->notification()->confirm([
            'title' => 'Apakah anda yakin ?',
            'description' => 'Simpan Perizinan?',
            'acceptLabel' => 'Ya, Simpan',
            'rejectLabel' => 'Batalkan',
            'method' => 'save',
            'params' => 'Tersimpan',
        ]);
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
        ]);

        PermissionModel::create($data);

        $this->createForm = false;
        $this->reset(
            'name',
        );

        $this->notification([
            'title' => 'Tambah Perizinan',
            'description' => $data['name'] . ' Berhasil Disimpan!',
            'icon' => 'success',
        ]);

        //Buat refresh table
        $this->emit('newUser');
    }
    public function update()
    {
        $permission=PermissionModel::find($this->permission->id);
        if(empty($permission))
        {
            $this->notification([
                'title' => 'Perbarui Permission',
                'description' => 'Gagal Diperbarui! Data tidak ditemukan.',
                'icon' => 'error',
            ]);
            return;
        }
        $data = $this->validate([
            'name' => 'required',
        ]);
        $permission->update($data);

        $this->editForm = false;
        $this->reset('name');
        $this->notification([
            'title' => 'Perbarui Permission',
            'description' => $data['name'] . ' Berhasil Diperbarui!',
            'icon' => 'success',
        ]);
        $this->emit('newPermission');
    }
}
