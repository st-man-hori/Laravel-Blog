<?php

declare(strict_types=1);

namespace App\UseCases\Admin\PostCategory;

use App\Models\PostCategory;

final class IndexAction
{
    public function handle(?string $keyword)
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
