<?php
/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End User License Agreement (EULA)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://cedcommerce.com/license-agreement.txt
 *
 * @category  Ced
 * @package   Ced_GraphQl
 * @author    CedCommerce Core Team <connect@cedcommerce.com >
 * @copyright Copyright CEDCOMMERCE (https://cedcommerce.com/)
 * @license      https://cedcommerce.com/license-agreement.txt
 */
namespace Ced\GraphQl\Model\Source;
/**
 * Class Language
 * @package Ced\GraphQl\Model\Source
 */
class Language implements \Magento\Framework\Option\ArrayInterface
{
   CONST ENGLISH ='english';
   CONST HINDI ='hindi';
	
   /**
    * @return array
    */
    public function toOptionArray()
    {
    	$language = [
    	self::ENGLISH  => "English",
    	self::HINDI =>"Hindi"
    			];
        $ret[] = ['value'=>'','label'=>'Please Select Language'];

        foreach ($language as $key => $value) {
            $ret[] = [
                'value' => $key,
                'label' => $value
            ];
        }
        return $ret;
    }
}