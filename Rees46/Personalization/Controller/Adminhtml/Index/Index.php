<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_config;
    protected $_data;
    protected $_json;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Rees46\Personalization\Helper\Config $config,
        \Rees46\Personalization\Helper\Data $data,
        \Magento\Framework\Controller\Result\JsonFactory $json
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_config = $config;
        $this->_data = $data;
        $this->_json = $json;
        parent::__construct($context);
    }

    public function execute()
    {

    }
}
