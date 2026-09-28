# STUDY_LOG（dog-attendance-app 学習記録）

過去の記録は削除せず、日付ごとに追記する。

---

## Day 01｜2026-09-26〜09-27

### 学習時間
記録なし（次回から開始・終了時刻を記録する）

### 取り組んだCOACHTECHタスク
- 2. テーブル仕様書作成

### 完成したタスク
- 2. テーブル仕様書作成（Googleスプレッドシート「退勤アプリ設計図」で作成）

### 決めたこと（方針）
- 実装順は、LMSスプリント5のタスク一覧（2 → 4 → 5 → 9 → 14 …）を使う
- dog-attendance-app は空なので、実装を始める前に Laravel・Docker 環境をゼロから構築する
- 管理者は users とは別の admins テーブルにする（理由：ごちゃ混ぜにならないから）
  → 管理者ログインのタスク（72〜）で「ガード」の設定が必要になる
- 合計勤務時間は保存せず、表示するときに計算する
- correction_requests に user_id は持たせない（attendance_id からたどれる）
- 休憩の列名は clock_in / clock_out にそろえて rest_in / rest_out にした
- 休憩テーブル名は rests（break は PHP の予約語で Model 名に使えないため）

### 完成したテーブル（6つ）
- users：id / name / email / password / email_verified_at / remember_token / created_at / updated_at
- admins：id / name / email / password / created_at / updated_at
- attendances：id / user_id(FK) / date / clock_in / clock_out(NULL許可) / created_at / updated_at
- rests：id / attendance_id(FK) / rest_in / rest_out(NULL許可) / created_at / updated_at
- correction_requests：id / attendance_id(FK) / clock_in / clock_out / remarks(text) / status(string) / created_at / updated_at
- correction_request_rests：id / correction_request_id(FK) / rest_in / rest_out / created_at / updated_at
  （根拠：FN026・FN027 で休憩も修正でき、休憩回数分の入力欄がある）

### 理解できたこと
- DB＝ファイル、テーブル＝シート、カラム＝列、レコード＝行
- 同じ情報のくり返しを防ぐため、表は「人ごと」ではなく「記録の種類ごと」に分ける
- `〇〇_id` には、つながる相手の表の id を入れる（FK）
- 修正申請を別の表にするのは、管理者の承認前に勤怠が書き換わらないようにするため
- 確認用パスワード・合計時間は保存しない理由
- データ型：string / text / bigint / date / time / timestamp
- 制約：PK / FK / NOT NULL / UNIQUE / NULL許可
- 同じ名前の列でも、使う場面で制約が変わる（attendances.clock_out は NULL許可、correction_requests.clock_out は NOT NULL）

### 自力でできたこと
- FN003 のエラーメッセージから、会員登録の入力項目（名前・メール・パスワード）を読み取れた
- 「表をまとめる（idを一つにまとめる）」という発想
- 管理者テーブルを別にするかどうかを、理由つきで選べた
- clock_out / rest_out が空っぽになる場面を判断できた
- 修正申請の clock_out は必ず入力する＝NOT NULL と判断できた
- スプレッドシートで6テーブルの仕様書を完成させた

### Claudeの助けが必要だったこと
- 必要なテーブルを洗い出す最初の一歩
- 休憩を別テーブルにする考え方、人ごとにテーブルを作らない理由
- 英語の列名・テーブル名（correction_requests など）
- 型と制約の区別（email に PK、user_id に UNIQUE をつけようとした）
- correction_request_rests が必要な理由

### 説明できなかったこと
- `〇〇_id` の数字から相手の表をたどる読み方（何行目・何回目と混同した）
- テーブル仕様書を作る目的（「設計図」までは言えた。Migration につながることは説明できなかった）

### ターミナル／Git／Docker で学んだこと
- 今日は未実施（次回以降の環境構築で扱う）

### 復習項目
- 表を人ごとではなく、記録の種類ごとに分ける理由
- 修正申請テーブルが必要な理由
- データ型のスペル：bigint（biginit ×）、date（data ×）、timestamp（timestanp / timetable ×）
- PK と FK の違い（自分の表の番号 / 別の表の番号）
- UNIQUE をつけてはいけない列（user_id など）
- テーブル仕様書 → Migration のつながり

### 重点復習項目
- `〇〇_id` のたどり方：書いてある数字を見て、相手の表の id を探す（2回以上つまずいた）

### 次回のタスク
- 4. README を用意

### 次回の開始地点
1. 復習問題：`〇〇_id` のたどり方（紙に表を書いて指でたどる練習）
2. テーブル仕様書の目的を、Migration とつなげて説明する
3. タスク4「README を用意」を開始

### メモ
- 学習者は英語が苦手。英単語は意味と読み方を添える
- 説明は短く。長い解説はかえって混乱する
- 表から値を読む練習は、1段ずつ区切ると自力でできた
