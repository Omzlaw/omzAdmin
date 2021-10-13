<?php

namespace App\Repositories;

use App\Models\LicenseChecklist;
use App\Repositories\BaseRepository;

/**
 * Class LicenseChecklistRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:03 pm UTC
*/

class LicenseChecklistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'requirement',
        'is_lottery',
        'is_sportbet',
        'is_mobile_gaming',
        'is_promo',
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
        return LicenseChecklist::class;
    }
}
