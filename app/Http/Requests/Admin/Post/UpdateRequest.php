<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file',
            'main_image' => 'nullable|file',
            'category_id' => 'required|integer|exists:category,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Это поле должно быть запролненно',
            'title.string' => 'Это поле должно быть строчного типа',
            'content.required' => 'Это поле должно быть запролненно',
            'content.string' => 'Это поле должно быть строчного типа',
            'preview_image.required' => 'Это поле должно быть запролненно',
            'preview_image.file' => 'Необходимо выбрать файл',
            'main_image.required' => 'Это поле должно быть запролненно',
            'main_image.file' => 'Необходимо выбрать файл',
            'category_id.required' => 'Это поле должно быть запролненно',
            'category_id.string' => 'Это поле должно быть числом',
            'category_id.exists' => 'Категория должна быть существующей',
            'tag_ids.array' => 'Необходимо отправить массив данных',
        ];
    }
}
