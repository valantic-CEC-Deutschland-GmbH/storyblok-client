<?php

declare(strict_types = 1);

namespace ValanticSpryker\Client\Storyblok\InternalClient;

use Storyblok\Client;
use ValanticSpryker\Client\Storyblok\StoryblokConfig;
use ValanticSpryker\Shared\Storyblok\StoryblokConstants;

class ClientWithConfig implements ClientInterface
{
    private Client $client;

    private StoryblokConfig $config;

    /**
     * @param \Storyblok\Client $client
     * @param \ValanticSpryker\Client\Storyblok\StoryblokConfig $config
     */
    public function __construct(Client $client, StoryblokConfig $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @param string $cmsPageSlug
     *
     * @return array
     */
    public function getCmsPage(string $cmsPageSlug): array
    {
        $fullSlug = implode('/', [
            rtrim($this->config->getStoryBlokCmsSlug(), '/'),
            ltrim($cmsPageSlug, '/'),
        ]);

        $cmsPage = $this->client
            ->getStoryBySlug($fullSlug)
            ->getBody();

        $breadCrumbs = [];

        if (isset($cmsPage['story'])) {
            $breadCrumbs = $this->setBreadCrumbs($cmsPage['story']);
        }

        $cmsPage['breadCrumbs'] = $breadCrumbs;

        return $cmsPage;
    }

    /**
     * @return array
     */
    public function getMainNavigation(): array
    {
        return $this->client->getStoryBySlug(
            $this->config->getStoryBlokMainNavigationSlug(),
        )->getBody();
    }

    /**
     * @return array
     */
    public function getFooter(): array
    {
        return $this->client->getStoryBySlug(
            $this->config->getStoryBlokFooterSlug(),
        )->getBody();
    }

    /**
     * @param array $request
     *
     * @return bool
     */
    public function isPreviewMode(array $request): bool
    {
        if ($request) {
            if (!isset($request[StoryblokConstants::SPACE_ID], $request[StoryblokConstants::TIMESTAMP], $request[StoryblokConstants::TOKEN])) {
                return false;
            }

            $preToken = implode(
                ':',
                [
                    $request[StoryblokConstants::SPACE_ID],
                    $this->config->getStoryblokPreviewSecret(),
                    $request[StoryblokConstants::TIMESTAMP],
                ],
            );
            $token = sha1($preToken);

            if (
                $token == $request[StoryblokConstants::TOKEN]
                && $this->isTokenNotExpired($request[StoryblokConstants::TIMESTAMP])
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function getStories(array $options): array
    {
        $stories = $this->client
            ->getStories($options);

        $headers = $stories->getHeaders();

        $numberOfPages = $this->getPaginationPagesAvailable(
            (int)$headers['Total'][0],
            (int)$headers['Per-Page'][0],
        );

        return array_merge(
            $stories->getBody(),
            [
                StoryblokConstants::AVAILABLE_STORY_PAGES_COUNT => $numberOfPages,
                StoryblokConstants::AVAILABLE_STORIES => (int)($headers['Total'][0] ?? 0),
            ],
        );
    }

    /**
     * @return array
     */
    private function getLinks(): array
    {
        return $this->client->getLinks()->getBody();
    }

    /**
     * @param string $timeStamp
     *
     * @return bool
     */
    private function isTokenNotExpired(string $timeStamp): bool
    {
        return (int)$timeStamp > strtotime('now') - $this->config->getStoryblokSessionExpirationTime();
    }

    /**
     * @param int $totalStories
     * @param int $storiesPerPage
     *
     * @return int
     */
    private function getPaginationPagesAvailable(int $totalStories, int $storiesPerPage): int
    {
        if ($totalStories === 0 || $storiesPerPage === 0) {
            return 0;
        }

        return (int)ceil($totalStories / $storiesPerPage);
    }

    /**
     * @param array $story
     *
     * @return array
     */
    private function setBreadCrumbs(array $story): array
    {
        $breadCrumbList = [];

        if (!$story['is_startpage']) {
            $breadCrumbList[] = [
                'name' => $story['name'],
                'fullSlug' => $story['full_slug'],
            ];
        }
        $storyBlockLinks = $this->arrangeStoryBlokLinks();

        return array_reverse($this->getBreadCrumbsByParentId($breadCrumbList, $storyBlockLinks, $story['parent_id'] ?? 0));
    }

    /**
     * @param array $breadCrumbList
     * @param array $storyBlokLinks
     * @param int $parentId
     *
     * @return array
     */
    private function getBreadCrumbsByParentId(array &$breadCrumbList, array $storyBlokLinks, int $parentId): array
    {
        if (isset($storyBlokLinks[$parentId]['parent_id'])) {
            if ($storyBlokLinks[$parentId]['parent_id'] > 0) {
                $breadCrumbList[] = [
                    'name' => $storyBlokLinks[$parentId]['name'],
                    'fullSlug' => $storyBlokLinks[$parentId]['slug'],
                ];

                $this->getBreadCrumbsByParentId($breadCrumbList, $storyBlokLinks, $storyBlokLinks[$parentId]['parent_id']);
            }
        }

        return $breadCrumbList;
    }

    /**
     * @return array
     */
    private function arrangeStoryBlokLinks(): array
    {
        $linksArray = $this->getLinks();
        $arrangedArray = [];
        foreach ($linksArray['links'] as $links) {
            $arrangedArray[$links['id']] = $links;
        }

        return $arrangedArray;
    }
}
