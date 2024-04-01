<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{

    protected $table = "views";

    protected $fillable = [
        "id",
        "user_id",
        "posts_id",
        "created_at"
    ];

    public function posts(){
        return $this->belongsTo(Posts::class);
    }
}
