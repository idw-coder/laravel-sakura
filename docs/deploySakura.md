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

「nodeとnpmのインストールをする」か、「ローカルでnpm run buildしてデプロイする」か悩みますが、
今回は後者で

```
~/ (ホーム)
├── laravel-projects/               # Laravel専用プロジェクト管理ディレクトリ
│   ├── bin/                       # Laravel開発ツール置き場
│   │   └── composer              # Composer実行ファイル（実行ファイルなので、公開ディレクトリに置くとセキュリティリスク）
│   └── laravel-sakura/           # Laravelアプリ本体
│       ├── app/
│       ├── vendor/
│       └── ...
└── www/
    └── laravel-sakura/             # 公開ディレクトリ
        ├── index.php               # Laravel public/index.php のコピー
        ├── .htaccess               # Laravel public/.htaccess のコピー
        ├── css/ js/ img/           # アセットファイル
        └── ...

```