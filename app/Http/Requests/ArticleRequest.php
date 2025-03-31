<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'nullable|string',
            'img' => 'nullable|file|image|max:2048',
        ];
    }

    public function attributes() {
        return [
            'company_id' => 'メーカーID',
            'name' => '商品名',
            'price' => '値段',
            'stock' => '在庫数',
            'comment' => 'コメント',
            'img' => '画像',
            'keyword' => 'キーワード',
        ];
    }

    public function messages() {
        return [
            'company_id.required' => ':attributeは必須項目です。',
            'name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'stock.required' => ':attributeは必須項目です。',
            'price.integer' => ':attributeは整数で入力してください。',
            'stock.integer' => ':attributeは整数で入力してください。',
            'img.file' => ':attributeはファイルである必要があります。',
            'img.image' => ':attributeは画像ファイルである必要があります。',
        ];
    }
}
