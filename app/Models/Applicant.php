<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Applicant",
 *      required={"name", "RC_number", "address", "phone", "email", "accept_terms"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="RC_number",
 *          description="RC_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="website",
 *          description="website",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="logo",
 *          description="logo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="no_of_shareholders",
 *          description="no_of_shareholders",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="shareholders_details",
 *          description="shareholders_details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="no_of_directors",
 *          description="no_of_directors",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="directors_details",
 *          description="directors_details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="has_previously_applied",
 *          description="has_previously_applied",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="owners_convicted",
 *          description="owners_convicted",
 *          type="string",
 *          format="binary"
 *      ),
 *      @SWG\Property(
 *          property="conviction_details",
 *          description="conviction_details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Is_director_politician",
 *          description="Is_director_politician",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="has_pending_application",
 *          description="has_pending_application",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="prev_application_details",
 *          description="prev_application_details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_shareholder_politician",
 *          description="is_shareholder_politician",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="accept_terms",
 *          description="accept_terms",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="application_status",
 *          description="application_status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Applicant extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'applicants';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'RC_number',
        'address',
        'phone',
        'website',
        'logo',
        'documents',
        'email',
        'no_of_shareholders',
        // 'shareholders_details',
        'no_of_directors',
        // 'directors_details',
        'has_previously_applied',
        // 'owners_convicted',
        // 'conviction_details',
        // 'Is_director_politician',
        'has_pending_application',
        'prev_application_details',
        // 'is_shareholder_politician',
        'accept_terms',
        'application_status',
        'user_id',
        'final_submission',
        'operator_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'RC_number' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'website' => 'string',
        'logo' => 'string',
        'email' => 'string',
        'no_of_shareholders' => 'integer',
        // 'shareholders_details' => 'string',
        'no_of_directors' => 'integer',
        // 'directors_details' => 'string',
        'has_previously_applied' => 'boolean',
        // 'conviction_details' => 'string',
        // 'Is_director_politician' => 'boolean',
        'has_pending_application' => 'boolean',
        'prev_application_details' => 'string',
        // 'is_shareholder_politician' => 'boolean',
        'accept_terms' => 'boolean',
        'application_status' => 'integer',
        'user_id' => 'integer',
        'final_submission' => 'integer',
        'operator_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:applicants,name',
        'RC_number' => 'required|unique:applicants,RC_number',
        'address' => 'required',
        'website' => 'required|unique:applicants,website',
        'phone' => 'required|unique:applicants,phone',
        'email' => 'required|unique:applicants,email',
        'accept_terms' => 'required',
        'password'  => 'required|confirmed'
    ];

    public function directors() {
        return $this->hasMany(OperatorDirector::class);
    }
    
}
