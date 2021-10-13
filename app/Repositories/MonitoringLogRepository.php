<?php

namespace App\Repositories;

use App\Models\MonitoringLog;
use App\Repositories\BaseRepository;

/**
 * Class MonitoringLogRepository
 * @package App\Repositories
 * @version October 11, 2021, 9:05 am UTC
*/

class MonitoringLogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'operator',
        'operator_id',
        'website',
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
        return MonitoringLog::class;
    }
}
