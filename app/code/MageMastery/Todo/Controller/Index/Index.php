<?php

namespace MageMastery\Todo\Controller\Index;

use MageMastery\Todo\Service\TaskRepository;
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

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(
        ResultFactory $resultFactory,
        TaskFactory $taskFactory,
        TaskResource $taskResource,
        TaskRepository $taskRepository
    ) {
        $this->resultFactory = $resultFactory;
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskRepository = $taskRepository;
    }

    public function execute()
    {
        $task = $this->taskRepository->get(1);
        var_dump($task->getData());

//        $task = $this->taskFactory->create();
//        $task->setData([
//            'label' => 'New Task 22',
//            'status' => 'open',
//            'customer_id' => 1
//        ]);
//
//        $this->taskResource->save($task);
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}


