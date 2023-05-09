<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Organization as OrganizationModel;

class Organization extends Component
{
    use Actions;
    use WithFileUploads;
    public $showForm = FALSE;

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
    }

    public function confirmSave()
    {
        $this->notification()->confirm([
            'title'       => 'Apakah anda yakin ?',
            'description' => 'Simpan Organisasi?',
            'acceptLabel' => 'Ya, Simpan',
            'rejectLabel' => 'Batalkan',
            'method'      => 'save',
            'params'      => 'Tersimpan',
        ]);
    }

    public function fileUploaded()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $this->logo = $this->storeTemporaryUploadedFile($this->logo);
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required',
            'abbreviation' => 'required|max:5',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'logo' => 'nullable|image|max:1024',
        ]);

        $data['slug'] = Str::slug($data['name']);

        if (array_key_exists('logo', $data)) {
            $data['logo'] = $data['logo']->store('public/organizations');
        }

        // OrganizationModel::create($data);

        dd('sukses');

        $this->showForm = false;
        $this->reset('name', 'abbreviation', 'description', 'address', 'latitude', 'longitude', 'email', 'phone', 'fax', 'logo');
    }
}
