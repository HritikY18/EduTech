<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'size:10',
                Rule::unique('users')->ignore(auth()->id()),
            ],
            'dob' =>[
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if ((Carbon::parse($value)->diff(Carbon::now())->y)<18) {
                        $fail('Your age is less than 18');
                    }
                },
            ],
            'profile' => 'nullable'
        ];
    }
}
