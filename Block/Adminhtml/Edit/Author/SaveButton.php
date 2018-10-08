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
namespace Ced\GraphQl\Block\Adminhtml\Edit\Author;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\App\Request\Http;

/**
 * Class SaveButton
 * @package Ced\GraphQl\Block\Adminhtml\Edit\Author
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * SaveButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
    	Http $request
    ) {
        parent::__construct($context, $registry);
        $this->request = $request;
        
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
    	return [
    	'label' => __('Save Author'),
    	'class' => 'save primary',
    	'data_attribute' => [
    	'mage-init' => ['button' => ['event' => 'save']],
    	'form-role' => 'save',
    	],
    	'sort_order' => 90,
    	];
            
    }
}
