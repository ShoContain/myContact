# Requirement
* composer
* node

# Installation

ライブラリーインストール
```bash
composer install

npm install
```

# Usage
.envファイルのコピー
```bash
cp .env.example .env
```

コピーした.envファイルのDB設定を書き換え
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={YOUR DATABASE NAME}
DB_USERNAME={YOUR USER NAME}
DB_PASSWORD={YOUR PASSWORD}
```

アプリケーションキーを生成
```bash
php artisan key:generate
```

マイグレート
```bash
php artisan migrate
```

#### NOW YOU'RE READY TO GO!!

ログイン後入力画面が出てくるので管理したい、個人の情報（名前、パスワード、会社名、生年月日を入力し登録します）
<img width="1119" alt="4" src="https://user-images.githubusercontent.com/54580808/83403059-e3828500-a442-11ea-896a-989766478856.png">
</p>

一覧画面より登録した情報を確認できます
<img width="1119" alt="スクリーンショット 2020-06-01 20 10 10" src="https://user-images.githubusercontent.com/54580808/83403608-fd709780-a443-11ea-8ef9-1f4353b0dd84.png">

