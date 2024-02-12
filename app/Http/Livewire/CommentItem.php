<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;
    public Post $post;

    public function mount(Post $post, Comment $comment) : void
    {
        $this->comment = $comment;
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.comment-item');
    }

    //delete comment
    public function deleteComment() : void
    {
        /**
         * @var int $id
         */
        $id = $this->comment->id;
        $this->comment->delete();

        $this->emitUp("commentDeleted", $id);
    }
}
