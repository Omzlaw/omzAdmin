<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Applicant;

class UpdateApplicantRequest extends FormRequest
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
        $id = $this->route('applicant');
        $rules = [
          'name'     => 'unique:applicants,name,'.$id,
          'email'    => 'email|unique:applicants,email,'.$id,
          'RC_number' => 'unique:applicants,RC_number,'.$id,
          'address' => '',
          'website' => 'unique:applicants,website,'.$id,
          'phone' => 'unique:applicants,phone,'.$id,
        ];
        
        return $rules;
    }
}
