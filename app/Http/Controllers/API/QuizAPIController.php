<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuizAPIRequest;
use App\Http\Requests\API\UpdateQuizAPIRequest;
use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuizController
 * @package App\Http\Controllers\API
 */

class QuizAPIController extends AppBaseController
{
    /** @var  QuizRepository */
    private $quizRepository;

    public function __construct(QuizRepository $quizRepo)
    {
        $this->quizRepository = $quizRepo;
    }

    /**
     * Display a listing of the Quiz.
     * GET|HEAD /quizzes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->quizRepository->pushCriteria(new RequestCriteria($request));
        $this->quizRepository->pushCriteria(new LimitOffsetCriteria($request));
        $quizzes = $this->quizRepository->all();

        return $this->sendResponse($quizzes->toArray(), 'Quizzes retrieved successfully');
    }

    /**
     * Store a newly created Quiz in storage.
     * POST /quizzes
     *
     * @param CreateQuizAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuizAPIRequest $request)
    {
        $input = $request->all();

        $quizzes = $this->quizRepository->create($input);

        return $this->sendResponse($quizzes->toArray(), 'Quiz saved successfully');
    }

    /**
     * Display the specified Quiz.
     * GET|HEAD /quizzes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Quiz $quiz */
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            return $this->sendError('Quiz not found');
        }

        return $this->sendResponse($quiz->toArray(), 'Quiz retrieved successfully');
    }

    /**
     * Update the specified Quiz in storage.
     * PUT/PATCH /quizzes/{id}
     *
     * @param  int $id
     * @param UpdateQuizAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuizAPIRequest $request)
    {
        $input = $request->all();

        /** @var Quiz $quiz */
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            return $this->sendError('Quiz not found');
        }

        $quiz = $this->quizRepository->update($input, $id);

        return $this->sendResponse($quiz->toArray(), 'Quiz updated successfully');
    }

    /**
     * Remove the specified Quiz from storage.
     * DELETE /quizzes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Quiz $quiz */
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            return $this->sendError('Quiz not found');
        }

        $quiz->delete();

        return $this->sendResponse($id, 'Quiz deleted successfully');
    }
}
