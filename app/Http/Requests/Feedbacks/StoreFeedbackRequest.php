<?php

namespace App\Http\Requests\Feedbacks;

use App\Constants\DbTables;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required', 'string', 'max:80'],
            'worklog_id' => [sprintf('exists:%s,id', DbTables::WORKLOGS)]
        ];
    }
}
