<?php

namespace Rastventure\SEO\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Rastventure\SEO\Models\Page;

class Store extends FormRequest
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
            // 'page.path' => 'required|unique:seo_pages,path|max:255',
            // 'route_name' => 'nullable|max:150',
            // 'page.robot_index' => 'nullable|max:50',
            // 'page.robot_follow' => 'nullable|max:50',
            // 'page.canonical_url' => 'nullable|max:255',
            // 'page.title' => 'required|max:70',
            // 'page.description' => 'required|max:170',
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
