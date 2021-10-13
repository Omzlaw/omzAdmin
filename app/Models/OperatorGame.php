<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="OperatorGame",
 *      required={"operator_id", "name", "amount", "operator_scheme_id", "how_it_works"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="operator_id",
 *          description="operator_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="operator_scheme_id",
 *          description="operator_scheme_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="how_it_works",
 *          description="how_it_works",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="remark",
 *          description="remark",
 *          type="string"
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
class OperatorGame extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'operator_games';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'operator_id',
        'name',
        'amount',
        'operator_scheme_id',
        'how_it_works',
        'status',
        'remark'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'operator_id' => 'integer',
        'name' => 'string',
        'amount' => 'decimal:2',
        'operator_scheme_id' => 'integer',
        'how_it_works' => 'string',
        'status' => 'boolean',
        'remark' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'operator_id' => 'required',
        'name' => 'required',
        'amount' => 'required',
        'operator_scheme_id' => 'required',
        'how_it_works' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operator()
    {
        return $this->belongsTo(\App\Models\Operator::class, 'operator_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operatorScheme()
    {
        return $this->belongsTo(\App\Models\OperatorScheme::class, 'operator_scheme_id', 'id');
    }
}
