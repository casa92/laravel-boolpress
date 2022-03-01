<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts() {
        
        // relazione one to many, ad ogni categoria corrispondono più post
        return $this->hasMany('App\Post');
    }
}
