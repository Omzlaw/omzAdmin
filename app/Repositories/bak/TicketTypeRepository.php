<?php

namespace App\Repositories;

use App\Models\TicketType;
use App\Repositories\BaseRepository;

/**
 * Class TicketTypeRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:05 pm UTC
*/

class TicketTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
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
        return TicketType::class;
    }
}
