<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * この資格を持つユーザー（1対多の関係）
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * 資格者かどうかを判定
     */
    public function isQualified(): bool
    {
        return $this->code === 'qualified';
    }

    /**
     * 補助者かどうかを判定
     */
    public function isAssistant(): bool
    {
        return $this->code === 'assistant';
    }
}
