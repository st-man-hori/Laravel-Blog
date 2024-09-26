<?php

declare(strict_types=1);

namespace App\UseCases\Admin\PostCategory;

use App\Models\PostCategory;

final class EditAction
{
    public function handle(int $id): PostCategory
    {
        $postCategory = PostCategory::query()
            ->findOrFail($id);

        return $postCategory;
    }
}
