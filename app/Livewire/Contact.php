<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $subject = '';
    public $message = '';
    public $success = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'nullable|max:255',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->success = true;
        $this->reset(['name', 'email', 'subject', 'message']);
        
        session()->flash('message', 'Pesan Anda berhasil dikirim! Terima kasih.');
    }

    public function render()
    {
        return view('livewire.contact')
            ->layout('components.layouts.app', ['title' => 'Contact']);
    }
}

