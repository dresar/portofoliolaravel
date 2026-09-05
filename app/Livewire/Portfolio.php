<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class Portfolio extends Component
{
    public $selectedCategory = 'all';

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function render()
    {
        $query = Project::query();
        
        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }
        
        $projects = $query->orderBy('order')->get();
        $categories = Project::distinct()->pluck('category');
        
        return view('livewire.portfolio', [
            'projects' => $projects,
            'categories' => $categories,
        ])->layout('components.layouts.app', ['title' => 'Portfolio']);
    }
}

