<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class CommentCreate extends Component
{
    public string $comment = "";
    public Post $post;

    public function mount(Post $post) : void
    {
        $this->post = $post;
    }
    public function createComment()
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        //check user
        if(!auth()->check())
        {
            return to_route("login");
        }

        //check email (verify or not)
        if(!$user->hasVerifiedEmail()) {
            return to_route("verification.notice");
        }

        //after check
        // create comment
        $comment = Comment::create([
           "comment" => $this->comment,
            "user_id" => auth()->id(),
            "post_id" => $this->post->id
        ]);

        $this->comment = '';
        $this->emitUp("commentCreated", $comment->id);
    }

    public function render() : View
    {
        return view('livewire.comment-create');
    }
}
