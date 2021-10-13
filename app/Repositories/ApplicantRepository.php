<?php

namespace App\Repositories;

use App\Models\Applicant;
use App\Repositories\BaseRepository;

/**
 * Class ApplicantRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:03 pm UTC
*/

class ApplicantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'RC_number',
        'address',
        'phone',
        'website',
        'logo',
        'email',
        'no_of_shareholders',
        'shareholders_details',
        'no_of_directors',
        'directors_details',
        'has_previously_applied',
        'owners_convicted',
        'conviction_details',
        'Is_director_politician',
        'has_pending_application',
        'prev_application_details',
        'is_shareholder_politician',
        'accept_terms',
        'application_status'
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
        return Applicant::class;
    }
}
