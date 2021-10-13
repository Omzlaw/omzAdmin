<?php

namespace App\Repositories;

use App\Models\OperatorScheme;
use App\Repositories\BaseRepository;

/**
 * Class OperatorSchemeRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:04 pm UTC
*/

class OperatorSchemeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'play_mode',
        'description',
        'operator_id',
        'status',
        'start_date',
        'end_date'
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
        return OperatorScheme::class;
    }
}
