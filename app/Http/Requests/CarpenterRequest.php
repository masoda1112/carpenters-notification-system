<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarpenterRequest extends FormRequest
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
            //
            'name' => 'required',
            'profile'=> 'required',
            'img'=> 'required',
            'role'=> 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => '名前を入力してください',
            'profile.required'=> '紹介文を入力してください',
            'img.required' => '画像を選択してください',
            'role.required'=> '職種を入力してください',
        ];
    }
}
