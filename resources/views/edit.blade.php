<!DOCTYPE HTML>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>詳細</title>
    <link rel="stylesheet" href="{{asset('build/assets/edit.css')}}"
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="{{ route('update') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div>
            <label>ID.</label>
            <span>{{ $product->id }}</span>
        </div>
        
        <div>
            <label>商品名<span class="asterisk">*</span></label>
            <input type="text" name="name" value="{{ $product->product_name }}">
        </div>
    
        <div>
            <label>メーカー名<span class="asterisk">*</span></label>
            <select class="company" name="company_id">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div>
            <label>価格<span class="asterisk">*</span></label>
            <input type="text" name="price" value="{{ $product->price }}">
        </div>
    
        <div>
            <label>在庫数<span class="asterisk">*</span></label>
            <input type="text" name="stock" value="{{ $product->stock }}">
        </div>
    
        <div>
            <label>コメント</label>
            <textarea class="comment" name="comment">{{ $product->comment }}</textarea>
        </div>
    
        <div class="img">
            <label>商品画像</label>
            <input type="file" name="img" accept=".jpeg,.png,.jpg" >
        </div>
    
        <div class="button">
            <button class="update" type="submit">更新</button>
            <button class="back" type="button" onclick="location.href='{{ route('info', ['id' => $product->id]) }}'">戻る</button>
        </div>
    </form>
</body>
</html>