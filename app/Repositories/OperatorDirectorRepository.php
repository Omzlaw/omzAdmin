<?php

namespace App\Repositories;

use App\Models\OperatorDirector;
use App\Repositories\BaseRepository;

/**
 * Class OperatorDirectorRepository
 * @package App\Repositories
 * @version September 30, 2021, 11:27 am UTC
*/

class OperatorDirectorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone_number',
        'email',
        'other_phone_number',
        'is_director_shareholder',
        'operator_id',
        'applicant_id',
        'shareholder_type',
        'number_of_shares'
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
        return OperatorDirector::class;
    }
}
