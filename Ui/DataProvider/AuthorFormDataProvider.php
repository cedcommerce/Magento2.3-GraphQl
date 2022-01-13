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
use Ced\GraphQl\Model\ResourceModel\Author\CollectionFactory;
use Magento\Framework\App\ObjectManager;
use Ced\GraphQl\Model\ImageProcessing\FileInfo;
use Ced\GraphQl\Model\ImageProcessing\Image;
/**
 * Class AuthorFormDataProvider
 * @package Ced\GraphQl\Ui\DataProvider
 */
class AuthorFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
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
    		array $data = [],
        FileInfo $fileInfo = null,
        Image $authorImage = null
    ) {
    	$this->collection = $collectionFactory->create();
    	parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
      $this->fileInfo = $fileInfo ?? ObjectManager::getInstance()->get(FileInfo::class);
      $this->authorImage = $authorImage ?? ObjectManager::getInstance()->get(Image::class);
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
    	foreach ($items as $author) {
    		$this->_loadedData[$author->getId()] = $this->convertValues($author);
    	}
    	return $this->_loadedData;
    }

    /**
     * Converts image data to acceptable for rendering format
     *
     * @param Author $author
     * @param array $authorData
     * @return array
     */
    private function convertValues($author): array
    {
        $authorData = $author->getData();
        $fileName = $author->getLogo();
        unset($authorData['logo']);
            
            if($fileName && $this->fileInfo->isExist($fileName)) {
              $stat = $this->fileInfo->getStat($fileName);
              $mime = $this->fileInfo->getMimeType($fileName);
                // phpcs:ignore Magento2.Functions.DiscouragedFunction
              $authorData['logo'][0]['name'] = basename($fileName);
              $authorData['logo'][0]['url'] = $this->authorImage->getUrl($fileName);
              $authorData['logo'][0]['size'] = $stat['size'];
              $authorData['logo'][0]['type'] = $mime;
            }
        return $authorData;
    }

}