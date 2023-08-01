# Storyblok Client

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)

Spryker wrapper for Storyblok PHP client

### Install package
```
composer req valantic-spryker-eco/storyblok-client
```

### Update your shared config
```php
$config[StoryblokConstants::STORYBLOK_PUBLIC_SECRET] = '<Your Storyblok public secret>';
$config[StoryblokConstants::STORYBLOK_PREVIEW_SECRET] = '<Your Storyblok preview secret>';
$config[StoryblokConstants::SLUG_NAVIGATION_MAIN] = '<Slug for main navigation>';
$config[StoryblokConstants::SLUG_FOOTER] = '<Slug for footer>';
$config[StoryblokConstants::SLUG_CMS_CONTENT] = '/';
$config[StoryblokConstants::STORYBLOK_EXPIRATION_TIME] = 3600;
```

### Usage
Inject

`\ValanticSpryker\Client\Storyblok\StoryblokClient`

where you need it.
