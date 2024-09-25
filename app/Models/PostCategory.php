<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * スラグの重複チェック
     */
    public function isDuplicateSlug(): bool
    {
        return self::query()
            ->where('slug', $this->slug)
            ->exists();
    }

    /**
     * 指定のID以外のスラグの重複チェック
     */
    public function isDuplicateSlugExcludeById(int $id): bool
    {
        return self::query()
            ->where('slug', $this->slug)
            ->where('id', '!=', $id)
            ->exists();
    }

    /**
     * 次の並び順
     *
     * 新規作成時は、最大の並び順 + 1とするため
     */
    public function nextOrder(): int
    {
        $maxOrder = self::query()
            ->max('order');

        return ++$maxOrder;
    }
}
