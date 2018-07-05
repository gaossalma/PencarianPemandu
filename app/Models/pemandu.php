<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pemandu
 * @package App\Models
 * @version July 5, 2018, 6:28 pm UTC
 */
class pemandu extends Model
{
    use SoftDeletes;

    public $table = 'pemandus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'fullname',
        'email',
        'jenis_kelamin',
        'nomor_tlp',
        'longitude',
        'latitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fullname' => 'string',
        'email' => 'string',
        'jenis_kelamin' => 'string',
        'nomor_tlp' => 'string',
        'longitude' => 'string',
        'latitude' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fullname' => 'required',
        'email' => 'required',
        'jenis_kelamin' => 'required',
        'nomor_tlp' => 'required',
        'longitude' => 'required',
        'latitude' => 'required'
    ];

    
}
