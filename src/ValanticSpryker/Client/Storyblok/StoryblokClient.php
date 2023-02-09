<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\Storyblok;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \ValanticSpryker\Client\Storyblok\StoryblokFactory getFactory()
 */
class StoryblokClient extends AbstractClient implements StoryblokClientInterface
{
    /**
     * @param string $cmsPageSlug
     *
     * @return array
     */
    public function getCmsPage(string $cmsPageSlug): array
    {
        return $this->getFactory()
            ->createStoryblokPublicClient()
            ->getCmsPage($cmsPageSlug);
    }

    /**
     * @return array
     */
    public function getMainNavigation(): array
    {
        return $this->getFactory()
            ->createStoryblokPublicClient()
            ->getMainNavigation();
    }

    /**
     * @return array
     */
    public function getFooter(): array
    {
        return $this->getFactory()
            ->createStoryblokPublicClient()
            ->getFooter();
    }

    /**
     * @param string $slug
     *
     * @return array
     */
    public function getCmsPagePreview(string $slug): array
    {
        return $this->getFactory()
            ->createStoryblokPreviewClient()
            ->getCmsPage($slug);
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    public function isPreviewMode(array $request): bool
    {
        return $this->getFactory()
            ->createStoryblokPreviewClient()
            ->isPreviewMode($request);
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function getStories(array $options): array
    {
        return $this->getFactory()
            ->createStoryblokPublicClient()
            ->getStories($options);
    }
}
