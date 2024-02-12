<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;
    public Collection $postComments;
    //listeners
    protected $listeners = [
      "commentCreated" => "commentCreated",
        "commentDeleted" => "commentDeleted"
    ];

    public function mount(Post $post) : void
    {
        $this->post = $post;
        $this->postComments = Comment::query()
            ->where("post_id", $this->post->id)
            ->orderByDesc("created_at")
            ->get();
    }
    public function render() : View
    {
        return view('livewire.comments');
    }

    //comment created method
    public function commentCreated(int $commentId) : void
    {
        $comment = Comment::query()->where("post_id", $this->post->id)
            ->where("id", $commentId)
            ->first();

        $this->postComments = $this->postComments->prepend($comment);
    }

    //commentDeleted
    public function commentDeleted(int $commentId) : void
    {
        $this->postComments = $this->postComments->reject(fn($comment) => $comment->id === $commentId);
    }
}
