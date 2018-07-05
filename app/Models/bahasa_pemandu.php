<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bahasa_pemandu
 * @package App\Models
 * @version July 5, 2018, 6:33 pm UTC
 */
class bahasa_pemandu extends Model
{
    use SoftDeletes;

    public $table = 'bahasa_pemandus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_pemandu',
        'id_bahasa'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_pemandu' => 'integer',
        'id_bahasa' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_pemandu' => 'required',
        'id_bahasa' => 'required'
    ];

    
}
