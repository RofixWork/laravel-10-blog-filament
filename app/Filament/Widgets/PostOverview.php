<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use App\Models\UpvoteDownVote;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    protected static string $view = 'filament.widgets.post-overview';
    protected int | string | array $columnSpan = 3;

    public ?Model $record = null;

    protected function getViewData(): array
    {
        return [
          "viewCount" => PostView::query()->where("post_id", "=", $this->record?->id)->count(),
            'upvotes' => UpvoteDownVote::query()->where('post_id', $this->record?->id)
                ->where("is_upvote", 1)->count(),
            'downvotes' => UpvoteDownVote::query()->where('post_id', $this->record?->id)
                ->where("is_upvote", 0)->count(),
        ];
    }
}
