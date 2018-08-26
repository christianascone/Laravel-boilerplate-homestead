<?php

namespace App\Models;

use DateTime;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Quiz
 * @package App\Models
 * @version August 21, 2018, 7:30 am UTC
 *
 * @property string name
 * @property string description
 * @property date start_date
 */
class Quiz extends Model
{
    use SoftDeletes;

    public $table = 'quizzes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'start_date',
        'current_state_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'current_state_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'start_date' => 'required'
    ];

    public function start_date_form (){
        return new DateTime($this->start_date);
    }
}
