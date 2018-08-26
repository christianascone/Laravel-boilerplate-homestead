<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Repositories\QuizRepository;
use App\Http\Controllers\AppBaseController;
use DateTime;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QuizController extends AppBaseController
{
    /** @var  QuizRepository */
    private $quizRepository;

    public function __construct(QuizRepository $quizRepo)
    {
        $this->quizRepository = $quizRepo;
    }

    /**
     * Display a listing of the Quiz.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->quizRepository->pushCriteria(new RequestCriteria($request));
        $quizzes = $this->quizRepository->all();

        return view('quizzes.index')
            ->with('quizzes', $quizzes);
    }

    /**
     * Show the form for creating a new Quiz.
     *
     * @return Response
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created Quiz in storage.
     *
     * @param CreateQuizRequest $request
     *
     * @return Response
     */
    public function store(CreateQuizRequest $request)
    {
        $input = $request->all();

        $input = $this->convertStartDateToDate($input);

        $quiz = $this->quizRepository->create($input);

        Flash::success('Quiz saved successfully.');

        return redirect(route('quizzes.index'));
    }

    /**
     * Display the specified Quiz.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            Flash::error('Quiz not found');

            return redirect(route('quizzes.index'));
        }

        return view('quizzes.show')->with('quiz', $quiz);
    }

    /**
     * Show the form for editing the specified Quiz.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            Flash::error('Quiz not found');

            return redirect(route('quizzes.index'));
        }

        return view('quizzes.edit')->with('quiz', $quiz);
    }

    /**
     * Update the specified Quiz in storage.
     *
     * @param  int              $id
     * @param UpdateQuizRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuizRequest $request)
    {
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            Flash::error('Quiz not found');

            return redirect(route('quizzes.index'));
        }

        $input = $request->all();
        $input = $this->convertStartDateToDate($input);

        $quiz = $this->quizRepository->update($input, $id);

        Flash::success('Quiz updated successfully.');

        return redirect(route('quizzes.index'));
    }

    /**
     * Remove the specified Quiz from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quiz = $this->quizRepository->findWithoutFail($id);

        if (empty($quiz)) {
            Flash::error('Quiz not found');

            return redirect(route('quizzes.index'));
        }

        $this->quizRepository->delete($id);

        Flash::success('Quiz deleted successfully.');

        return redirect(route('quizzes.index'));
    }

    /**
     * @param $input
     * @return mixed
     */
    private function convertStartDateToDate($input)
    {
        $input['start_date'] = new DateTime($input['start_date']);
        return $input;
    }
}
