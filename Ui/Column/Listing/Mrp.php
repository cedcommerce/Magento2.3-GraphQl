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
use Magento\Framework\Pricing\Helper\Data;

/**
 * Class Mrp
 */
class Mrp extends Column
{
	/**
	 * @var UrlInterface
	 */
	protected $urlBuilder;
	
	/**
	 * @var Magento\Framework\Pricing\Helper\Data
	 */
	protected $pricing;
	
	/**
	 * 
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param UrlInterface $urlBuilder
	 * @param Data $pricing
	 * @param array $components
	 * @param array $data
	 */
	public function __construct(
			ContextInterface $context,
			UiComponentFactory $uiComponentFactory,
			UrlInterface $urlBuilder,
			Data $pricing,
			array $components = [],
			array $data = []
	) {
		$this->urlBuilder = $urlBuilder;
		$this->pricing = $pricing;
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
			if (isset($item['mrp'])) {          
            	$item['mrp'] = $this->pricing->currency($item['mrp'], true, false);
                } 
			}
		}
		return $dataSource;
	}
}
