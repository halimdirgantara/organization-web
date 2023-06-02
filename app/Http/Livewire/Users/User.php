<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use App\Models\Organization;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\user as UserModel;
use Illuminate\Http\UploadedFile;

class User extends Component
{
    use Actions;
    use WithFileUploads;

    public $createForm = false;
    public $editForm = false;
    protected $listeners = ['editUser'];
    public $user;

    public $user_id;
    public $photoProfile;
    public $name;
    public $nip;
    public $nik;
    public $phone;
    public $address;
    public $email;
    public $password;
    public $organization_id;
    public $is_online;
    public $is_active;

    public $selected  = '';

    public $organizationList;

    public function render()
    {
        return view('livewire.user');
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

    public function editUser($id)
    {
        $this->editForm = true;
        $this->user = UserModel::findOrFail($id);
        $this->mount();
    }

    public function mount()
    {
        if ($this->user) {
            $this->user_id = $this->user->id;
            $this->photoProfile = $this->user->profile_photo_url;
            $this->name = $this->user->name;
            $this->nip = $this->user->nip;
            $this->nik = $this->user->nik;
            $this->phone = $this->user->phone;
            $this->email = $this->user->email;
            $this->address = $this->user->address;
            $this->organization_id = $this->user->organization_id;
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
            'password' => 'string|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'organization_id' => 'required|integer',
        ]);

        $data['password'] = bcrypt('Sekadau$23');
        if ($this->password)
        {
            $data['password'] = bcrypt($this->password);
        }

        $data['is_active'] = TRUE;
        if ($this->photoProfile) {
            $photoName = Str::slug($data['name']);
            $photoProfileName = $photoName . '.' . $this->photoProfile->getClientOriginalExtension();
            $this->photoProfile->storeAs('public/profile-photo', $photoProfileName);
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
            'organization_id',
        );
        $this->notification([
            'title' => 'Tambah Pengguna',
            'description' => $data['name'] . ' Berhasil Disimpan!',
            'icon' => 'success',
        ]);
        $this->emit('newUser');
    }

    public function update()
    {
        $user = UserModel::find($this->user_id);
        if(empty($user))
        {
            $this->notification([
                'title' => 'Perbarui Pengguna',
                'description' => 'Gagal Diperbarui! Data tidak ditemukan.',
                'icon' => 'error',
            ]);
            return;
        }

        $data = $this->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'nik' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => ['required','email',Rule::unique('users')->ignore($this->user_id)],
            'organization_id' => 'required|integer',
        ]);

        if ($this->password)
        {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->photoProfile && is_a($this->photoProfile, UploadedFile::class))
        {
            $photoName = Str::slug($data['name']);
            $photoProfileName = $photoName . '.' . $this->photoProfile->getClientOriginalExtension();
            $this->photoProfile->storeAs('public/profile-photo', $photoProfileName);
            $data['profile_photo_url'] = 'storage/profile-photo/' . $photoProfileName;
        }

        $user->update($data);

        $this->editForm = false;
        $this->reset(
            'name',
            'nip',
            'nik',
            'phone',
            'address',
            'email',
            'organization_id',
        );
        $this->notification([
            'title' => 'Perbarui Pengguna',
            'description' => $data['name'] . ' Berhasil Disimpan!',
            'icon' => 'success',
        ]);
        $this->emit('newUser');

    }



}
