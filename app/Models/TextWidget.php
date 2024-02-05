<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TextWidget extends Model
{
    use HasFactory;

    protected $fillable = ["key", "title", "content", "image", "active"];

    //method for get title bu key name
    public static function getTitle(string $key) : string
    {
        $widget = Cache::get("text-widget-{$key}", function () use ($key) {
            return TextWidget::query()->where("key", "=", $key)
                ->where("active", "=", 1)
                ->first();
        });

        return $widget->title ?? "";
    }

    //method for get content by key name
    public static function getContent(string $key) : string
    {
        $widget = Cache::get("text-widget-{$key}", function () use($key) {
            return TextWidget::query()->where("key", "=", $key)
                ->where("active", "=", 1)
                ->first();
        });

        return $widget->content ?? "";
    }

    //method for get image by key name
    public static function getImage(string $key) : string
    {
        $widget = Cache::get("text-widget-{$key}", function () use($key) {
            return TextWidget::query()->where("key", "=", $key)
                ->where("active", "=", 1)
                ->first();
        });

        return $widget->image ?? "";
    }
}
