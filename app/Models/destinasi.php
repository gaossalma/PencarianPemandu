<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class destinasi
 * @package App\Models
 * @version July 5, 2018, 6:21 pm UTC
 */
class destinasi extends Model
{
    use SoftDeletes;

    public $table = 'destinasis';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'longitude',
        'latitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'kode' => 'string',
        'nama' => 'string',
        'deskripsi' => 'string',
        'longitude' => 'string',
        'latitude' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kode' => 'required',
        'nama' => 'required',
        'deskripsi' => 'required'
    ];

    
}
