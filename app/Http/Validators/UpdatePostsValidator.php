<?php

namespace App\Http\Validators;

use App\Http\Validators\BaseValidator;

class UpdatePostsValidator extends BaseValidator
{
    protected function rules()
    {
        return [
            'id' => 'exists:posts, id',
            'author_id' => 'integer',
            'title' => 'nullable|max:255',
            'content' => 'nullable|max:10000',
            'tags' => 'nullable|array',
            'category' => 'nullable|max:255'
        ];
    }
}
