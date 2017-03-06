<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Helper;

class Logger extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_logger;
    protected $_config;
    protected $_status;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Rees46\Personalization\Helper\Config $config
    )
    {
        $this->_logger = $logger;
        $this->_config = $config;
        $this->_status = $this->_config->getLogStatus();
    }

    public function log($message = '')
    {
        if ($this->_status) {
            $this->_logger->addDebug($message);
        }
    }
}
