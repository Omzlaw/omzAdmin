<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Ticket",
 *      required={"subject", "ticket_type_id", "complain"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="subject",
 *          description="subject",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ticket_type_id",
 *          description="ticket_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="complain",
 *          description="complain",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="file_upoad",
 *          description="file_upoad",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="assigned_to",
 *          description="assigned_to",
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
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="action_taken",
 *          description="action_taken",
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
class Ticket extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tickets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'subject',
        'ticket_type_id',
        'complain',
        'file_upoad',
        'assigned_to',
        'operator_id',
        'status',
        'action_taken'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject' => 'string',
        'ticket_type_id' => 'integer',
        'complain' => 'string',
        'file_upoad' => 'string',
        'assigned_to' => 'integer',
        'operator_id' => 'integer',
        'status' => 'integer',
        'action_taken' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required',
        'ticket_type_id' => 'required',
        'complain' => 'required'
    ];

    
}
