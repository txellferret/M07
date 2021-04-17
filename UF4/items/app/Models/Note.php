<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    //fields fillable with mass create method.
    protected $fillable = ['content'];
 
    public function item() {
        return $this->belongsTo(Item::class);
    }
}
