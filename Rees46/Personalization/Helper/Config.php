<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Helper;

use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $_scopeConfig;
    protected $_resourceConfig;

    public function __construct(
		\Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Config\Model\ResourceModel\Config $resourceConfig
	)
	{
		$this->_scopeConfig = $scopeConfig;
        $this->_resourceConfig = $resourceConfig;
        parent::__construct($context);
	}

    public function getValue($path, $scope = 'default', $scopeId = 0)
    {
        return $this->_scopeConfig->getValue($path, $scope, $scopeId);
    }

    public function setValue($path, $value, $scope = 'default', $scopeId = 0)
    {
        return $this->_resourceConfig->saveConfig($path, $value, $scope, $scopeId);
    }

    public function deleteValue($path, $scope = 'default', $scopeId = 0)
    {
        return $this->_resourceConfig->deleteConfig($path, $scope, $scopeId);
    }

    public function getLogStatus()
    {
        return $this->getValue('rees46/general/log_status');
    }

    public function isRees46Enabled()
    {
        if ($this->getValue('rees46/actions/action_auth') != ''
            && $this->getValue('rees46/general/store_key') != ''
            && $this->getValue('rees46/general/secret_key') != ''
        ) {
            return true;
        }
    }
}
