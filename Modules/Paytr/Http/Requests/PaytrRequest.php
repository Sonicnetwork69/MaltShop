<?php

/**
 * @package PaytrRequest
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 05-04-2023
 */

namespace Modules\Paytr\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaytrRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return moduleConfig('paytr.validation')['rules'];
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

    /**
     * Attributes custom names
     *
     * @return array
     */
    public function attributes()
    {
        return moduleConfig('paytr.validation')['attributes'];
    }
}
