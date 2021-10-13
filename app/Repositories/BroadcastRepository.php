<?php

namespace App\Repositories;

use App\Models\Broadcast;
use App\Repositories\BaseRepository;

/**
 * Class BroadcastRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:03 pm UTC
*/

class BroadcastRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'code',
        'subject',
        'message',
        'date_start',
        'date_end',
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
        return Broadcast::class;
    }
}
