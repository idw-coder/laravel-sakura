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

## 参考
- WSL環境でのファイルシステムアクセス: `/mnt/c/` でWindowsのCドライブにアクセス
- Git設定の優先順位: ローカル > グローバル > システム 