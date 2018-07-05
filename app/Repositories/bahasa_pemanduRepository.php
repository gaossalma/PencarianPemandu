<?php

namespace App\Repositories;

use App\Models\bahasa_pemandu;
use InfyOm\Generator\Common\BaseRepository;

class bahasa_pemanduRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_pemandu',
        'id_bahasa'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bahasa_pemandu::class;
    }
}
