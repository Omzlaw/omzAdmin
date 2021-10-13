<?php

namespace App\Repositories;

use App\Models\OperatorType;
use App\Repositories\BaseRepository;

/**
 * Class OperatorTypeRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:04 pm UTC
*/

class OperatorTypeRepository extends BaseRepository
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
        return OperatorType::class;
    }
}
