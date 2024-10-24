<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'id_accounts',
        'parent_id',
        'status',
    ];

    protected $table = 'comments';

    public function account(): BelongsTo
    {
        return $this->belongsTo(accounts::class, 'id_accounts');
    }
    // Một bình luận có thể có nhiều trả lời (replies)
    public function replies()
    {
        return $this->hasMany(comments::class, 'parent_id')->with('replies'); // Đệ quy để lấy tất cả các replies
    }

    // Một bình luận có thể là con của một bình luận khác
    public function parent()
    {
        return $this->belongsTo(comments::class, 'parent_id');
    }
}
