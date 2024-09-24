<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCategory\PostCategoryIndexRequest;
use App\Domain\UseCases\Admin\PostCategory\PostCategoryIndexUseCase;
use Illuminate\View\View;

final class PostCategoryController extends Controller
{
    /**
     * 記事カテゴリ一覧
     */
    public function index(PostCategoryIndexRequest $request, PostCategoryIndexUseCase $useCase): View
    {
        $result = $useCase->run($request->keyword);

        return view('admin.post_category.index', [
            'postCategories' => $result['postCategories'],
            'searchRequests' => $result['searchRequests'],
        ]);
    }

    public function create(): View
    {
        
    }
}
