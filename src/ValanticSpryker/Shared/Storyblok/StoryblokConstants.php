<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\Storyblok;

interface StoryblokConstants
{
    /**
     * @var string
     */
    public const STORYBLOK_PUBLIC_SECRET = 'STORYBLOK_CONSTANTS:STORYBLOCK_PUBLIC_SECRET';

    /**
     * @var string
     */
    public const STORYBLOK_PREVIEW_SECRET = 'STORYBLOK_CONSTANTS:STORYBLOK_PREVIEW_SECRET';

    /**
     * @var string
     */
    public const SLUG_NAVIGATION_MAIN = 'STORYBLOK_CONSTANTS:SLUG:NAVIGATION_MAIN';

    /**
     * @var string
     */
    public const SLUG_FOOTER = 'STORYBLOK_CONSTANTS:SLUG:NAVIGATION_FOOTER';

    /**
     * @var string
     */
    public const SLUG_CMS_CONTENT = 'STORYBLOK_CONSTANTS:SLUG:CMS_CONTENT';

    /**
     * @var string
     */
    public const STORYBLOK_EXPIRATION_TIME = 'STORYBLOK_CONSTANTS:STORYBLOK_EXPIRATION_TIME';

    /**
     * @var string
     */
    public const TOKEN = 'token';

    /**
     * @var string
     */
    public const SPACE_ID = 'space_id';

    /**
     * @var string
     */
    public const TIMESTAMP = 'timestamp';

    /**
     * @var string
     */
    public const AVAILABLE_STORY_PAGES_COUNT = 'numberOfPagesAvailable';

    /**
     * @var string
     */
    public const AVAILABLE_STORIES = 'availableStories';
}
