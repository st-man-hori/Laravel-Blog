<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCategory\PostCategoryIndexRequest;
use App\UseCases\Admin\PostCategory\PostCategoryIndexUseCase;
use App\UseCases\Admin\PostCategory\PostCategoryStoreUseCase;
use App\Http\Requests\Admin\PostCategory\PostCategoryStoreRequest;
use App\UseCases\Admin\PostCategory\PostCategoryEditUseCase;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

final class PostCategoryController extends Controller
{
    /**
     * 記事カテゴリ一覧
     */
    public function index(PostCategoryIndexRequest $request, PostCategoryIndexUseCase $useCase): View
    {
        $result = $useCase->handle($request->keyword);

        return view('admin.post_category.index', [
            'postCategories' => $result['postCategories'],
            'searchRequests' => $result['searchRequests'],
        ]);
    }

    /**
     * 記事カテゴリ作成
     */
    public function create(): View
    {
        return view('admin.post_category.create');
    }

    /**
     * 記事カテゴリ作成
     */
    public function store(PostCategoryStoreRequest $request, PostCategoryStoreUseCase $useCase)
    {
        $postCategory = $request->makePostCategory();

        try {
            $result = $useCase->handle($postCategory);
            return redirect()->route('admin.post-category.index')
                ->with('success', "「{$result->name}」の記事カテゴリを作成しました。");
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.post-category.create')
                ->withInput()
                ->with('error', '記事カテゴリの作成に失敗しました。');
        }
    }

    public function edit(int $id, PostCategoryEditUseCase $useCase): View
    {
        $postCategory = $useCase->handle($id);

        return view('admin.post_category.edit', [
            'postCategory' => $postCategory
        ]);
    }

    public function update(int $id)
    {
        
    }
}
