<?php

namespace App\Livewire;

use Livewire\Component;

class Experience extends Component
{
    public function render()
    {
        return view('livewire.experience')
            ->layout('components.layouts.app', ['title' => 'Experience']);
    }
}

