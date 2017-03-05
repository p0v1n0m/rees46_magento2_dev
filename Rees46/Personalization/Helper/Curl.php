<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rees46\Personalization\Helper;

class Curl extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function query($type, $url, $params = null)
    {
        $data = array();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_URL, $url);

        if (isset($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        /////////////////
        curl_setopt($ch, CURLOPT_USERPWD, 'admin:976431');
        /////////////////
        $data['result'] = curl_exec($ch);
        $data['info'] = curl_getinfo($ch);

        curl_close($ch);

        return $data;
    }
}
