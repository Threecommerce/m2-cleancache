<?php
declare(strict_types=1);

namespace Threecommerce\CleanCache\Controller\Adminhtml\Clean;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;

class Cache extends Action
{
    protected $resultFactory;
    protected $messageManager;

    public function __construct(
        Context          $context,
        ManagerInterface $messageManager,
        ResultFactory    $resultFactory
    )
    {
        $this->resultFactory = $resultFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        exec('php bin/magento c:f');
        $this->messageManager->addSuccess(__("Successfully cleaned caches."));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }

    protected function _isAllowed()
    {
        return true;
    }
}
