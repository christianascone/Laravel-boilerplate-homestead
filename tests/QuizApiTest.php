<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuizApiTest extends TestCase
{
    use MakeQuizTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateQuiz()
    {
        $quiz = $this->fakeQuizData();
        $this->json('POST', '/api/v1/quizzes', $quiz);

        $this->assertApiResponse($quiz);
    }

    /**
     * @test
     */
    public function testReadQuiz()
    {
        $quiz = $this->makeQuiz();
        $this->json('GET', '/api/v1/quizzes/'.$quiz->id);

        $this->assertApiResponse($quiz->toArray());
    }

    /**
     * @test
     */
    public function testUpdateQuiz()
    {
        $quiz = $this->makeQuiz();
        $editedQuiz = $this->fakeQuizData();

        $this->json('PUT', '/api/v1/quizzes/'.$quiz->id, $editedQuiz);

        $this->assertApiResponse($editedQuiz);
    }

    /**
     * @test
     */
    public function testDeleteQuiz()
    {
        $quiz = $this->makeQuiz();
        $this->json('DELETE', '/api/v1/quizzes/'.$quiz->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/quizzes/'.$quiz->id);

        $this->assertResponseStatus(404);
    }
}
