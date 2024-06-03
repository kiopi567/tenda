<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if(Auth::guard('admin')->check())
                        <!-- 管理者の場合、管理者ダッシュボードへのリンクを表示 -->
                        <a href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    @else
                        <!-- 一般ユーザの場合、一般ダッシュボードへのリンクを表示 -->
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                @if(Auth::guard('admin')->check())
                    <!-- 管理者のナビゲーションリンク -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <!-- ユーザ管理ページへのリンク -->
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                            {{ __('ユーザ管理') }}
                        </x-nav-link>
                        <!-- 登録者管理ページへのリンク -->
                        <x-nav-link :href="route('admin.users.create')" :active="request()->routeIs('admin.users.create')">
                            {{ __('登録者管理') }}
                        </x-nav-link>
                    </div>
                @else
                    <!-- 利用者のナビゲーションリンク -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <!-- 掲示板ページへのリンク -->
                        <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                            {{ __('掲示板') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Links (aligned to the right) -->
            <div class="hidden sm:flex sm:items-center">
                <div class="space-x-8 sm:-my-px sm:flex">
                    @if(Auth::guard('admin')->check())
                        <!-- 管理者のログアウトボタン -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-nav-link>
                        </form>
                    @else
                        <!-- 利用者のプロフィール編集とログアウトボタン -->
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                            {{ __('プロフィール編集') }}
                        </x-nav-link>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-nav-link>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
