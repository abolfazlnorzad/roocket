<?php

namespace Nrz\Category\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        if (request()->method == 'POST') {
            return [
                "name" => ["required", "string", "max:255", "min:2", Rule::unique("categories", "name")]
            ];
        } else {
            return [
                "name" => ["required", "string", "max:255", "min:2", Rule::unique("categories", "name")
                ->ignore(request('category')->id)]
            ];
        }

    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ]));
    }
}
