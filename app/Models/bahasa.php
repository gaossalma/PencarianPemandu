<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bahasa
 * @package App\Models
 * @version July 5, 2018, 6:02 pm UTC
 */
class bahasa extends Model
{
    use SoftDeletes;

    public $table = 'bahasas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'kode',
        'bahasa'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'kode' => 'string',
        'bahasa' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kode' => 'required',
        'bahasa' => 'required'
    ];

    
}
