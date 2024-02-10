<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ["title", "slug", "thumbnail", "body", "user_id", "active", "published_at", "meta_title", "meta_description"];

    protected $casts = [
      "published_at" => "datetime"
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
//    handle body
    public function shortBody($words = 30) : string {
        return Str::words(strip_tags($this->body), $words);
    }
//    handle date
    public function getFormattedDate() : string {
        return $this->published_at->format("F dS, Y");
    }

//    handle thumbnail
    public function getThumbnail() : string {
        if(Str::startsWith($this->thumbnail, "https")) {
            return $this->thumbnail;
        }
        return asset("storage/{$this->thumbnail}");
    }

    //calc read time
    public function humanReadTime() : string
    {
        $words = Str::wordCount(strip_tags($this->body));
        $minutes = ceil($words / 200);

        return "{$minutes} min, {$words} words";
    }
}
