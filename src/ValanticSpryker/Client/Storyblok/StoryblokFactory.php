<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\Storyblok;

use Spryker\Client\Kernel\AbstractFactory;
use Storyblok\Client;
use ValanticSpryker\Client\Storyblok\InternalClient\ClientInterface;
use ValanticSpryker\Client\Storyblok\InternalClient\ClientWithConfig;

/**
 * @method \ValanticSpryker\Client\Storyblok\StoryblokConfig getConfig()
 */
class StoryblokFactory extends AbstractFactory
{
    /**
     * @return \Storyblok\Client
     */
    public function getRawStoryblokPublicClient(): Client
    {
        return $this->getProvidedDependency(StoryblokDependencyProvider::CLIENT_STORYBLOK_PUBLIC);
    }

    /**
     * @return \Storyblok\Client
     */
    private function getRawStoryblokPreviewClient(): Client
    {
        return $this->getProvidedDependency(StoryblokDependencyProvider::CLIENT_STORYBLOK_PREVIEW);
    }

    /**
     * @return \ValanticSpryker\Client\Storyblok\InternalClient\ClientInterface
     */
    public function createStoryblokPublicClient(): ClientInterface
    {
        return new ClientWithConfig(
            $this->getRawStoryblokPublicClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \ValanticSpryker\Client\Storyblok\InternalClient\ClientInterface
     */
    public function createStoryblokPreviewClient(): ClientInterface
    {
        return new ClientWithConfig(
            $this->getRawStoryblokPreviewClient(),
            $this->getConfig(),
        );
    }
}
