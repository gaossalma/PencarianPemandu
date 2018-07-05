<?php

namespace App\Repositories;

use App\Models\wisatawan;
use InfyOm\Generator\Common\BaseRepository;

class wisatawanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fullname',
        'email',
        'jenis_kelamin',
        'nomor_tlp',
        'negara',
        'tanggal_lahir'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return wisatawan::class;
    }
}
