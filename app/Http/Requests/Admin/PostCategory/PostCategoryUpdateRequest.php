<?php

namespace App\Http\Requests\Admin\PostCategory;

use App\Models\PostCategory;
use Illuminate\Foundation\Http\FormRequest;

class PostCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
        ];
    }

    public function makePostCategory(int $id): PostCategory
    {
        $postCategory = new PostCategory($this->validated());
        $postCategory->id = $id;
        return $postCategory;
    }
}
