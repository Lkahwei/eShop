<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'productName' => 'required | max:50',
            'productDescription' => 'required | max:1000',
            'productPrice' => 'required',
            'productStock' => 'required',
            //For every element in images array
            'images.*' => ['nullable', 'image']
        ];
    }

    public function withValidator($validator)
    {
        //This method will be called after the first rules is verified
        //You can modify your own validation using this
        $validator->after(function ($validator){
            //Since we have not access to the $request, but we have the $request pass in as an parameter, hence use $this
            if ($this->input('productStatus') === 'available' && (int)$this->input('productStock') === 0){
                $validator->errors()->add('stock', 'If available the stock number must greater than 0');
            }
        });
    }
}
