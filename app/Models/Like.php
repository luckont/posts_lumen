<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = "likes";

    protected $fillable = [
        "id",
        "user_id",
        "posts_id",
        "created_at"
    ];

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }

    // public function like($user_id, $id)
    // {

    //     $existingLike = Likes::where('user_id', $user_id)->where('posts_id', $id)->first();

    //     if ($existingLike) {
    //         return response()->json("You have liked this posts", 401);
    //     }

    //     $data = new Likes();

    //     $data->fill([
    //         "user_id" => $user_id,
    //         "posts_id" => $id,
    //         "created_at" => date('Y-m-d H:i:s', time())
    //     ]);

    //     $data->save();

    //     return response()->json("You have liked this posts", 200);
    // }

    // public function unlike($user_id, $id)
    // {

    //     $existingLike = Likes::where('user_id', $user_id)->where('posts_id', $id)->first();

    //     if (!$existingLike) {
    //         return response()->json("You not have liked this posts", 401);
    //     }

    //     $existingLike->delete();

    //     return response()->json("You have unlike this posts", 200);
    // }
}
