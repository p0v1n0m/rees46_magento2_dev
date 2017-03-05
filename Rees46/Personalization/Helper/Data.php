<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	protected $_store;
    protected $_storeInfo;
    protected $_auth;
    protected $_orders;
    protected $_product;
    protected $_stock;
    protected $_customers;
    protected $_directories;

	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		\Magento\Store\Model\StoreManagerInterface $store,
        \Magento\Store\Model\Information $storeInfo,
        \Magento\Backend\Model\Auth\Session $auth,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orders,
        \Magento\Catalog\Model\Product $product,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stock,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customers,
        \Magento\Framework\App\Filesystem\DirectoryList $directories
	)
	{
		$this->_store = $store;
        $this->_storeInfo = $storeInfo;
        $this->_auth = $auth;
        $this->_orders = $orders;
        $this->_product = $product;
        $this->_stock = $stock;
        $this->_customers = $customers;
        $this->_directories = $directories;
		parent::__construct($context);
	}

    public function getStore()
    {
        return $this->_store->getStore();
    }

    public function getStoreUrl()
    {
        return $this->getStore()->getBaseUrl();
    }

    public function getStoreName()
    {
        return $this->_storeInfo->getStoreInformationObject($this->getStore())->getName();
    }

    public function getStorePhone()
    {
        return $this->_storeInfo->getStoreInformationObject($this->getStore())->getPhone();
    }

    public function getStoreCity()
    {
        return $this->_storeInfo->getStoreInformationObject($this->getStore())->getCity();
    }

    public function getStoreCountry()
    {
        return $this->_storeInfo->getStoreInformationObject($this->getStore())->getCountry();
    }

    public function getStoreCountryCode()
    {
        return $this->_storeInfo->getStoreInformationObject($this->getStore())->getCountryId();
    }

    public function getStoreCurrency()
    {
        return $this->getStore()->getCurrentCurrencyCode();
    }

    public function getUserEmail()
    {
        return $this->_auth->getUser()->getEmail();
    }

    public function getUserFirstName()
    {
        return $this->_auth->getUser()->getFirstName();
    }

    public function getUserLastName()
    {
        return $this->_auth->getUser()->getLastName();
    }

    public function getOrders($data = array())
    {
        $orders = $this->_orders->create()
            ->addAttributeToSelect('entity_id')
            ->addAttributeToSelect('customer_id')
            ->addAttributeToSelect('customer_email')
            ->addAttributeToSelect('created_at')
            ->addAttributeToFilter('created_at', array('gt' => date('Y-m-d H:i:s', strtotime('-6 months'))))
            ->addAttributeToSort('entity_id', 'ASC');

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 1;
            }

            $orders->setCurPage($data['start'])->setPageSize($data['limit']);
        }

        return $orders;
    }

    public function getProductCategories($productId = null)
    {
        return $this->_product->load($productId)->getCategoryIds();
    }

    public function getProductStock($productId = null, $storeId = null)
    {
        return $this->_stock->getStockItem($productId, $storeId)->getIsInStock();
    }

    public function getCustomers($data = array())
    {
        $customers = $this->_customers->create()
            ->addAttributeToSelect('entity_id')
            ->addAttributeToSelect('email')
            ->addAttributeToSort('entity_id', 'ASC');

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 1;
            }

            $customers->setCurPage($data['start'])->setPageSize($data['limit']);
        }

        return $customers;
    }

    public function getRootDir()
    {
        return $this->_directories->getRoot();
    }

    public function getDir($path = null)
    {
        return $this->_directories->getPath($path);
    }
}
