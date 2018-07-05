<?php

namespace App\Repositories;

use App\Models\bahasa;
use InfyOm\Generator\Common\BaseRepository;

class bahasaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'kode',
        'bahasa'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bahasa::class;
    }
}
