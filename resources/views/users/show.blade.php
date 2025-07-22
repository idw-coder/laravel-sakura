<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザー詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- 戻るボタン -->
                    <div class="mb-6">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            ← 一覧に戻る
                        </a>
                    </div>

                    <!-- ユーザー詳細情報 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->id }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Admin ID</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->admin_id ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">名前</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">メールアドレス</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">役割</label>
                            <p class="mt-1 text-sm text-gray-900">
                                @if($user->role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $user->role->code === 'admin' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $user->role->name }}
                                </span>
                                @else
                                <span class="text-gray-400">未設定</span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">資格</label>
                            <p class="mt-1 text-sm text-gray-900">
                                @if($user->qualification)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $user->qualification->code === 'qualified' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->qualification->name }}
                                </span>
                                @else
                                <span class="text-gray-400">未設定</span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">登録日</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('Y-m-d H:i') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">更新日</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                    <!-- 備考メモ -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">備考メモ</label>
                        <div class="mt-1 p-3 border border-gray-300 rounded-md bg-gray-50 min-h-[100px]">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $user->memo ?? '備考はありません' }}</p>
                        </div>
                    </div>

                    <!-- アクションボタン -->
                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            編集
                        </a>
                        <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" onsubmit="return confirm('本当に削除しますか？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                削除
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>