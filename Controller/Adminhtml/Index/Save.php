<?php
namespace Codilar\HelloWorld\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Codilar\Employee\Model\EmployeeFactory as ModelFactory;
use Codilar\Employee\Model\ResourceModel\Employee as ResourceModel;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    public function __construct(
        Context $context,
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        parent::__construct($context);
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
            $post = $this->getRequest()->getParams();
            $emptyEmployee = $this->modelFactory->create();
            // var_dump($post);
            // die();
            if(!empty($post['entity_id']))
            {
                  $this->resourceModel->load($emptyEmployee, $post['entity_id']);
             }
            $emptyEmployee->setFirstname($post['firstname'] ?? null);
            $emptyEmployee->setLastname($post['lastname'] ?? null);
            $emptyEmployee->setNumber($post['number'] ?? null);
            $emptyEmployee->setEmail($post['email'] ?? null);
            $emptyEmployee->setAddress($post['address'] ?? null);
            $this->resourceModel->save($emptyEmployee);
            $this->messageManager->addSuccessMessage(__('Employee %1 saved successfully', $emptyEmployee->getFirstname()));
            return $this->resultRedirectFactory->create()->setPath('*/*/index');

        // $data = $this->getRequest()->getParams();
        // $emptyEmployee = $this->modelFactory->create();
        // $data = $this->getRequest()->getParams();
        // $emptyEmployee->setFirstname($data['firstname'] ?? null);
        // $emptyEmployee->setLastname($data['lastname'] ?? null);
        // $emptyEmployee->setNumber($data['number'] ?? null);
        // $emptyEmployee->setEmail($data['email'] ?? null);
        // $emptyEmployee->setAddress($data['address'] ?? null);
        // $this->resourceModel->save($emptyEmployee);
        // $this->messageManager->addSuccessMessage(__('Employee %1 saved successfully', $emptyEmployee->getFirstname()));
        // return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
