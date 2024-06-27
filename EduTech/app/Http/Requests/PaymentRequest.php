<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon; 
class PaymentRequest extends FormRequest
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
            'card_number' => 'required|numeric|digits:16',
            'cvv' => 'required|numeric|digits:3',
            'card_holder_name'=>'required|string|min:1|max:255',
            'expiry_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // Validate expiry date is greater than or equal to current date
                    if (Carbon::parse($value)->isPast()) {
                        $fail('Your card is expired');
                    }
                },
            ],
            'amount' =>  'required|numeric|min:0.01',
        ];
    }
}
