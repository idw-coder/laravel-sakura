<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
