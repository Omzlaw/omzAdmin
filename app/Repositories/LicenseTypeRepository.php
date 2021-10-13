<?php

namespace App\Repositories;

use App\Models\LicenseType;
use App\Repositories\BaseRepository;

/**
 * Class LicenseTypeRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:03 pm UTC
*/

class LicenseTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'code',
        'description',
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
        return LicenseType::class;
    }
}
