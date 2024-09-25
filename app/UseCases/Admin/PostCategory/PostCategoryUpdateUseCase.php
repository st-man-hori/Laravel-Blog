<?php

declare(strict_types=1);

namespace App\UseCases\Admin\PostCategory;

use App\Models\PostCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class PostCategoryUpdateUseCase
{
    public function handle(PostCategory $postCategory): PostCategory
    {
        if ($postCategory->isDuplicateSlugExcludeById($postCategory->id)) {
            throw ValidationException::withMessages([
                'slug' => ['入力されたスラグ名は既に登録されています。'],
            ]);
        }

        DB::beginTransaction();
        try {
            $postCategory->update();
            DB::commit();
            return $postCategory;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
