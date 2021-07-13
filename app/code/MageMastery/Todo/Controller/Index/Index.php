<?php

namespace MageMastery\Todo\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;
use MageMastery\Todo\Model\Task;
use MageMastery\Todo\Model\ResourceModel\Task as TaskResource;
use MageMastery\Todo\Model\TaskFactory;

class Index implements ActionInterface, HttpGetActionInterface
{
    private ResultFactory $resultFactory;
    private $taskResource;
    private $taskFactory;

    public function __construct(
        ResultFactory $resultFactory,
        TaskFactory $taskFactory,
        TaskResource $taskResource
    ) {
        $this->resultFactory = $resultFactory;
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
    }

    public function execute()
    {
        $task = $this->taskFactory->create();
        $task->setData([
            'label' => 'New Task 22',
            'status' => 'open',
            'customer_id' => 1
        ]);

        $this->taskResource->save($task);
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}


