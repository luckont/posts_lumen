<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'author_id',
        'title',
        'content',
        'created_at',
        'created_by',
        'update_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function create($input, $id)
    {

        $now = date('Y-m-d H:i:s', time());
        $author_id = (new User)->getUserId(); //currentId


        if (!$id) {

            $newPosts = new Posts();

            $newPosts->fill([
                'author_id' => $author_id,
                'title' => $input['title'],
                'content' => $input['content'],
                'created_at' => $now,
                'created_by' => $author_id
            ]);

            $newPosts->save();

        } else {

            $newPosts = Posts::find($id);

            $author = $newPosts->author_id;

            if (!$newPosts) {
                return response()->json("Posts not found !", 401);
            }

            if (empty($author_id) || $author !== $author_id) {
                return response()->json("You are not authenticated !", 401);
            }

            $newPosts->title = isset($input['title']) ? $input['title'] : $newPosts->title;
            $newPosts->content = isset($input['content']) ? $input['content'] : $newPosts->content;
            $newPosts->updated_by = $author;
            $newPosts->updated_at = $now;

            $newPosts->save();
        }

        return $newPosts;
    }

    public function search($input, $with = [], $limit = null)
    {
        $query = Posts::query();

        if (!empty($input)) {
            foreach ($input as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        }
        if ($limit) {
            return $query->with($with)->paginate($limit);
        }
        return $query->with($with)->get();
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function share()
    {
        return $this->hasMany(Share::class);
    }

    public function view()
    {
        return $this->hasMany(View::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
