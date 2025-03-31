<!doctype HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品管理</title>
</head>
<body>
    <div>
        <h2>商品一覧画面</h2>
        <form method="GET" action= "{{route('search')}}">
            <input type="text" name="keyword" placeholder="検索キーワード" >
            <select name="company_id">
            <option value="">メーカー名</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            <button type="submit">検索</button>
        </form>
    </div>
    <table border = "1" rules = "rows">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th><button type = "button" onclick = "location.href = '{{route('create')}}'">新規登録</button></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->id}}.</td>
                <td><img src = "{{$product->img_path}}" alt = "商品画像" width = "100"></td>
                <td>{{$product->product_name}}</td>
                <td>￥{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->company_name}}</td>
                <td><button type="button" onclick="location.href='{{route('info',['id' => $product ->id])}}'">詳細</button></td>
                <td><button type="button" onclick="location.href='{{route('delete',['id' => $product ->id])}}'">削除</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @yield('content')
</body>
</html>