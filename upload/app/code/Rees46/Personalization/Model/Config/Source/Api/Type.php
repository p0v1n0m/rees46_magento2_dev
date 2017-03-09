<?php
/**
 * Copyright © 2017 REES46, INC. All rights reserved.
 */
namespace Rees46\Personalization\Model\Config\Source\Api;

class Type implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'interesting', 'label' => __('You may like it')],
            ['value' => 'also_bought', 'label' => __('Also bought with this product')],
            ['value' => 'similar', 'label' => __('Similar products')],
            ['value' => 'popular', 'label' => __('Popular products')],
            ['value' => 'see_also', 'label' => __('See also')],
            ['value' => 'recently_viewed', 'label' => __('Recently viewed')],
            ['value' => 'buying_now', 'label' => __('Right now bought')],
            ['value' => 'search', 'label' => __('Customers who looked for this product also bought')],
        ];
    }
}
