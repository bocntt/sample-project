<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Illuminate\Validation\Factory as ValidationFactory;

class LessonCreateRequest extends FormRequest
{
    // public function __construct(ValidationFactory as $validationFactory) {
        // $validationFactory->extend(
        //     'belongsToCategory', 
        //     function($attribute, $value, $parameters) {
        //         $category_id = request()->input('category_id');

        //         $verfied = Subcategory::where('id', $value)
        //                     ->where('category_id', $category_id)
        //                     ->exists();
        //         return 'belongsToCategory' == $verfied;
        //     },
        //     'Sorry, subcategory does not belong to category'
        // );
    // }
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
        $count = Category::count();

        return [
            'name' => 'required|unique:lessons|string|max:30',
            'category_id' => "required|numeric|isValidCategory",
            'subcategory_id' => 'required|belongsToCategory'
        ];
    }
}
