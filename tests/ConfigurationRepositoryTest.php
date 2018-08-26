<?php

use App\Models\Configuration;
use App\Repositories\ConfigurationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConfigurationRepositoryTest extends TestCase
{
    use MakeConfigurationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConfigurationRepository
     */
    protected $configurationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->configurationRepo = App::make(ConfigurationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateConfiguration()
    {
        $configuration = $this->fakeConfigurationData();
        $createdConfiguration = $this->configurationRepo->create($configuration);
        $createdConfiguration = $createdConfiguration->toArray();
        $this->assertArrayHasKey('id', $createdConfiguration);
        $this->assertNotNull($createdConfiguration['id'], 'Created Configuration must have id specified');
        $this->assertNotNull(Configuration::find($createdConfiguration['id']), 'Configuration with given id must be in DB');
        $this->assertModelData($configuration, $createdConfiguration);
    }

    /**
     * @test read
     */
    public function testReadConfiguration()
    {
        $configuration = $this->makeConfiguration();
        $dbConfiguration = $this->configurationRepo->find($configuration->id);
        $dbConfiguration = $dbConfiguration->toArray();
        $this->assertModelData($configuration->toArray(), $dbConfiguration);
    }

    /**
     * @test update
     */
    public function testUpdateConfiguration()
    {
        $configuration = $this->makeConfiguration();
        $fakeConfiguration = $this->fakeConfigurationData();
        $updatedConfiguration = $this->configurationRepo->update($fakeConfiguration, $configuration->id);
        $this->assertModelData($fakeConfiguration, $updatedConfiguration->toArray());
        $dbConfiguration = $this->configurationRepo->find($configuration->id);
        $this->assertModelData($fakeConfiguration, $dbConfiguration->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteConfiguration()
    {
        $configuration = $this->makeConfiguration();
        $resp = $this->configurationRepo->delete($configuration->id);
        $this->assertTrue($resp);
        $this->assertNull(Configuration::find($configuration->id), 'Configuration should not exist in DB');
    }
}
