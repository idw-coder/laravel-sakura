<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * このロールを持つユーザー（1対多の関係）
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * 管理者ロールかどうかを判定
     */
    public function isAdmin(): bool
    {
        return $this->code === 'admin';
    }

    /**
     * 一般ユーザーロールかどうかを判定
     */
    public function isGeneral(): bool
    {
        return $this->code === 'general';
    }
}
