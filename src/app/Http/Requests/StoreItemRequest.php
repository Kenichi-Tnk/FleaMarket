<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:1',
            'condition_id' => 'required|integer',
            'category_ids' => 'required|array',
            'category_ids.*' => 'integer|exists:categories,id',
            'img_url' => 'nullable|image=max2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'description.required' => '説明を入力してください',
            'price.required' => '価格を入力してください',
            'price.integer' => '価格を整数で入力してください',
            'condition_id.required' => '商品の状態を選択してください',
            'category_ids.required' => 'カテゴリーを選択してください',
            'img_url.image' => '画像ファイルをアップロードしてくだい',
        ];
    }
}
