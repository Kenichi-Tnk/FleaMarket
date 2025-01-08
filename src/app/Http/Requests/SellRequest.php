<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
        $rules = [
            'img_url' => 'required|image',
            'category_id' => 'required',
            'condition_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|regex:/^[1-9][0-9]*$/'
        ];

        if ($this->route('item_id')) {
            $rules['img_url'] = 'image';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'img_url.required' => '画像ファイル(jpg png bmp git svg)を選択してください',
            'img_url.image' => '画像ファイル(jpg png bmp gif svg)を選択してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'description.required' => '商品説明を入力してください',
            'price.required' => '販売価格を半角数字で入力してください',
            'price.regex' => '販売価格を半角数字だ入力してください'
        ];
    }
}
