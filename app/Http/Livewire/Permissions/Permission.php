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
}
