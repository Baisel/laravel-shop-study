<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoriesUpdateRequest extends FormRequest
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
            'name' => 'required',
            'order_no' => 'required|numeric',
        ];
    }

    //エラーメッセージ内容のカスタム(なくても可能)
    public function messages(){
        return [
            'name.required' => '名称を入力してください。',
            'order_no.required' => '並び替え番号を入力してください。',
        ];
    }
}
