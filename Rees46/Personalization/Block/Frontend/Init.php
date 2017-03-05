<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Block\Frontend;

class Init extends \Magento\Framework\View\Element\Template
{
    protected $_request;
    protected $_image;
    protected $_config;
    protected $_helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Catalog\Helper\Image $image,
        \Rees46\Personalization\Helper\Config $config,
        \Rees46\Personalization\Helper\Data $helper,
        array $data = []
    ) {
        $this->_request = $request;
        $this->_image = $image;
        $this->_config = $config;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    public function getTrackingCode()
    {
        $js = '';
        $js .= 'r46(\'init\', \'' . $this->_config->getValue('rees46/general/store_key') . '\');' . "\n";

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $customer = $objectManager->create('Magento\Customer\Model\Session');

        if ($customer->isLoggedIn()) {
            if ($customer->getCustomer()->getGender() == 1) {
                $customer_gender = 'm';
            } elseif ($customer->getCustomer()->getGender() == 2) {
                $customer_gender = 'f';
            } else {
                $customer_gender = null;
            }

            if ($customer->getCustomer()->getDob()) {
                $customer_birthday = date('Y-m-d', strtotime($customer->getCustomer()->getDob()));
            } else {
                $customer_birthday = null;
            }

            $js .= 'r46(\'profile\', \'set\', {';
            $js .= ' id: ' . (int)$customer->getCustomer()->getId() . ',';
            $js .= ' email: \'' . $customer->getCustomer()->getEmail() . '\',';
            $js .= ' gender: \'' . $customer_gender . '\',';
            $js .= ' birthday: \'' . $customer_birthday . '\'';
            $js .= '});' . "\n";
        }

        if ($this->_request->getFullActionName() == 'catalog_product_view') {
            $product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');

            $js .= 'r46(\'track\', \'view\', {';
            $js .= ' id: ' . (int)$product->getId() . ',';
            $js .= ' stock: ' . $this->_helper->getProductStock($product->getId()) . ',';
            $js .= ' price: ' . (int)$product->getPrice() . ',';
            $js .= ' name: \'' . $product->getName() . '\',';
            $js .= ' categories: ' . json_encode($product->getCategoryIds()) . ',';
            $js .= ' image: \'' . $this->_image->init($product, 'category_page_list')->getUrl() . '\',';
            $js .= ' url: \'' . $product->getProductUrl($product->getId()) . '\',';
            $js .= '});' . "\n";
        }

        return $js;
    }

    protected function _toHtml()
    {
        if (!$this->_config->isRees46Enabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}