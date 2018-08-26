<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Configuration
 * @package App\Models
 * @version August 22, 2018, 2:16 pm UTC
 *
 * @property string key
 * @property string value
 */
class Configuration extends Model
{
    use SoftDeletes;

    public $table = 'configurations';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'key',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'value' => 'required'
    ];

    
}
