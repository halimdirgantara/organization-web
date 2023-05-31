<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithFileUploads;

class Tag extends Component
{
    use Actions;
    use WithFileUploads;
    
    public $createForm = false;
    public $editForm = false;
    public $tag;
    public $tag_id;
    public $name;
    public $slug;
    public $organization_id;
    public $created_id;

    public function render()
    {
        return view('livewire.tags.tag');
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

    public function mount()
    {
        if ($this->tag) {
            $this->tag_id = $this->tag->id;
            $this->name = $this->tag->name;
        }
    }
}
