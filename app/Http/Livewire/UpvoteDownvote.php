<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class UpvoteDownvote extends Component
{
    public Post $post;
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $upvotes = \App\Models\UpvoteDownVote::query()->where("is_upvote", "=", 1)
            ->where("post_id", "=", $this->post->id)
            ->count();
        $downvotes = \App\Models\UpvoteDownVote::query()->where("is_upvote", "=", 0)
            ->where("post_id", "=", $this->post->id)
            ->count();

        $hasUpvote = null;

        if(auth()->check())
        {
            $model = \App\Models\UpvoteDownVote::query()
                ->where('post_id', "=", $this->post->id)
                ->where("user_id", "=", auth()->id())
                ->first();
            if($model)
            {
                $hasUpvote = (bool)$model->is_upvote;
            }
        }

        return view('livewire.upvote-downvote', compact("upvotes", "downvotes", "hasUpvote"));
    }

    public function handleUpVoteDownVote($upvote = true)
    {
        //get user
        /**
         * @var User $user
         */
        $user = auth()->user();
        //check user (login or not)
        if(!auth()->check()) {
            return to_route("login");
        }
        //check user (verify email or not)
        if(!$user->hasVerifiedEmail()) {
            return to_route("verification.notice");
        }

         //get vote
        /**
         * @var \App\Models\UpvoteDownVote $model
         */
        $model = \App\Models\UpvoteDownVote::query()
            ->where("post_id", "=", $this->post->id)
            ->where("user_id", "=", auth()->id())
            ->first();
        if(!$model)
        {
            \App\Models\UpvoteDownVote::create([
               "is_upvote" => $upvote,
                "post_id" => $this->post->id,
                'user_id' => auth()->id()
            ]);
            return;
        }

        if($upvote && $model->is_upvote || !$upvote && !$model->is_upvote) {
            $model->delete();
        }else {
            $model->is_upvote = $upvote;
            $model->save();
        }

    }
}
