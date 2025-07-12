- さくらインターネットにSSH接続
- PHPのバージョンを確認
- ホームディレクトリでComposerをインストール
```
# Laravel専用プロジェクトディレクトリを作成
mkdir -p ~/laravel-projects/bin

[username@servername ~]$ mkdir -p ~/laravel-projects/bin
[username@servername ~]$ ls
MailBox                 db                      laravel-projects        portfolio1:25f          sblo_files
composer-setup.php      dead.letter             log                     ports                   tmp
config                  index.html              nodebrew                sakura_pocket           www

[username@servername ~]$ cd laravel-projects/

# Composerのインストール
[username@servername ~/laravel-projects]$ curl -sS https://getcomposer.org/installer | php
All settings correct for using Composer
Downloading...

Composer (version 2.8.9) successfully installed to: /home/username/laravel-projects/composer.phar
Use it: php composer.phar

[username@servername ~/laravel-projects]$ ls
bin             composer.phar

# composer.pharをlaravel-projects/binディレクトリに移動
[username@servername ~/laravel-projects]$ mv composer.phar ~/laravel-projects/bin/composer

# composerファイルに実行権限を付与
[username@servername ~/laravel-projects]$ chmod +x ~/laravel-projects/bin/composer

# .bashrcに~/laravel-projects/binディレクトリをPATHに追加
[username@servername ~/laravel-projects]$ echo 'export PATH="$HOME/laravel-projects/bin:$PATH"' >> ~/.bashrc

# .bashrcの設定を現在のシェルに適用
[username@servername ~/laravel-projects]$ source ~/.bashrc

[username@servername ~/laravel-projects]$ cat ~/.bashrc
export PATH="$HOME/laravel-projects/bin:$PATH"

# Composerの動作確認
[username@servername ~/laravel-projects/bin]$ composer --version
Composer version 2.8.9 2025-05-13 14:01:37
PHP version 8.2.20 (/usr/local/bin/php-wrapper)
Run the "diagnose" command to get more detailed diagnostics output.
```

「nodeとnpmのインストールをする」か、「ローカルでnpm run buildしてデプロイする」か悩みますが、、、

```
~/ (ホーム)
├── laravel-projects/               # Laravel専用プロジェクト管理ディレクトリ
│   ├── bin/                       # Laravel開発ツール置き場
│   │   └── composer              # Composer実行ファイル（実行ファイルなので、公開ディレクトリに置くとセキュリティリスク）
│   └── laravel-sakura/           # Laravelアプリ本体
│       ├── app/
│       ├── vendor/
│       └── ...
└── www/domain/
    └── laravel-sakura/             # 公開ディレクトリ
        ├── index.php               # Laravel public/index.php のコピー
        ├── .htaccess               # Laravel public/.htaccess のコピー
        ├── css/ js/ img/           # アセットファイル
        └── ...

```

docs\wsl-git-setup.mdを参考にgit clone



## Composerで依存関係をインストール

```
[username@servername ~/laravel-projects/laravel-sakura]$ composer install --no-dev --optimize-autoloader
Installing dependencies from lock file
Verifying lock file contents can be installed on current platform.
Package operations: 75 installs, 0 updates, 0 removals
  - Downloading doctrine/inflector (2.0.10)
  - Downloading doctrine/lexer (3.0.1)
  - Downloading symfony/polyfill-ctype (v1.32.0)
  - Downloading webmozart/assert (1.11.0)
  - Downloading dragonmantank/cron-expression (v3.4.0)

  ...

  - Installing laravel/framework (v12.19.3): Extracting archive
  - Installing laravel/tinker (v2.10.1): Extracting archive
Generating optimized autoload files
> Illuminate\Foundation\ComposerScripts::postAutoloadDump
> @php artisan package:discover --ansi

   INFO  Discovering packages.

  laravel/tinker .................................................................................................. DONE
  nesbot/carbon ................................................................................................... DONE
  nunomaduro/termwind ............................................................................................. DONE  

51 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
```


## 本番用のDBをさくらインターネットで作成

- 新規追加
- ユーザー名・パスワードを確認



## docs\env_conversion_table.mdを参考に作成した本番用の.envファイルを設置

- 上記情報を .env.production に

.env.production を設置（Git管理してないのでFTP） 

.envにコピー、ついでにキャッシュの設定も

```
[username@servername ~]$ cd laravel-projects/laravel-sakura/ && ls -a
.                       .gitattributes          composer.json           package-lock.json       routes
..                      .gitignore              composer.lock           package.json            storage
.editorconfig           README.md               config                  phpunit.xml             tailwind.config.js        
.env.example            app                     database                postcss.config.js       tests
.env.production         artisan                 docker-compose.yml      public                  vendor
.git                    bootstrap               docs                    resources               vite.config.js
[username@servername ~/laravel-projects/laravel-sakura]$ cp .env.production .env && php artisan config:cache

   INFO  Configuration cached successfully.

[username@servername ~/laravel-projects/laravel-sakura]$ 
```

## マイグレーションでテーブルを構築

本番環境ですが、大丈夫？と警告がでますが、はじめの展開のため→Yes

```
[username@servername ~]$ cd laravel-projects/laravel-sakura/ && php artisan migrate

                                                                                                                          
                                                APPLICATION IN PRODUCTION.                                                
                                                                                                                          

 ┌ Are you sure you want to run this command? ──────────────────┐
 │ Yes                                                          │
 └──────────────────────────────────────────────────────────────┘

   INFO  Preparing database.  

  Creating migration table ................................................................................ 28.54ms DONE

   INFO  Running migrations.  

  0001_01_01_000000_create_users_table .................................................................... 81.30ms DONE
  0001_01_01_000001_create_cache_table .................................................................... 29.85ms DONE
  0001_01_01_000002_create_jobs_table ..................................................................... 64.76ms DONE
  2025_07_07_215549_create_roles_table .................................................................... 28.62ms DONE
  2025_07_08_092920_create_qualifications_table ........................................................... 30.24ms DONE
  2025_07_08_093930_add_foreign_keys_users_table .......................................................... 97.62ms DONE
  2025_07_08_095741_update_role_codes ...................................................................... 2.34ms DONE

[username@servername ~/laravel-projects/laravel-sakura]$ 
```


## 公開ディレクトリへシンボリックリンクを作成
直接コピーするより色々都合よし



.htaccessに追記
サブディレクトリで Laravel を動かすための内容です
```
    RewriteEngine On
    RewriteBase /laravel-sakura/
```