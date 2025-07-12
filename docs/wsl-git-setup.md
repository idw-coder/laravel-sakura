# WSL環境でのGit設定手順

## 概要
WSL（Windows Subsystem for Linux）環境で、Windows側の既存のGit設定（特に仕事用設定）を使用するための手順です。

## 前提条件
- Windows側にGit設定が存在する
- WSL環境がセットアップされている
- 仕事用のGit設定ファイルが別途存在する

## 手順

### 1. Windows側のGit設定確認
Windows側のPowerShellまたはコマンドプロンプトで以下を実行

```powershell
git config --global --list --show-origin
```

### 2. 設定ファイルの場所を確認
上記コマンドの出力例：
```
file:C:/Users/username/.gitconfig  user.name=COMPUTER-NAME\username
file:C:/Users/user/.gitconfig  user.email=user@example.com
includeif.gitdir:C:/dev/workspace/.path=C:/Users/username/.gitconfig_work
# 仕事用プロジェクトでは会社のメールアドレスと名前を使用
```

### 3. WSL環境でWindows側の設定を参照
WSL環境で以下のコマンドを実行：

```bash
# 仕事用設定ファイルをWSLのGit設定に含める
git config --global include.path "/mnt/c/Users/user/.gitconfig_work"
```

### 4. 設定の確認
WSL環境で以下を実行して設定が正しく読み込まれているか確認：

```bash
git config --list
```

### 5. ユーザー設定の確認
```bash
git config user.name
git config user.email
```

## 注意事項
- Windows側のパスは `/mnt/c/` のように変換される
- 設定ファイルのパーミッションに注意
- WSL環境でGitリポジトリを初期化する場合は `git init` を実行

## トラブルシューティング

### 設定ファイルが見つからない場合
```bash
# WSLからWindows側のファイルにアクセス
ls -la /mnt/c/Users/user/.gitconfig*
```

### パーミッションエラーの場合
```bash
# ファイルの権限を確認
ls -la /mnt/c/Users/user/.gitconfig_work
```

## push時にsshのエラー

WSL側にGitHubで登録している公開鍵がない為下記エラー

```
git@github.com: Permission denied (publickey).
fatal: Could not read from remote repository.
```

WindowsのSSH鍵をWSLで使う

```
user@DESKTOP-ABC123:~$ mkdir -p ~/.ssh
user@DESKTOP-ABC123:~/.ssh$ chmod 700 ~/.ssh
user@DESKTOP-ABC123:~/.ssh$ cp /mnt/c/Users/user/.ssh/id_ed25519_github_work ~/.ssh/
user@DESKTOP-ABC123:~/.ssh$ cp /mnt/c/Users/user/.ssh/id_ed25519_github_work.pub ~/.ssh/
user@DESKTOP-ABC123:~/.ssh$ ls -a
.  ..  id_ed25519_github_work  id_ed25519_github_work.pub  known_hosts
user@DESKTOP-ABC123:~/.ssh$ chmod 600 ~/.ssh/id_ed25519_github_work
user@DESKTOP-ABC123:~/.ssh$ chmod 644 ~/.ssh/id_ed25519_github_work.pub
user@DESKTOP-ABC123:~/.ssh$ eval "$(ssh-agent -s)"
Agent pid 9984
user@DESKTOP-ABC123:~/.ssh$ ssh-add ~/.ssh/id_ed25519_github_work
Identity added: /home/user/.ssh/id_ed25519_github_work (user@example.com)
user@DESKTOP-ABC123:~/.ssh$ ssh -T git@github.com
Hi github-user! You've successfully authenticated, but GitHub does not provide shell access.
user@DESKTOP-ABC123:~/.ssh$
```


docs\deploySakura.md参照

Composer入れた後

```
git clone
```

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

