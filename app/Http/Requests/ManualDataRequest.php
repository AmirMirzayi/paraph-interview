<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManualDataRequest extends FormRequest
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
            'count' => 'required|numeric|min:1',
            'volume' => 'required|numeric|min:1',
            'value' => 'required|numeric|min:1',
            'yesterday' => 'required|numeric|min:1',
            'first' => 'required|numeric|min:1',
            'last_trade_amount' => 'required|numeric|min:1',
            'last_trade_change' => 'required|numeric|decimal:2',
            'last_trade_percent' => 'required|numeric|decimal:2',
            'closed_price' => 'required|numeric|min:1',
            'closed_change' => 'required|numeric|decimal:2',
            'closed_percent' => 'required|numeric|decimal:2',
            'lowest' => 'required|numeric|integer',
            'highest' => 'required|numeric|integer',
            'trade_date' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'count' => 'تعداد',
            'volume' => 'حجم',
            'value' => 'ارزش',
            'yesterday' => 'دیروز',
            'first' => 'اولین',
            'last_trade_amount' => 'آخرین معامله - مقدار',
            'last_trade_change' => 'آخرین معامله - تغییر',
            'last_trade_percent' => 'آخرین معامله - درصد',
            'closed_price' => 'قیمت پایانی - مقدار',
            'closed_change' => 'قیمت پایانی - تغییر',
            'closed_percent' => 'قیمت پایانی - درصد',
            'lowest' => 'کمترین',
            'highest' => 'بیشترین',
            'trade_date' => 'تاریخ',
        ];
    }
}
