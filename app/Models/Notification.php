<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Notification",
 *      required={"type", "notifiable_type", "notifiable_id", "data"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="notifiable_type",
 *          description="notifiable_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="notifiable_id",
 *          description="notifiable_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          description="data",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="read_at",
 *          description="read_at",
 *          type="string",
 *          format="date-time"
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
class Notification extends Model
{

    use HasFactory;

    public $table = 'notifications';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'type' => 'string',
        'notifiable_type' => 'string',
        'notifiable_id' => 'integer',
        'data' => 'string',
        'read_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|string|max:255',
        'notifiable_type' => 'required|string|max:255',
        'notifiable_id' => 'required',
        'data' => 'required|string',
        'read_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
