<?php

namespace App\Http\Validators;

use App\Http\Validators\BaseValidator;

class CreatePostsValidator extends BaseValidator
{
    protected function rules()
    {
        return [
            'id' => 'exists:posts, id',
            'author_id' => 'integer',
            'title' => 'required|max:255',
            'content' => 'required|max:10000',
            'tags' => 'nullable|array',
            'category' => 'nullable|max:255'
        ];
    }

}
