
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー管理画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h1 class="text-2xl font-bold">ユーザー管理画面</h1>
        </x-slot>

        <div class="container mt-5">
            <!-- 成功メッセージの表示 -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <!-- 新規ユーザー登録ボタン -->
            <!--
            <div class="mb-4 text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">管理者ユーザー登録</a>
            </div>
            -->

            <!-- 検索 -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="検索">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">検索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ユーザー一覧テーブル -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info">編集</a>
                                        @if ($user->trashed())
                                            <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">復元</button>
                                            </form>
                                            <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">物理削除</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.softDelete', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-warning">論理削除</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-app-layout>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
