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
 * Class Author
 * @package Ced\GraphQl\Model\Source
 */
class Author implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * 
     * @param \Ced\GraphQl\Model\ResourceModel\Author\CollectionFactory $collectionFactory
     */
	public function __construct(
	 \Ced\GraphQl\Model\ResourceModel\Author\CollectionFactory $collectionFactory
			
	){
		$this->collectionFactory = $collectionFactory;
	}
	
	/**
	 * @return array
	 */
    public function toOptionArray()
    {
        
        $ret[] = ['value'=>'','label'=>'Please Select Author'];

        $authorCollection = $this->collectionFactory->create();
        foreach ($authorCollection as $key => $author) {
        	
            $ret[] = [
                'value' => $author->getId(),
                'label' => $author->getAuthorName()
            ];
        }
        
        return $ret;
    }
}