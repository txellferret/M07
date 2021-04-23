<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function notes() {
        //return $this->hasMany('App\Note');
        return $this->hasMany(Note::class);
    }
}
