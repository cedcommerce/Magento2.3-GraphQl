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
namespace Ced\GraphQl\Ui\DataProvider;
use Ced\GraphQl\Model\ResourceModel\Book\CollectionFactory;
/**
 * Class BookFormDataProvider
 * @package Ced\GraphQl\Ui\DataProvider
 */
class BookFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
	/**
	 * @var array
	 */
	public $_loadedData;
	
	/**
	 * 
	 * @param string $name
	 * @param string $primaryFieldName
	 * @param string $requestFieldName
	 * @param CollectionFactory $collectionFactory
	 * @param array $meta
	 * @param array $data
	 */
    public function __construct(
    		$name,
    		$primaryFieldName,
    		$requestFieldName,
    		CollectionFactory $collectionFactory,
    		array $meta = [],
    		array $data = []
    ) {
    	$this->collection = $collectionFactory->create();
    	parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
    	if (isset($this->_loadedData)) {
    		return $this->_loadedData;
    	}
    	$items = $this->collection->getItems();
    	foreach ($items as $book) {
    		$this->_loadedData[$book->getId()] = $book->getData();
    	}
    	return $this->_loadedData;
    }
}