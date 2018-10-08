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
namespace Ced\GraphQl\Model\ResourceModel\Book;

/**
 * Class Collection
 * @package Ced\GraphQl\Model\ResourceModel\Book
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
	
	protected $_idFieldName = 'id';
	
	/**
	 * 
	 * @see \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection::_construct()
	 */
	protected function _construct() {
		$this->_init('Ced\GraphQl\Model\Book', 'Ced\GraphQl\Model\ResourceModel\Book');
		
	}
}