<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransportRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'state'           => 'required|string|max:255',
            'transport_type_id' => 'required|integer',
            'language_id' => 'required|integer',
            'image'           => 'required|string',
            'extension_image' => 'required|string',
        ];
    }
}
