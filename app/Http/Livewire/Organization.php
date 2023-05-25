<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Organization as OrganizationModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Organization extends Component
{
    use Actions;
    use WithFileUploads;

    public $showForm = false;
    public $editForm = false;
    protected $listeners = ['editOrganization'];
    public $organization;

    public $org_id;
    public $name;
    public $abbreviation;
    public $description;
    public $address;
    public $latitude;
    public $longitude;
    public $email;
    public $phone;
    public $fax;
    public $logo;

    public function render()
    {
        return view('livewire.organization');
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if ($this->editForm) {
            $this->editForm = FALSE;
            $this->showForm = FALSE;
        }
    }

    public function toggleEditForm()
    {
        $this->editForm = !$this->editForm;
    }

    public function editOrganization($slug)
    {
        $this->editForm = true;
        $this->organization = OrganizationModel::where('slug', $slug)->first();
        $this->mount();
    }

    public function mount()
    {
        if ($this->organization) {
            $this->org_id = $this->organization->id;
            $this->name = $this->organization->name;
            $this->abbreviation = $this->organization->abbreviation;
            $this->description = $this->organization->description;
            $this->address = $this->organization->address;
            $this->latitude = $this->organization->latitude;
            $this->longitude = $this->organization->longitude;
            $this->email = $this->organization->email;
            $this->phone = $this->organization->phone;
            $this->fax = $this->organization->fax;
        }
    }

    public function confirmSave()
    {
        $this->notification()->confirm([
            'title' => 'Apakah anda yakin ?',
            'description' => 'Simpan Organisasi?',
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

        $this->logo = $this->storeTemporaryUploadedFile($this->logo);
    }

    public function update()
    {
        $organization = OrganizationModel::find($this->org_id);
        if(empty($organization))
        {
            $this->notification([
                'title' => 'Perbarui Organisasi',
                'description' => 'Gagal Diperbarui! Data tidak ditemukan.',
                'icon' => 'error',
            ]);
            return;
        }

        $data = $this->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'fax' => 'nullable',
        ]);
        $data['slug'] = Str::slug($data['name']);

        if ($this->logo) {
            $logoName = $data['slug'] . '.' . $this->logo->getClientOriginalExtension();
            $this->logo->storeAs('public/logo', $logoName);
            $data['logo'] = 'storage/logo/' . $logoName;
        }

        $organization->update($data);

        $this->editForm = false;
        $this->reset('name', 'abbreviation', 'description', 'address', 'latitude', 'longitude', 'email', 'phone', 'fax', 'logo');
        $this->notification([
            'title' => 'Perbarui Organisasi',
            'description' => $data['slug'] . ' Berhasil Diperbarui!',
            'icon' => 'success',
        ]);
        $this->emit('newOrganization');

    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'fax' => 'nullable',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if ($this->logo) {
            $logoName = $data['slug'] . '.' . $this->logo->getClientOriginalExtension();
            $this->logo->storeAs('public/logo', $logoName);
            $data['logo'] = 'storage/logo/' . $logoName;
        }

        OrganizationModel::create($data);

        $this->showForm = false;
        $this->reset('name', 'abbreviation', 'description', 'address', 'latitude', 'longitude', 'email', 'phone', 'fax', 'logo');
        $this->notification([
            'title' => 'Tambah Organisasi',
            'description' => $data['slug'] . ' Berhasil Disimpan!',
            'icon' => 'success',
        ]);
        $this->emit('newOrganization');
    }
}
