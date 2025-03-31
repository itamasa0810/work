<!DOCTYPE HTML>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="{{ asset('build/assets/create.css') }}">
</head>
<body>
    <div></div>
    <form class="form" method = 'POST' enctype = 'multipart/form-data' action = {{route('add')}}>
        @csrf
        <div>
            <label>商品名<span class="asterisk">*</span></label>
            <input type = 'text' name = 'name' value="{{ old('name') }}">
            @if($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div>
            <label>メーカー名<span class="asterisk">*</span></label>
            <select class="company" name = 'company_id'>
            <option value = ""></option>
                @foreach ($companies as $company)
                    <option value = "{{ $company->id }}">{{$company->company_name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>価格<span class="asterisk">*</span></label>
            <input type = 'text' name = 'price' value="{{ old('price') }}">
            @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
        </div>
        <div>
            <label>在庫数<span class="asterisk">*</span></label>
            <input type = 'text' name = 'stock' value="{{ old('stock') }}">
            @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
        </div>
        <div>
            <label>コメント</label>
            <textarea class="comment" name = 'comment' row="20" col="2"></textarea>
        </div>
        <div class="img">
            <label >商品画像</label>
            <input type = 'file' name = 'img' accept = ".jpeg,.png,.jpg">
        </div>
        <div class="button">
            <button class="create" type="submit">新規登録</button>
            <button class="back" type="button" onclick = "location.href = '{{route('list')}}'">戻る</button>
        </div>
        
        
    </form>
</body>
</html>