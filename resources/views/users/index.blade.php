<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- ユーザー数表示 -->
                    <div class="mb-6">
                        <p class="text-sm text-gray-600">
                            全 {{ $users->count() }} 名のユーザー
                        </p>
                    </div>

                    <!-- ユーザー一覧テーブル -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Admin ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">名前</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">メール</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">資格</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">役割</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">登録日</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2 text-sm">{{ $user->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm">
                                        {{ $user->admin_id ?? '-' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm font-medium">
                                        {{ $user->name }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm">
                                        {{ $user->email }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm">
                                        @if($user->qualification)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $user->qualification->code === 'qualified' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $user->qualification->name }}
                                        </span>
                                        @else
                                        <span class="text-gray-400">未設定</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $user->role->code === 'admin' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $user->role->name }}
                                        </span>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">
                                        {{ $user->created_at->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($users->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">ユーザーが見つかりませんでした。</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>