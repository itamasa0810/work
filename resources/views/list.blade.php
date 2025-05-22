<!doctype HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品管理</title>
    <link rel="stylesheet" href="{{ asset('build/assets/list.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#list-table').tablesorter();
        });
    </script>
</head>
<body>
    <div>
        <h2>商品一覧画面</h2>
        <div>
            <input type="text" name="keyword" placeholder="検索キーワード" value="{{ session('search.keyword', old('keyword')) }}" class="keyword">
            <select class="company" name="company_id">
            <option value="">メーカー名</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select><br>
            <label>価格</label>
            <input type="number" placeholder="上限" min="0" class="price" name="hight_price">
            <input type="number" placeholder="下限" min="0" class="price" name="low_price">
            <label>在庫</label>
            <input type="number" placeholder="上限" min="0" class="stock" name="hight_stock">
            <input type="number" placeholder="下限" min="0" class="stock" name="low_stock">
            <button class="search-button" type="button">検索</button>
        </div>
    </div>
    <table border = "1" rules = "rows" id="list-table">
        <thead>
            <tr>
                <th><i>ID</i></th>
                <th data-sorter="false">商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th class="th7" data-sorter="false"><button class="create" type = "button" onclick = "location.href = '{{route('create')}}'">新規登録</button></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->id}}.</td>
                <td><img src = "{{asset($product->img_path)}}" alt = "商品画像" width = "100"></td>
                <td>{{$product->product_name}}</td>
                <td>¥{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->company_name}}</td>
                <td><button class="info" type="button" onclick="location.href='{{route('info',['id' => $product ->id])}}'">詳細</button>
                    <button class="delete" type="button" data-id="{{$product->id}}">削除</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- 検索 -->
    <script>
            $(".search-button").on("click", function(){
                let keyword = $("input[name='keyword']").val();
                let company_id = $("select[name='company_id']").val();
                let hight_price =$("input[name='hight_price']").val();
                let low_price =$("input[name='low_price']").val();
                let hight_stock =$("input[name='hight_stock']").val();
                let low_stock =$("input[name='low_stock']").val();
                $.ajax({
                    url:"{{route('search')}}",
                    method:"GET",
                    dataType:"json",
                    data: {
                        keyword: keyword,
                        company_id: company_id,
                        hight_price: hight_price,
                        low_price: low_price,
                        hight_stock: hight_stock,
                        low_stock: low_stock
                    }
                }).done(function(res){
                    let products = res.products;
                    let companies = res.companies;
                    let tbody = $("table tbody");
                    tbody.empty();

                    products.forEach(function(product) {
                        let row = 
                        ` <tr>
                                <td>${product.id}</td>
                                <td><img src="${product.img_path}" alt="商品画像" width="100"></td>
                                <td>${product.product_name}</td>
                                <td>¥${product.price}</td>
                                <td>${product.stock}</td>
                                <td>${product.company_name}</td>
                                <td>
                                    <button class="info" type="button" onclick="location.href='/work/public/info/${product.id}'">詳細</button>
                                    <button class="delete" type="button" data-id="${product.id}">削除</button>
                                </td>
                            </tr>`;
                        tbody.append(row);
                    });
                    $("#list-table").trigger("destroy");
                    $('#list-table').tablesorter();
                });   
            });
    </script>
    <script>
        $("table").on("click", ".delete", function(){
            if (confirm('削除しますか？')) {
                let id = $(this).data("id");
                let $row = $(this).closest("tr");
                $.ajax({
                    url:"{{route('delete',['id'=> 'id'])}}".replace('id',id),
                    method:"POST",
                    dataType:"json",
                    data: {
                        id : id,
                        _token: "{{ csrf_token() }}"
                    }
                }).done(function(res){
                    $row.remove();
                    $("#list-table").trigger("destroy");
                    $('#list-table').tablesorter();                    
                    alert('削除しました！');
                });
            } else{
                alert('削除をキャンセルしました');
            } 
        })
    </script>
</body>
</html>