<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Pterodactyl\Services\Nests\NestCreationService;
use Pterodactyl\Contracts\Repository\NestRepositoryInterface;

class NestSeeder extends Seeder
{
    /**
     * @var \Pterodactyl\Services\Nests\NestCreationService
     */
    private $creationService;

    /**
     * @var \Pterodactyl\Contracts\Repository\NestRepositoryInterface
     */
    private $repository;

    /**
     * NestSeeder constructor.
     */
    public function __construct(
        NestCreationService $creationService,
        NestRepositoryInterface $repository
    ) {
        $this->creationService = $creationService;
        $this->repository = $repository;
    }

    /**
     * Run the seeder to add missing nests to the Panel.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    public function run()
    {
        $items = $this->repository->findWhere([
            'author' => 'nest@wafflestudio.xyz',
        ])->keyBy('name')->toArray();

        $this->createMinecraftNest(array_get($items, 'Minecraft'));
        $this->createVoiceServersNest(array_get($items, 'Voice Servers'));
        $this->createNginxNest(array_get($items, 'Nginx'));
        $this->createAllInOneNest(array_get($items, 'All in one'));
    }

    /**
     * Create the Minecraft nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createMinecraftNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Minecraft',
                'description' => '',
            ], 'nest@wafflestudio.xyz');
        }
    }
    
    /**
     * Create the Voice Servers nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createVoiceServersNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Voice Servers',
                'description' => '',
            ], 'nest@wafflestudio.xyz');
        }
    }

    /**
     * Create the Nginx nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createNginxNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'Nginx',
                'description' => '',
            ], 'nest@wafflestudio.xyz');
        }
    }

    /**
     * Create the All in one nest to be used later on.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    private function createAllInOneNest(array $nest = null)
    {
        if (is_null($nest)) {
            $this->creationService->handle([
                'name' => 'All in one',
                'description' => '',
            ], 'nest@wafflestudio.xyz');
        }
    }
}
