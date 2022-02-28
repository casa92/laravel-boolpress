<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public function user() {

        // elongsTo da per scontato che la foreign key è nometabella_id, se no dovrà essere specificata come secondo argomento
        return $this->belongsTo('App\User');
    }

    protected $table = 'user_info';
}
