<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Admin\PostCategory;

use App\Models\PostCategory;
use Illuminate\Validation\ValidationException;

final class PostCategoryStoreUseCase
{
    public function run(PostCategory $postCategory): PostCategory
    {
        if ($postCategory->isDuplicateSlug()) {
            throw ValidationException::withMessages([
                'slug' => ['入力されたスラグ名は既に登録されています。'],
            ]);
        }

        $maxOrder = PostCategory::query()
            ->max('order');

        $postCategory->order = ++$maxOrder;

        $postCategory->save();

        return $postCategory;
    }
}
