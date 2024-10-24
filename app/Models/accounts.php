<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class accounts extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'username',
        'password',
        'name',
        'birdthday',
        'img',
        'islike',
        'status',
    ];
    // các trường được phép cập nhật

    protected $table = 'accounts';
    public function comments(): HasMany
    {
        return $this->HasMany(comments::class, 'id_accounts', 'id');
    }
}
