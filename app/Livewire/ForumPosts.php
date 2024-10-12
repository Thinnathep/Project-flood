<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ForumPost;

class ForumPosts extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.forum-posts', [
            'posts' => ForumPost::latest()->paginate(10),
        ]);
    }
}
