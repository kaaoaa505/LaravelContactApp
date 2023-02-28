<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable'],
            'bio' => ['nullable'],
            // 'image' => ['nullable', 'mimes:png,jpg,jpeg,bmp'],
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }

    public function handleRequestWithImageUpload(){
        $data = $this->validated();

        if($this->hasFile('image')){
            $image_path = $this->file('image')->store('uploads', 'public');
            $data['image'] = $image_path;
        }

        return $data;
    }
}
