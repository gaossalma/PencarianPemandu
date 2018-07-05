<?php

namespace App\Repositories;

use App\Models\destinasi;
use InfyOm\Generator\Common\BaseRepository;

class destinasiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'kode',
        'nama',
        'deskripsi',
        'longitude',
        'latitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return destinasi::class;
    }
}
