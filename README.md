# Storyblok Client

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)

Spryker wrapper for Storyblok PHP client

## Integration

### Add composer registry
```
composer config repositories.gitlab.nxs360.com/461 '{"type": "composer", "url": "https://gitlab.nxs360.com/api/v4/group/461/-/packages/composer/packages.json"}'
```

### Add Gitlab domain
```
composer config gitlab-domains gitlab.nxs360.com
```

### Authentication
Go to Gitlab and create a personal access token. Then create an **auth.json** file:
```
composer config gitlab-token.gitlab.nxs360.com <personal_access_token>
```

Make sure to add **auth.json** to your **.gitignore**.

### Install package
```
composer req valantic-spryker/storyblok-client
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
