<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Qualification;

class UserController extends Controller
{
    /**
     * ユーザー一覧表示
     */
    public function index()
    {
        $users = User::with(['role', 'qualification'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * 新規作成フォーム表示
     */
    public function create()
    {
        $roles = Role::all();
        $qualifications = Qualification::all();

        return view('users.create', compact('roles', 'qualifications'));
    }

    /**
     * 新規作成処理
     */
    public function store(Request $request)
    {
        // TODO: バリデーション処理を追加予定
        // TODO: 作成処理を追加予定
    }

    /**
     * 詳細表示
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 編集フォーム表示
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $qualifications = Qualification::all();

        return view('users.edit', compact('user', 'roles', 'qualifications'));
    }

    /**
     * 編集処理
     */
    public function update(Request $request, User $user)
    {
        // TODO: バリデーション処理を追加予定
        // TODO: 更新処理を追加予定
    }

    /**
     * 削除処理
     */
    public function destroy(User $user)
    {
        // TODO: 削除処理を追加予定
    }
}
