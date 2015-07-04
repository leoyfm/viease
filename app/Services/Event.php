<?php

namespace App\Services;

use App\Repositories\EventRepository;
use App\Services\Material as MaterialService;

/**
 * 事件服务提供.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class Event
{
    /**
     * EventRepository.
     *
     * @var App\Repositories\EventRepository
     */
    private $eventRepository;

    /**
     * 素材服务
     *
     * @var App\Services\Material
     */
    private $materialService;

    /**
     * construct description.
     *
     * @param App\Repositories\EventRepository $eventRepository
     */
    public function __construct(
        EventRepository $eventRepository,
        MaterialService $materialService
    ) {
        $this->eventRepository = $eventRepository;

        $this->materialService = $materialService;
    }

    /**
     * 是否属于自己的事件.
     *
     * @param string $name name
     *
     * @return bool
     */
    public function isOwnEvent($name)
    {
        return starts_with($name, 'V_EVENT_');
    }

    /**
     * 创建一个文字类型的事件.
     *
     * @param string $text 返回值
     *
     * @return string 事件key
     */
    public function makeText($text)
    {
        return $this->eventRepository->storeText($text);
    }

    /**
     * 创建一个图文回复事件.
     *
     * @param array $articles articles
     *
     * @return string 事件key
     */
    public function makeArticles($articles)
    {
        $mediaId = $this->materialService->saveRemoteArticle($articles);

        $accountId = account()->getCurrent()->id;

        return $this->eventRepository->storeMaterial($mediaId, $accountId);
    }

    /**
     * 创建一个mediaId类型的回复事件.
     *
     * @param string $materialId 原始图片素材Id
     *
     * @return string 事件key
     */
    public function makeMediaId($materialId)
    {
        $mediaId = $this->materialService->localizeInterimMaterialId($materialId);
        //获取存储得到自己的id
        $mediaId = 'EVENT_XXXXXXXX_TEST';

        $accountId = account()->getCurrent()->id;

        return $this->eventRepository->storeMaterial($mediaId, $accountId);
    }

    /**
     * 创建key名称.
     *
     * @return string
     */
    public function makeEventKey()
    {
        return 'V_EVENT_'.strtoupper(uniqid());
    }

    /**
     * 将event转变为素材.
     *
     * @param string $event eventId
     *
     * @return array
     */
    public function eventToMaterial($eventId)
    {
        $event = $this->eventRepository->findByEventId($eventId);

        return $event;
    }
}
