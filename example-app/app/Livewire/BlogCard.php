<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BlogCard extends Component
{
    public $blogs;

    public function mount()
    {
        set_time_limit(60);
        $this->fetch();
    }

    public function fetch()
    {   
        set_time_limit(60);
        Log::info('in fetch');
        try {
            $response = Http::timeout(-1)->get(route('blog.show'));
            $this->blogs = $response->json();
            Log::info('Response status code: ' . $response->status());
            Log::info('Response headers: ' . json_encode($response->headers()));
            Log::info('Response body: ' . $response->body());
        } catch (\Exception $e) {
            // Handle error
            Log::error($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.blog-card', ['blogs' => $this->blogs]);
    }

    
}