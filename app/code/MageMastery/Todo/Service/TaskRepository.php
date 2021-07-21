<?php

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use MageMastery\Todo\Model\TaskFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private $resource;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * TaskRepository constructor.
     * @param Task $resource
     * @param TaskFactory $taskFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param TaskSearchResultInterface $searchResultFactory
     */
    public function __construct(
        Task $resource,
        TaskFactory $taskFactory,
        CollectionProcessorInterface $collectionProcessor,
        TaskSearchResultInterface $searchResultFactory
    )
    {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultFactory;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface
    {
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchResult);

        $this->collectionProcessor->process($searchCriteria, $searchResult);

        return $searchResult;
    }

    public function get(int $taskId)
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $taskId);
        return $object;
    }
}
