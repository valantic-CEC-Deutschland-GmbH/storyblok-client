<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\Storyblok;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Storyblok\Client;

/**
 * @method \ValanticSpryker\Client\Storyblok\StoryblokConfig getConfig()
 */
class StoryblokDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_STORYBLOK_PUBLIC = 'CLIENT_STORYBLOK_PUBLIC';

    /**
     * @var string
     */
    public const CLIENT_STORYBLOK_PREVIEW = 'CLIENT_STORYBLOK_PREVIEW';

    /**
     * @var string
     */
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addStoryBlockPublicClient($container);
        $container = $this->addStoryBlockPreviewClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addStoryBlockPublicClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORYBLOK_PUBLIC, function () {
            $client = new Client($this->getConfig()->getStoryblokPublicSecret());
            $client->editMode(false);

            return $client;
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addStoryBlockPreviewClient(Container $container): Container
    {
        $container->set(static::CLIENT_STORYBLOK_PREVIEW, function () {
            $client = new Client($this->getConfig()->getStoryblokPreviewSecret());
            $client->editMode(true);

            return $client;
        });

        return $container;
    }
}
