<?php

use Faker\Factory as Faker;
use App\Models\Quiz;
use App\Repositories\QuizRepository;

trait MakeQuizTrait
{
    /**
     * Create fake instance of Quiz and save it in database
     *
     * @param array $quizFields
     * @return Quiz
     */
    public function makeQuiz($quizFields = [])
    {
        /** @var QuizRepository $quizRepo */
        $quizRepo = App::make(QuizRepository::class);
        $theme = $this->fakeQuizData($quizFields);
        return $quizRepo->create($theme);
    }

    /**
     * Get fake instance of Quiz
     *
     * @param array $quizFields
     * @return Quiz
     */
    public function fakeQuiz($quizFields = [])
    {
        return new Quiz($this->fakeQuizData($quizFields));
    }

    /**
     * Get fake data of Quiz
     *
     * @param array $postFields
     * @return array
     */
    public function fakeQuizData($quizFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'start_date' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $quizFields);
    }
}
