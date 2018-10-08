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
namespace Ced\GraphQl\Ui\Column\Listing;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Ced\GraphQl\Model\Author;

/**
 * Class AuthorName
 */
class AuthorName extends Column
{
	/**
	 * @var UrlInterface
	 */
	protected $urlBuilder;
	
	/**
	 * @var Ced\GraphQl\Model\Autho
	 */
	protected $author;
	/**
	 * 
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param UrlInterface $urlBuilder
	 * @param Author $author
	 * @param array $components
	 * @param array $data
	 */
	public function __construct(
			ContextInterface $context,
			UiComponentFactory $uiComponentFactory,
			UrlInterface $urlBuilder,
			Author $author,
			array $components = [],
			array $data = []
	) {
		$this->urlBuilder = $urlBuilder;
		$this->author = $author;
		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	/**
	 * Prepare Data Source
	 *
	 * @param array $dataSource
	 * @return array
	 */
	public function prepareDataSource(array $dataSource)
	{
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as &$item) {
			if (isset($item['author'])) {          
            	$item['author'] = $this->author->load($item['author'])->getAuthorName();
                } 
			}
		}
		return $dataSource;
	}
}
