<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Operator;

class UpdateOperatorRequest extends FormRequest
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
        $id = $this->route('operator');
        $rules = [
          'name'     => 'unique:operators,name,'.$id,
          'email'    => 'email|unique:operators,email,'.$id,
          'RC_number' => 'unique:operators,RC_number,'.$id,
          'address' => '',
          'website' => 'unique:operators,website,'.$id,
          'phone' => 'unique:operators,phone,'.$id,
        ];
        
        return $rules;
    }
}
