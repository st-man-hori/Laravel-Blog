<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Admin\PostCategory;

use App\Models\PostCategory;

final class PostCategoryIndexUseCase
{
    public function run(?string $keyword)
    {
        $postCategories = PostCategory::query()
            // フリーワード検索
            ->when(true, function ($query) use ($keyword) {
                if ($keyword !== null) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('slug', 'like', '%' . $keyword . '%');
                }
            })
            ->latest()
            ->paginate();

        $searchRequests = [
            'keyword' => $keyword,
        ];

        return [
            'postCategories' => $postCategories,
            'searchRequests' => $searchRequests
        ];
    }
}
