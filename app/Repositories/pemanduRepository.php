<?php

namespace App\Repositories;

use App\Models\pemandu;
use InfyOm\Generator\Common\BaseRepository;

class pemanduRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fullname',
        'email',
        'jenis_kelamin',
        'nomor_tlp',
        'longitude',
        'latitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return pemandu::class;
    }
}
