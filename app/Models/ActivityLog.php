<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="ActivityLog",
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
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="time",
 *          description="time",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="activity_by",
 *          description="activity_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      )
 * )
 */
class ActivityLog extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'activity_logs';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'time',
        'activity_by',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'time' => 'string',
        'activity_by' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activityBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'activity_by', 'id');
    }
    
}
