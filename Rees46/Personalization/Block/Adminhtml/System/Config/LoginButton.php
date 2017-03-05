<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Block\Adminhtml\System\Config;

class LoginButton extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_loginButtonLabel = 'Send';

    public function setloginButtonLabel($loginButtonLabel)
    {
        $this->_loginButtonLabel = $loginButtonLabel;
        return $this;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate('system/config/loginbutton.phtml');
        }
        return $this;
    }

    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $originalData = $element->getOriginalData();
        $buttonLabel = !empty($originalData['button_label']) ? $originalData['button_label'] : $this->_loginButtonLabel;
        $this->addData(
            [
                'button_label' => __($buttonLabel),
                'html_id' => $element->getHtmlId(),
                'ajax_url' => $this->_urlBuilder->getUrl('customer/system_config_validatevat/validate'),
            ]
        );

        return $this->_toHtml();
    }
}
