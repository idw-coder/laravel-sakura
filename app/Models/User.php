<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_id',
        'qualification_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * このユーザーの役割（多対1の関係）
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * このユーザーの資格（多対1の関係）
     */
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    /**
     * 管理者かどうかを判定
     */
    public function isAdmin(): bool
    {
        return $this->role && $this->role->isAdmin();
    }

    /**
     * 一般ユーザーかどうかを判定
     */
    public function isGeneral(): bool
    {
        return $this->role && $this->role->isGeneral();
    }

    /**
     * 資格者かどうかを判定
     */
    public function isQualified(): bool
    {
        return $this->qualification && $this->qualification->isQualified();
    }

    /**
     * 補助者かどうかを判定
     */
    public function isAssistant(): bool
    {
        return $this->qualification && $this->qualification->isAssistant();
    }

    /**
     * 認証IDの名前を返す
     * getAuthIdentifierName() は、「どのカラムでユーザーを検索するか」をLaravelに教えるためのメソッド。
     * Auth::attempt() の裏で呼ばれてる。
     */
    public function getAuthIdentifierName(): string
    {
        return 'admin_id';
    }
}
