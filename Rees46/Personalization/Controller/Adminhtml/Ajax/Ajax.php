<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Controller\Adminhtml\Ajax;

class Ajax extends \Magento\Backend\App\Action
{
    protected $_api;
    protected $_json;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Rees46\Personalization\Helper\Api $api,
        \Magento\Framework\Controller\Result\JsonFactory $json
    )
    {
        $this->_api = $api;
        $this->_json = $json;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->isAjax() && $this->getRequest()->getPost('action') && $this->getRequest()->getPost('action') != '') {
            $_params = $this->getRequest()->getPost();
            $_action = $_params['action'];
            $_data = $this->_api->$_action($_params);

            return $this->_json->create()->setData($_data);
        }
    }
}
