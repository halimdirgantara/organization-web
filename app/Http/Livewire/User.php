<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use App\Models\Organization;
use Livewire\WithFileUploads;
use App\Models\user as UserModel;

class User extends Component
{
    use Actions;
    use WithFileUploads;

    public $createForm = false;
    public $editForm = false;
    protected $listeners = ['editUser'];
    public $user;

    public $userId;
    public $photoProfile;
    public $name;
    public $nip;
    public $nik;
    public $phone;
    public $address;
    public $email;
    public $password;
    public $organizationId;
    public $is_online;
    public $is_active;

    public $mask;

    public $selected  = '';

    public $organizationList;

    public function render()
    {
        return view('livewire.user');
    }

    public function getInputMask()
    {
        return '###### ###### # ###';
    }

    public function toggleForm()
    {
        $this->createForm = !$this->createForm;
        if ($this->editForm) {
            $this->editForm = false;
            $this->createForm = false;
        }
        $organizationList = Organization::select('id', 'name')->get();
        $this->organizationList = $organizationList;
    }

    public function toggleEditForm()
    {
        $this->editForm = !$this->editForm;
    }

    public function mount()
    {
        if ($this->user) {
            $this->userId = $this->user->user_id;
            $this->photoProfile = $this->user->profile_photo_url;
            $this->name = $this->user->name;
            $this->nip = $this->user->nip;
            $this->nik = $this->user->nik;
            $this->phone = $this->user->phone;
            $this->address = $this->user->address;
            $this->password = $this->user->password;
            $this->organizationId = $this->user->organization_id;
            $this->isOnline = $this->user->is_online;
            $this->isActive = $this->user->is_active;
        }
    }

    public function confirmSave()
    {
        $this->notification()->confirm([
            'title' => 'Apakah anda yakin ?',
            'description' => 'Simpan Pengguna?',
            'acceptLabel' => 'Ya, Simpan',
            'rejectLabel' => 'Batalkan',
            'method' => 'save',
            'params' => 'Tersimpan',
        ]);
    }

    public function fileUploaded()
    {
        $this->validate([
            'photo' => 'image|max:250', // 1MB Max
        ]);

        $this->photoProfile = $this->storeTemporaryUploadedFile($this->photoProfile);
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'nik' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'organization_id' => 'required|integer',
            'is_online' => 'required|boolean',
            'is_active' => 'required|boolean',
        ]);

        $data['name'] = Str::slug($data['name']);

        if ($this->photoProfile) {
            $photoProfileName = $data['slug'] . '.' . $this->photoProfile->getClientOriginalExtension();
            $this->logo->storeAs('public/profile-photo', $photoProfileName);
            $data['profile_photo_url'] = 'storage/profile-photo/' . $photoProfileName;
        }

        UserModel::create($data);

        $this->createForm = false;
        $this->reset(
            'name',
            'nip',
            'nik',
            'phone',
            'address',
            'email',
            'password',
            'organization_id',
            'is_online',
            'is_active'
        );
        $this->notification([
            'title' => 'Tambah Pengguna',
            'description' => $data['name'] . ' Berhasil Disimpan!',
            'icon' => 'success',
        ]);
        $this->emit('newUser');
    }
}
