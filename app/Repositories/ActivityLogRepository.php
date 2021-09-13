<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use App\Repositories\BaseRepository;

/**
 * Class ActivityLogRepository
 * @package App\Repositories
 * @version September 9, 2021, 8:28 pm UTC
*/

class ActivityLogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'time',
        'activity_by',
        'description'
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
        return ActivityLog::class;
    }
}
