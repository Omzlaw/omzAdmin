<?php

namespace App\Repositories;

use App\Models\GamesPlayed;
use App\Repositories\BaseRepository;

/**
 * Class GamesPlayedRepository
 * @package App\Repositories
 * @version October 11, 2021, 9:21 pm UTC
*/

class GamesPlayedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'operator_id',
        'status',
        'amount',
        'type',
        'scheme'
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
        return GamesPlayed::class;
    }
}
