# laravel_nuxt

## 構成
PHP8.1<br>
Laravel8<br>
Nuxt2.5<br>
Postgres13<br>
nginx1.23<br>

# 参考文献

[LaravelとNuxtではじめるSNSシェアアプリ開発 (技術の泉シリーズ（NextPublishing）](https://www.amazon.co.jp/Laravel%E3%81%A8Nuxt%E3%81%A7%E3%81%AF%E3%81%98%E3%82%81%E3%82%8BSNS%E3%82%B7%E3%82%A7%E3%82%A2%E3%82%A2%E3%83%97%E3%83%AA%E9%96%8B%E7%99%BA-%E6%8A%80%E8%A1%93%E3%81%AE%E6%B3%89%E3%82%B7%E3%83%AA%E3%83%BC%E3%82%BA%EF%BC%88NextPublishing%EF%BC%89-%E5%AF%BA%E7%94%B0-%E6%99%83%E5%A4%A7-ebook/dp/B087JLFD87/ref=sr_1_1?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&crid=RSZB6GO1CU06&keywords=Laravel%E3%81%A8Nuxt%E3%81%A7%E3%81%AF%E3%81%98%E3%82%81%E3%82%8BSNS%E3%82%B7%E3%82%A7%E3%82%A2%E3%82%A2%E3%83%97%E3%83%AA%E9%96%8B%E7%99%BA&qid=1665301999&qu=eyJxc2MiOiIwLjU3IiwicXNhIjoiMC4wMCIsInFzcCI6IjAuMDAifQ%3D%3D&s=digital-text&sprefix=%2Cdigital-text%2C270&sr=1-1)

Backend<br>
https://github.com/aiiro/ogp-backend

FrontEnd<br>
https://github.com/minetti0327/ogp-frontend


## DB接続
```
docker exec -it lara_nux_db sh 
psql -U user -d lara_nux
```

### プロジェクト作成
```
npx create-nuxt-app プロジェクト名
```
## フロント(nuxt)へのアクセス
```
 docker exec lara_nux_node npm run dev
```

```
> nuxt@1.0.0 dev /var/www/html
> nuxt

ℹ Listening on: http://172.30.0.3:3000/
ℹ Preparing project for development
ℹ Initial build may take a while
ℹ Discovered Components: .nuxt/components/readme.md
✔ Builder initialized
✔ Nuxt files generated
ℹ Compiling Client
ℹ Compiling Server
✔ Server: Compiled successfully in 14.69s
✔ Client: Compiled successfully in 20.34s
ℹ Waiting for file changes
ℹ Memory usage: 236 MB (RSS: 333 MB)
ℹ Listening on: http://172.30.0.3:3000/
```

http://localhost:3000/ へのアクセスするとアクセスできる

### nuxtのルーティング
ディレクトリ構造で自動的に決まる
```
pages/
  index.vue エントリーポイント

https://qiita.com/tekondo/items/80555991c019808669ef
/users/34/
の場合、以下のようなディレクトリ構成になる
pages/
--| users/
-----| _id.vue

.nuxt/router.jsに吐かれているのを確認できる
```

```
$axios.getと$axios.$getの違い
$axios.getで取得する場合は、レスポンスが下記のようになります。

{
  "data": [], // レスポンスデータ
  "status": 200, // ステータスコード
  "statusText": "", // ステータステキスト
  "headers": {},
  "config": {},
  "request": {}
}
実際に取得したいデータは「data」内に入っています。
```
statusコードなどがなく、シンプルな反面、statusコードの切り分けなどができない<br>
https://webrandum.net/nuxt-axios-module/<br>
https://zenn.dev/captain_blue/articles/nuxt-axios-method-memo

## styleにboostrap-vueを活用

https://bootstrap-vue.org/

