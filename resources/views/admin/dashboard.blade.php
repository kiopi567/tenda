<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー編集</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                管理者TOP
            </h2>
        </x-slot>

        <div class="container mt-5">
            <div class="row mt-4 justify-content-center">
                <div class="col-md-3 mb-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-success btn-block">ユーザ管理</a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-block">管理者登録</a>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
