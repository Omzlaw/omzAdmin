<?php

namespace App\Repositories;

use App\Models\OperatorLicense;
use App\Repositories\BaseRepository;

/**
 * Class OperatorLicenseRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:04 pm UTC
*/

class OperatorLicenseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'order_no',
        'operator_id',
        'license_type_id',
        'due_date',
        'date_last_paid',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OperatorLicense::class;
    }
}
