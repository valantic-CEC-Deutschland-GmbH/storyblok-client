<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\Storyblok\InternalClient;

interface ClientInterface
{
    /**
     * @param string $cmsPageSlug
     *
     * @return array
     */
    public function getCmsPage(string $cmsPageSlug): array;

    /**
     * @return array
     */
    public function getMainNavigation(): array;

    /**
     * @return array
     */
    public function getFooter(): array;

    /**
     * @param array $request
     *
     * @return bool
     */
    public function isPreviewMode(array $request): bool;

    /**
     * @param array $options
     *
     * @return array
     */
    public function getStories(array $options): array;
}
