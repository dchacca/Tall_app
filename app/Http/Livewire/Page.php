<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Page extends Component
{
    public $state = ['list', 'create', 'edit', 'show'];
    public function render()
    {
        return view('livewire.page');
    }
}