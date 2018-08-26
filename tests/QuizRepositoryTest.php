<?php

use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuizRepositoryTest extends TestCase
{
    use MakeQuizTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuizRepository
     */
    protected $quizRepo;

    public function setUp()
    {
        parent::setUp();
        $this->quizRepo = App::make(QuizRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateQuiz()
    {
        $quiz = $this->fakeQuizData();
        $createdQuiz = $this->quizRepo->create($quiz);
        $createdQuiz = $createdQuiz->toArray();
        $this->assertArrayHasKey('id', $createdQuiz);
        $this->assertNotNull($createdQuiz['id'], 'Created Quiz must have id specified');
        $this->assertNotNull(Quiz::find($createdQuiz['id']), 'Quiz with given id must be in DB');
        $this->assertModelData($quiz, $createdQuiz);
    }

    /**
     * @test read
     */
    public function testReadQuiz()
    {
        $quiz = $this->makeQuiz();
        $dbQuiz = $this->quizRepo->find($quiz->id);
        $dbQuiz = $dbQuiz->toArray();
        $this->assertModelData($quiz->toArray(), $dbQuiz);
    }

    /**
     * @test update
     */
    public function testUpdateQuiz()
    {
        $quiz = $this->makeQuiz();
        $fakeQuiz = $this->fakeQuizData();
        $updatedQuiz = $this->quizRepo->update($fakeQuiz, $quiz->id);
        $this->assertModelData($fakeQuiz, $updatedQuiz->toArray());
        $dbQuiz = $this->quizRepo->find($quiz->id);
        $this->assertModelData($fakeQuiz, $dbQuiz->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteQuiz()
    {
        $quiz = $this->makeQuiz();
        $resp = $this->quizRepo->delete($quiz->id);
        $this->assertTrue($resp);
        $this->assertNull(Quiz::find($quiz->id), 'Quiz should not exist in DB');
    }
}
