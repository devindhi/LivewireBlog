<?php

namespace App\Livewire;

use Livewire\Component;

class CreateBlog extends Component
{

    public $title;
    public $content;
    public $imagePath;
    public $userName;

  

    protected $rules = [

        'title' => 'required|string|max:255',
        'content' => 'required|string',
        

    ];

    public function render()
    {
        return view('livewire.create-blog');
    }
}
