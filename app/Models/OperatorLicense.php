<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="OperatorLicense",
 *      required={"operator_id", "license_type_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="order_no",
 *          description="order_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="operator_id",
 *          description="operator_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="license_type_id",
 *          description="license_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="due_date",
 *          description="due_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="date_last_paid",
 *          description="date_last_paid",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
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
class OperatorLicense extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'operator_licenses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_no',
        'operator_id',
        'license_type_id',
        'due_date',
        'date_last_paid',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_no' => 'string',
        'operator_id' => 'integer',
        'license_type_id' => 'integer',
        'due_date' => 'date',
        'date_last_paid' => 'date',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'operator_id' => 'required',
        'license_type_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class, 'operator_id', 'id');
    }
}
