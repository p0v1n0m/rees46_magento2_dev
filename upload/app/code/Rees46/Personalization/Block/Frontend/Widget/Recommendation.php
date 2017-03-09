<?php
/**
 * Copyright © 2017 REES46, INC. All rights reserved.
 */
namespace Rees46\Personalization\Block\Frontend\Widget;

class Recommendation extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface {
    protected $_registry;
    protected $_cart;
    protected $_query;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,       
        \Magento\Framework\Registry $registry,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Search\Model\QueryFactory $query,
        array $data = []
    )
    {
        $this->_registry = $registry;
        $this->_cart = $cart;
        $this->_query = $query;
        parent::__construct($context, $data);
    }

	public function _toHtml()
	{
	    $params = array();

	    $settings = array(
	    	'type' => $this->getData('block_type'),
	    	'title' => $this->getData('title'),
	    	'limit' => $this->getData('limit'),
	    	'width' => $this->getData('width'),
	    	'height' => $this->getData('height'),
	    	'template' => $this->getData('template'),
	    	'discount' => $this->getData('discount'),
	    	'brands' => $this->getData('brands'),
	    	'exclude_brands' => $this->getData('exclude_brands'),
	    	'css' => '',
	    );

		if ($settings['template'] == 'Rees46_Personalization::widget/basic.phtml') {
			$settings['css'] = 'r46(\'add_css\', \'recommendations\');';
		}

		if ($this->getRequest()->getControllerName() == 'product' && $this->_registry->registry('current_product')->getId()) {
			$item = (int)$this->_registry->registry('current_product')->getId();
		}

		if ($this->getRequest()->getControllerName() == 'category' && $this->_registry->registry('current_category')->getId()) {
			$category = (int)$this->_registry->registry('current_category')->getId();

			//$categories = explode('_', (string)$this->request->get['path']);
		}

		if ($this->_cart->getQuote()) {
			foreach ($this->_cart->getQuote()->getAllVisibleItems() as $product) {
				$params['cart'][] = $product->getProductId();
			}
		}

		if ($this->getRequest()->getRouteName() == 'catalogsearch' && $this->_query->get()->getQueryText() != '') {
			$search_query = $this->_query->get()->getQueryText();
		}

		if ($settings['limit'] > 0) {
			$params['limit'] = (int)$settings['limit'];
		} else {
			$params['limit'] = 5;
		}

		$params['discount'] = (int)$settings['discount'];

		/*if (!empty($settings['brands'])) {
			$params['brands'] = array();

			foreach ($settings['brands'] as $manufacturer) {
				$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer);

				$params['brands'][] = $manufacturer_info['name'];
			}
		}

		if (!empty($settings['exclude_brands'])) {
			$params['exclude_brands'] = array();

			foreach ($settings['manufacturers_exclude'] as $manufacturer) {
				$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer);

				$params['exclude_brands'][] = $manufacturer_info['name'];
			}
		}*/

		if ($settings['type'] == 'interesting') {
			if (isset($item)) {
				$params['item'] = $item;
			}

			$settings['params'] = json_encode($params, true);
		} elseif ($settings['type'] == 'also_bought') {
			if (isset($item)) {
				$params['item'] = $item;

				if (isset($categories)) {
					$params['categories'] = $categories;
				}

				$settings['params'] = json_encode($params, true);
			}
		} elseif ($settings['type'] == 'similar') {
			if (isset($item) && isset($cart)) {
				$params['item'] = $item;
				$params['cart'] = $cart;

				if (isset($categories)) {
					$params['categories'] = $categories;
				}

				$settings['params'] = json_encode($params, true);
			}
		} elseif ($settings['type'] == 'popular') {
			if (isset($category)) {
				$params['category'] = $category;
			}

			$settings['params'] = json_encode($params, true);
		} elseif ($settings['type'] == 'see_also') {
			if (isset($cart)) {
				$params['cart'] = $cart;

				$settings['params'] = json_encode($params, true);
			}
		} elseif ($settings['type'] == 'recently_viewed') {
			$settings['params'] = json_encode($params, true);
		} elseif ($settings['type'] == 'buying_now') {
			if (isset($item)) {
				$params['item'] = $item;
			}

			if (isset($cart)) {
				$params['cart'] = $cart;
			}

			$settings['params'] = json_encode($params, true);
		} elseif ($settings['type'] == 'search') {
			if (isset($search_query)) {
				$params['search_query'] = $search_query;

				if (isset($cart)) {
					$params['cart'] = $cart;
				}

				$settings['params'] = json_encode($params, true);
			}
		} elseif ($settings['type'] == 'supply') {
			if (isset($item)) {
				$params['item'] = $item;
			}

			if (isset($cart)) {
				$params['cart'] = $cart;
			}

			$settings['params'] = json_encode($params, true);
		}

		$settings['module_id'] = md5(http_build_query($settings));

	    $this->setData('settings', $settings);

	    $this->setTemplate('widget/rees46.phtml');
var_dump($settings);
	    return parent::_toHtml();
	}
}
