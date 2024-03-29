<?php

namespace Rastventure\SEO\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;
use Rastventure\SEO\Models\PageImage;

class Create extends FormRequest 
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() 
    {
        return auth()->user()->can('create',PageImage::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() 
    {
        return [

        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
     
        ];
    }

}
