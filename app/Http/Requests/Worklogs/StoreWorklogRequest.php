<?php

namespace App\Http\Requests\Worklogs;

use App\Constants\DbTables;
use Illuminate\Foundation\Http\FormRequest;

class StoreWorklogRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
            'user_id' => [sprintf('exists:%s,id', DbTables::USERS)]
        ];
    }
}
