<?php

namespace App\Repositories;

use App\Models\Quiz;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuizRepository
 * @package App\Repositories
 * @version August 21, 2018, 7:30 am UTC
 *
 * @method Quiz findWithoutFail($id, $columns = ['*'])
 * @method Quiz find($id, $columns = ['*'])
 * @method Quiz first($columns = ['*'])
*/
class QuizRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'start_date',
        'current_state_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Quiz::class;
    }
}
