<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->route('contact'));
        // dd($this->method());

        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => '',
            'email' => 'required | email',
            'address' => 'required',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'Company',
            'email' => 'E-mail Address'
        ];
    }

    public function messages()
    {
        return [
            'email' => 'الايميل المدخل غير صحيح',
            'first_name.required' => 'الاسم الاول مطلوب',
            '*.required' => 'The field :attribute is required, please fill :attribute'
        ];
    }
}
