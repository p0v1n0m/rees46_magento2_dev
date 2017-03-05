<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Helper;

class Logger extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $logger;
    protected $config;
    protected $status;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Rees46\Personalization\Helper\Config $config
    )
    {
        $this->logger = $logger;
        $this->config = $config;
        $this->status = $this->config->getLogStatus();
    }

    public function log($message)
    {
        if ($this->status) {
            $this->logger->addDebug($message);
        }
    }
}
