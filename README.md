## 手順（旧1班の資料を参考にしている）
1. リポジトリのクローン
```bash
https://github.com/kiopi567/tenda.git
```

2. プロジェクト内へ移動
``` bash
cd tenda
```

3. .envの作成
```bash
cp .env.example .env
```

4. .envの設定変更<br>
以下の項目を変更
```bash
APP_TIMEZONE=Asia/Tokyo

APP_LOCALE=ja
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=ja_JP

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

5. Laravel Sailの導入<br>
Dockerが起動しているのを確認し、以下のコマンドを実行する
```bash
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
```

6. Sailの起動
```bash
sail up -d
```

7. DBのマイグレーション
```bash
sail artisan migrate --seed
```

8. Node.js 必要パッケージのインストール
```bash
sail npm install
```

9.  Vite 開発サーバの起動<br>
(認証部分やTailwind CSSなど、Node.jsを用いている部分の動作に必要)
```bash
sail npm run dev
```

## 困ったときは
コンテナを一度消して作りなおしましょう
```bash
# コンテナの停止・削除 (-vオプションで、コンテナ内の環境が全て削除される)
sail down -v
# コンテナの作成・起動
sail up -d
```
