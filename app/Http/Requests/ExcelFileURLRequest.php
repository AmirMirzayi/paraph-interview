<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelFileURLRequest extends FormRequest
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
            'excel_url' => ['required', 'url', 'regex:/.*\.(xlsx|xls|csv|xml)/']
        ];
    }

    public function messages(): array
    {
        return [
            'excel_url.required' => 'آدرس فایل اکسل ضروری است.',
            'excel_url.url' => 'آدرس فایل اکسل باید یک آدر س وب معتبر باشد.',
            'excel_url.regex' => 'آدرس وارد شده برای یک فایل اکسل نمی‌باشد.',
        ];
    }
}
