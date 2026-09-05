<?php

namespace App\Livewire;

use Livewire\Component;

class Skills extends Component
{
    public function render()
    {
        return view('livewire.skills')
            ->layout('components.layouts.app', ['title' => 'Skills']);
    }
}

