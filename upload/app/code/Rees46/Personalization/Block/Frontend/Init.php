<?php
/**
 * Copyright © 2017 REES46, INC. All rights reserved.
 */
namespace Rees46\Personalization\Block\Frontend;

class Init extends \Magento\Framework\View\Element\Template
{
    protected $_request;
    protected $_image;
    protected $_config;
    protected $_helper;
    protected $_cookie;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Catalog\Helper\Image $image,
        \Rees46\Personalization\Helper\Config $config,
        \Rees46\Personalization\Helper\Data $helper,
        \Rees46\Personalization\Helper\Cookie $cookie,
        array $data = []
    ) {
        $this->_request = $request;
        $this->_image = $image;
        $this->_config = $config;
        $this->_helper = $helper;
        $this->_cookie = $cookie;
        parent::__construct($context, $data);
    }

    public function getTrackingCode()
    {
        $js = '';
        $js .= 'r46(\'init\', \'' . $this->_config->getValue('rees46/general/store_key') . '\');' . "\n";

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $customer = $objectManager->create('Magento\Customer\Model\Session');

        if ($customer->isLoggedIn() && $customer->getCustomer()->getId() && (!$this->_cookie->get('rees46_customer') || ($this->_cookie->get('rees46_customer') && $this->_cookie->get('rees46_customer') != $customer->getCustomer()->getId()))
        ) {
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

            $this->_cookie->set('rees46_customer', $customer->getCustomer()->getId());
        } elseif (!$customer->isLoggedIn() && $this->_cookie->get('rees46_customer')) {
            $this->_cookie->delete('rees46_customer');
        }

        if ($this->_request->getFullActionName() == 'catalog_product_view') {
            $product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');

            $js .= 'r46(\'track\', \'view\', {';
            $js .= ' id: ' . (int)$product->getId() . ',';
            $js .= ' stock: ' . $this->_helper->getProductStock($product->getId()) . ',';
            $js .= ' price: ' . number_format($product->getFinalPrice(), 2) . ',';
            $js .= ' name: \'' . $product->getName() . '\',';
            $js .= ' categories: ' . json_encode($product->getCategoryIds()) . ',';
            $js .= ' image: \'' . $this->_image->init($product, 'category_page_list')->getUrl() . '\',';
            $js .= ' url: \'' . $product->getProductUrl($product->getId()) . '\',';
            $js .= '});' . "\n";
        }

        if ($this->_cookie->get('rees46_cart')) {
            $js .= $this->_cookie->get('rees46_cart');

            $this->_cookie->delete('rees46_cart');
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
