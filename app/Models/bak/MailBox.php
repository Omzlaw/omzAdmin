<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="MailBox",
 *      required={"subject", "message"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="subject",
 *          description="subject",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="message",
 *          description="message",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="sent_by",
 *          description="sent_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="received_by",
 *          description="received_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="is_read",
 *          description="is_read",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="sender_delete",
 *          description="sender_delete",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="receiver_delete",
 *          description="receiver_delete",
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
class MailBox extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'mail_boxes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'subject',
        'message',
        'sent_by',
        'received_by',
        'is_read',
        'sender_delete',
        'receiver_delete'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'sent_by' => 'integer',
        'received_by' => 'integer',
        'is_read' => 'boolean',
        'sender_delete' => 'boolean',
        'receiver_delete' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required',
        'message' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sentBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'sent_by', 'id');
    }
}
