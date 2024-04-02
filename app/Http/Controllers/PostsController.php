<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Posts;
use App\Http\Validators\CreatePostsValidator;
use App\Http\Validators\UpdatePostsValidator;
use App\Support\Message;

class PostsController extends Controller
{
    protected Posts $model;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Posts $model)
    {
        $this->model = $model;
    }

    public function getPosts(Request $request)
    {

        $input = $request->all();

        $with = ['like', 'share', 'view', 'comment'];

        $data = $this->model->search($input, $with, $limit = null);

        return $data;
    }

    public function createPosts(Request $request)
    {
        $input = $request->all();
        (new CreatePostsValidator())->validate($input);

        try {
            DB::beginTransaction();
            $data = $this->model->create($input, $id = null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 401);
        }
        return Message::resMsg($data, "Tạo bài viết thành công", 200);
    }

    public function updatePosts(Request $request, $id)
    {
        $input = $request->all();
        (new UpdatePostsValidator())->validate($input);
        try {
            DB::beginTransaction();
            $data = $this->model->create($input, $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 401);
        }
        return Message::resMsg($data, "Cập nhật bài viết thành công", 200);
    }
}
