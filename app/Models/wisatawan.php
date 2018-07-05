<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class wisatawan
 * @package App\Models
 * @version July 5, 2018, 5:57 pm UTC
 */
class wisatawan extends Model
{
    use SoftDeletes;

    public $table = 'wisatawans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'fullname',
        'email',
        'jenis_kelamin',
        'nomor_tlp',
        'negara',
        'tanggal_lahir'
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
        'negara' => 'string',
        'tanggal_lahir' => 'string'
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
        'negara' => 'required',
        'tanggal_lahir' => 'required'
    ];

    
}
