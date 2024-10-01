<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCategory\PostCategoryIndexRequest;
use App\UseCases\Admin\PostCategory\IndexAction;
use App\UseCases\Admin\PostCategory\StoreAction;
use App\Http\Requests\Admin\PostCategory\PostCategoryStoreRequest;
use App\Http\Requests\Admin\PostCategory\PostCategoryUpdateRequest;
use App\UseCases\Admin\PostCategory\EditAction;
use App\UseCases\Admin\PostCategory\UpdateAction;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

final class PostCategoryController extends Controller
{
    /**
     * 記事カテゴリ一覧
     */
    public function index(PostCategoryIndexRequest $request, IndexAction $action): View
    {
        $result = $action->handle($request->keyword);

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
    public function store(PostCategoryStoreRequest $request, StoreAction $action)
    {
        $postCategory = $request->makePostCategory();

        try {
            $result = $action->handle($postCategory);

            Alert::toast("ID:{$result}の記事カテゴリを作成しました。", 'success');
            return redirect()->route('admin.post-category.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            report($e);
            Alert::toast('記事カテゴリの作成に失敗しました。', 'error');
            return redirect()->route('admin.post-category.create')->withInput();
        }
    }

    public function edit(int $id, EditAction $action): View
    {
        $postCategory = $action->handle($id);

        return view('admin.post_category.edit', [
            'postCategory' => $postCategory
        ]);
    }

    public function update(int $id, PostCategoryUpdateRequest $request, UpdateAction $action)
    {
        $postCategory = $request->makePostCategory($id);
        try {
            $postCategoryId = $action->handle($postCategory);

            Alert::toast("ID:{$postCategoryId}の記事カテゴリを更新しました。", 'success');
            return redirect()->route('admin.post-category.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());
        } catch (Exception $e) {
            report($e);
            Alert::toast('記事カテゴリの更新に失敗しました。', 'error');
            return redirect()->route('admin.post-category.edit', $id)->withInput();
        }
    }
}
