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

use Ced\GraphQl\Model\Book;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Widget\Model\Template\FilterEmulate;

/**
 * BookData data provider
 */
class BookData
{
    /**
     * @var FilterEmulate
     */
    private $widgetFilter;

    /**
     * @var Book
     */
    private $book;

    /**
     * 
     * @param Book $book
     * @param FilterEmulate $widgetFilter
     */
    public function __construct(
        Book $book,
        FilterEmulate $widgetFilter
    ) {
        $this->book = $book;
        $this->widgetFilter = $widgetFilter;
    }

    /**
     * @param int $bookId
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData(int $bookId): array
    {
        $bookData = $this->book->load($bookId);
		
        if (false === $bookData->getId()) {
            throw new NoSuchEntityException();
        }
        $bookLoadedData = $bookData->getData();
        return $bookLoadedData;
    }
}
