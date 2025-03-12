<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Posts;

class PostsCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.posts-card');
    }
}
