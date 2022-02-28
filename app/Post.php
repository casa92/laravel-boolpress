<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug'
    ];
    // logiga relativa al database
    // crea slug unico con finale progressivo (-1,-2,-3,..)
    public static function getUniqueSlug($title) {
        $slug = Str::slug($title);
        $slug_basic = $slug;

        $post_found = Post::where('slug', '=', $slug)->first();
        
        $counter = 1;
        while ($post_found) {
            $slug = $slug_basic . '-' . $counter;
            $post_found = Post::where('slug', '=', $slug)->first();
            $counter++;
        }

        return $slug;
    }


    protected $table = 'posts';
}
