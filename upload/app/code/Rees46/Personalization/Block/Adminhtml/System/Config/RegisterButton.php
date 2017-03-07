<?php
/**
 * Copyright © 2017 REES46, INC. All rights reserved.
 */
namespace Rees46\Personalization\Block\Adminhtml\System\Config;

class RegisterButton extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_registerButtonLabel = 'Send';

    public function setregisterButtonLabel($registerButtonLabel)
    {
        $this->_registerButtonLabel = $registerButtonLabel;
        return $this;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate('system/config/registerbutton.phtml');
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
        $buttonLabel = !empty($originalData['button_label']) ? $originalData['button_label'] : $this->_registerButtonLabel;
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
