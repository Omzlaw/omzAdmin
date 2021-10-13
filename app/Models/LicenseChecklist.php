<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="LicenseChecklist",
 *      required={"requirement"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="requirement",
 *          description="requirement",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_lottery",
 *          description="is_lottery",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_sportbet",
 *          description="is_sportbet",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_mobile_gaming",
 *          description="is_mobile_gaming",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_promo",
 *          description="is_promo",
 *          type="boolean"
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
class LicenseChecklist extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'license_checklists';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'requirement',
        'is_lottery',
        'is_sportbet',
        'is_mobile_gaming',
        'is_promo',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'requirement' => 'string',
        'is_lottery' => 'boolean',
        'is_sportbet' => 'boolean',
        'is_mobile_gaming' => 'boolean',
        'is_promo' => 'boolean',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'requirement' => 'required'
    ];

    
}
