<?php

use Faker\Factory as Faker;
use App\Models\Configuration;
use App\Repositories\ConfigurationRepository;

trait MakeConfigurationTrait
{
    /**
     * Create fake instance of Configuration and save it in database
     *
     * @param array $configurationFields
     * @return Configuration
     */
    public function makeConfiguration($configurationFields = [])
    {
        /** @var ConfigurationRepository $configurationRepo */
        $configurationRepo = App::make(ConfigurationRepository::class);
        $theme = $this->fakeConfigurationData($configurationFields);
        return $configurationRepo->create($theme);
    }

    /**
     * Get fake instance of Configuration
     *
     * @param array $configurationFields
     * @return Configuration
     */
    public function fakeConfiguration($configurationFields = [])
    {
        return new Configuration($this->fakeConfigurationData($configurationFields));
    }

    /**
     * Get fake data of Configuration
     *
     * @param array $postFields
     * @return array
     */
    public function fakeConfigurationData($configurationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'key' => $fake->text,
            'value' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $configurationFields);
    }
}
