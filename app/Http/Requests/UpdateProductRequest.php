<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $method = $this->method();

        if($method == 'PUT'){
            return [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255|',
                'value' => 'required|decimal:2',
                'categories_id' => [ 
                    'required',
                    Rule::exists(Category::class, 'id')
                ]
            ];
        }else{
            return [
                'name' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string|max:255|',
                'value' => 'sometimes|required|decimal:2',
                'categories_id' => [ 
                    'sometimes|required',
                    Rule::exists(Category::class, 'id')
                ]
            ];
        }

    }
}
