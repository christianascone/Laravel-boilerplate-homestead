<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConfigurationApiTest extends TestCase
{
    use MakeConfigurationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateConfiguration()
    {
        $configuration = $this->fakeConfigurationData();
        $this->json('POST', '/api/v1/configurations', $configuration);

        $this->assertApiResponse($configuration);
    }

    /**
     * @test
     */
    public function testReadConfiguration()
    {
        $configuration = $this->makeConfiguration();
        $this->json('GET', '/api/v1/configurations/'.$configuration->id);

        $this->assertApiResponse($configuration->toArray());
    }

    /**
     * @test
     */
    public function testUpdateConfiguration()
    {
        $configuration = $this->makeConfiguration();
        $editedConfiguration = $this->fakeConfigurationData();

        $this->json('PUT', '/api/v1/configurations/'.$configuration->id, $editedConfiguration);

        $this->assertApiResponse($editedConfiguration);
    }

    /**
     * @test
     */
    public function testDeleteConfiguration()
    {
        $configuration = $this->makeConfiguration();
        $this->json('DELETE', '/api/v1/configurations/'.$configuration->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/configurations/'.$configuration->id);

        $this->assertResponseStatus(404);
    }
}
