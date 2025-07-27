<?php

namespace Modules\GoogleAnalytics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoogleAnalyticsSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required',
            'measurement_id' => 'required',
            'attachments' => 'required|file|mimetypes:application/json',
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
            'propertyId.required' => __('Property ID is required'),
            'measurement_id.required' => __('Measurement ID is required'),
            'attachments.required' => __('Private Key File is required.'),
            'attachments.mimetypes' => __('Please upload json file.'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


}
