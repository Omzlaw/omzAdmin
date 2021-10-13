<?php

namespace App\Repositories;

use App\Models\OperatorGame;
use App\Repositories\BaseRepository;

/**
 * Class OperatorGameRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:04 pm UTC
*/

class OperatorGameRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'operator_id',
        'name',
        'amount',
        'operator_scheme_id',
        'how_it_works',
        'status',
        'remark'
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
        return OperatorGame::class;
    }
}
