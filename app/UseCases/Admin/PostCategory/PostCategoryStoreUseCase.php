<?php

declare(strict_types=1);

namespace App\UseCases\Admin\PostCategory;

use App\Models\PostCategory;
use Illuminate\Validation\ValidationException;

final class PostCategoryStoreUseCase
{
    public function handle(PostCategory $postCategory): PostCategory
    {
        if ($postCategory->isDuplicateSlug()) {
            throw ValidationException::withMessages([
                'slug' => ['入力されたスラグ名は既に登録されています。'],
            ]);
        }

        $postCategory->order = $postCategory->nextOrder();

        $postCategory->save();

        return $postCategory;
    }
}
