<?php
namespace App\View\Components;

use Illuminate\View\Component;

class CommentSection extends Component
{
    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('components.comment-section');
    }
}
