<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\Storyblok;

use Spryker\Client\Kernel\AbstractBundleConfig;
use ValanticSpryker\Shared\Storyblok\StoryblokConstants;

class StoryblokConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getStoryBlokMainNavigationSlug(): string
    {
        return $this->get(StoryblokConstants::SLUG_NAVIGATION_MAIN);
    }

    /**
     * @return string
     */
    public function getStoryBlokFooterSlug(): string
    {
        return $this->get(StoryblokConstants::SLUG_FOOTER);
    }

    /**
     * @return string
     */
    public function getStoryblokPublicSecret(): string
    {
        return $this->get(StoryblokConstants::STORYBLOK_PUBLIC_SECRET);
    }

    /**
     * @return string
     */
    public function getStoryblokPreviewSecret(): string
    {
        return $this->get(StoryblokConstants::STORYBLOK_PREVIEW_SECRET);
    }

    /**
     * @return int
     */
    public function getStoryblokSessionExpirationTime(): int
    {
        return $this->get(StoryblokConstants::STORYBLOK_EXPIRATION_TIME);
    }

    /**
     * @return string
     */
    public function getStoryBlokCmsSlug(): string
    {
        return $this->get(StoryblokConstants::SLUG_CMS_CONTENT);
    }
}
