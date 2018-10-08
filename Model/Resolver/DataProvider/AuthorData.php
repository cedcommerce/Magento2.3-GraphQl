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
declare(strict_types=1);

namespace Ced\GraphQl\Model\Resolver\DataProvider;

use Ced\GraphQl\Model\Author;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Widget\Model\Template\FilterEmulate;

/**
 * AuthorData data provider
 */
class AuthorData
{
    /**
     * @var FilterEmulate
     */
    private $widgetFilter;

    /**
     * @var Author
     */
    private $author;

    /**
     * @param Author $author
     * @param FilterEmulate $widgetFilter
     */
    public function __construct(
        Author $author,
        FilterEmulate $widgetFilter
    ) {
        $this->author = $author;
        $this->widgetFilter = $widgetFilter;
    }

    /**
     * @param int $authorId
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData(int $authorId): array
    {
        $authorData = $this->author->load($authorId);
		
        if (false === $authorData->getId()) {
            throw new NoSuchEntityException();
        }
        
        $authorLoadedData[] = $authorData->getData();
        
        return $authorLoadedData;
    }
}
