<!DOCTYPE HTML>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>詳細</title>
    <link rel="stylesheet" href="{{asset('build/assets/info.css')}}">
</head>
<body>
        <div>
            <label><i>ID</i></label>
            <span>{{$product ->id}}.</span>
        </div>
        <div>
            <label>商品名</label>
            <span>{{$product ->product_name}}</span>
        </div>
        <div>
            <label>画像</label>
            <img src = "{{asset($product->img_path)}}" alt = "商品画像" width = "100">
        </div>
        <div>
            <label>メーカー名</label>
            <span>{{$product ->company_name}}</span>
        </div>
        <div>
            <label>価格</label>
            <span>{{$product ->price}}</span>
        </div>
        <div>
            <label>在庫数</label>
            <span>{{$product ->stock}}</span>
        </div>
        <div>
            <label>コメント</label>
            <textarea class="comment" row="20" col="2">{{$product ->comment}}</textarea>
        </div>
        <div class="button">
            <button class="edit" type="button" onclick = "location.href = '{{route('edit',['id' => $product ->id])}}'">編集</button>
            <button class="back" type="button" onclick = "location.href = '{{route('list')}}'">戻る</button>
        </div>
</body>
</html>