<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Model\Config\Source\Api;

class Category implements \Magento\Framework\Option\ArrayInterface
{
    protected $_api;
    protected $_options;

    public function __construct(
        \Rees46\Personalization\Helper\Api $api
    )
    {
        $this->_api = $api;
    }

    public function toOptionArray()
    {
        if (!$this->_options) {
            foreach ($this->_api->rees46ShopCategories() as $category) {
                $this->_options[$category['id']] = [
                    'label' => $category['name'],
                    'value' => $category['id'],
                ];
            }
        }

        asort($this->_options);

        $options = $this->_options;

        return $options;
    }
}
