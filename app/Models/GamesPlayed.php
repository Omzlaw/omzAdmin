<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="GamesPlayed",
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
 *          property="operator_id",
 *          description="operator_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="token",
 *          description="token",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="scheme",
 *          description="scheme",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class GamesPlayed extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'games_played';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'operator_id',
        'token',
        'status',
        'amount',
        'type',
        'scheme'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'operator_id' => 'integer',
        'token' => 'string',
        'status' => 'integer',
        'amount' => 'decimal:2',
        'type' => 'integer',
        'scheme' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'operator_id' => 'Required',
        'amount' => 'Required',
        'type' => 'Required',
        'scheme' => 'Required',
    ];

    
}
