<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="OperatorDirector",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *      ),
 *      @SWG\Property(
 *          property="first_name",
 *          description="first_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_name",
 *          description="last_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="middle_name",
 *          description="middle_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone_number",
 *          description="phone_number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="other_phone_number",
 *          description="other_phone_number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="is_director_shareholder",
 *          description="is_director_shareholder",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="operator_id",
 *          description="operator_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="applicant_id",
 *          description="applicant_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="shareholder_type",
 *          description="shareholder_type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="number_of_shares",
 *          description="number_of_shares",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class OperatorDirector extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'operator_directors';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone_number',
        'email',
        'other_phone_number',
        'is_director_shareholder',
        'is_politician',
        'has_been_convicted',
        'conviction_details',
        'operator_id',
        'applicant_id',
        'shareholder_type',
        'number_of_shares'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'middle_name' => 'string',
        'phone_number' => 'integer',
        'email' => 'string',
        'other_phone_number' => 'integer',
        'is_director_shareholder' => 'string',
        'is_politician' => 'string',
        'has_been_convicted' => 'string',
        'conviction_details' => 'string',
        'operator_id' => 'string',
        'applicant_id' => 'string',
        'shareholder_type' => 'string',
        'number_of_shares' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'Required',
        'last_name' => 'Required',
        'email' => 'Required',
        'phone_number' => 'Required',
        'is_director_shareholder' => 'Required',
        'is_politician' => 'Required',
        'has_been_convicted' => 'Required',
        'number_of_shares' => 'Required',
        'shareholder_type' => 'Required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function applicant()
    {
        return $this->belongsTo(\App\Models\Applicant::class, 'applicant_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class, 'operator_id', 'id');
    }
}
