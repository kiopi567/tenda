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
                {{ __('掲示板') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <h2>掲示板</h2>
                                    @foreach ($posts as $post)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $post->user->name }}</h5>
                                                <p class="card-text">{{ $post->content }}</p>
                                                <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <h2>新しい投稿</h2>
                                    <form action="{{ route('posts.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="content" class="form-control" rows="5" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">投稿する</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
