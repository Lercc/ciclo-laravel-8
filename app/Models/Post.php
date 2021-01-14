<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 1 -----------------------------------> 1
    //   UN POST PERTENECE A SOLO UN USUARIO
    //
    // * <----------------------------------- 1
    //      UN USUARIO TIENE MUCHOS POST
    //
    //  RELACIÓN MUCHOS A UNO - MANY TO ONE   OR  (BELONGS TO)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //GET FORMAT
    public function getTitleUppercaseAttribute() {
        return strtoupper($this->title);
    }
    public function getTitleSentenceFormatAttribute() {
        return ucfirst($this->title);
    }

    //SET FORMAT
    public function setTitleAttribute($value) {
        $this->attributes['title'] = strtolower($value);
    }
    
}
