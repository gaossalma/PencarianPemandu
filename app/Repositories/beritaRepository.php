<?php

namespace App\Repositories;

use App\Models\berita;
use InfyOm\Generator\Common\BaseRepository;

class beritaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'judul',
        'isi'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return berita::class;
    }
}
