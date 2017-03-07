<?php
/**
 * Copyright © 2017 REES46, INC. All rights reserved.
 */
namespace Rees46\Personalization\Block\Frontend;

class Purchase extends \Magento\Framework\View\Element\Template
{
    protected $_request;
    protected $_checkout;
    protected $_config;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Checkout\Model\Session $checkout,
        \Rees46\Personalization\Helper\Config $config,
        array $data = []
    ) {
        $this->_request = $request;
        $this->_checkout = $checkout;
        $this->_config = $config;
        parent::__construct($context, $data);
    }

    protected function getOrder()
    {
        return $this->_checkout->getLastRealOrder();
    }

    protected function getOrderId()
    {
        return $this->getOrder()->getIncrementId();
    }

    protected function getOrderTotal()
    {
        return $this->getOrder()->getGrandTotal();
    }

    protected function getOrderProducts()
    {
        return $this->getOrder()->getAllVisibleItems();
    }

    public function getPurchaseTrackingCode()
    {
        $js_data = array();

        $js_data['order'] = $this->getOrderId();
        $js_data['order_price'] = number_format($this->getOrderTotal(), 2);

        foreach ($this->getOrderProducts() as $order_product) {
            $js_data['products'][] = array(
                'id' => $order_product->getProductId(),
                'price' => number_format($order_product->getBasePrice(), 2),
                'amount' => (int)$order_product->getQtyOrdered(),
            );
        }

        return 'r46(\'track\', \'purchase\', ' . json_encode($js_data) . ');';
    }

    protected function _toHtml()
    {
        if (!$this->_config->isRees46Enabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}
