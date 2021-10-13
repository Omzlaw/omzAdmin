<?php

namespace App\Repositories;

use App\Models\MailBox;
use App\Repositories\BaseRepository;

/**
 * Class MailBoxRepository
 * @package App\Repositories
 * @version September 29, 2021, 10:03 pm UTC
*/

class MailBoxRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'code',
        'subject',
        'message',
        'sent_by',
        'received_by',
        'is_read',
        'sender_delete',
        'receiver_delete'
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
        return MailBox::class;
    }
}
