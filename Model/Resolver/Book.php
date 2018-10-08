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

namespace Ced\GraphQl\Model\Resolver;

use Ced\GraphQl\Model\Resolver\DataProvider\BookData as BookDataProvider;
use Ced\GraphQl\Model\Resolver\DataProvider\AuthorData as AuthorDataProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Book field resolver, used for GraphQL request processing
 */
class Book implements ResolverInterface
{
    /**
     * @var BookDataProvider
     */
    private $bookDataProvider;

    /**
     * @var AuthorDataProvider
     */
    private $authorDataProvider;
    /**
     * 
     * @param BookDataProvider $bookDataProvider
     * @param AuthorDataProvider $authorDataProvider
     */
    public function __construct(
        BookDataProvider $bookDataProvider,
    	AuthorDataProvider $authorDataProvider
    ) {
        $this->bookDataProvider = $bookDataProvider;
        $this->authorDataProvider = $authorDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $bookId = $this->getBookId($args);
        $bookData = $this->getBookData($bookId);

        return $bookData;
    }

    /**
     * @param array $args
     * @return int
     * @throws GraphQlInputException
     */
    private function getBookId(array $args): int
    {
        if (!isset($args['id'])) {
            throw new GraphQlInputException(__('"book id should be specified'));
        }

        return (int)$args['id'];
    }

    /**
     * @param int $bookId
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    private function getBookData(int $bookId): array
    {
        try {
            $bookData = $this->bookDataProvider->getData($bookId);
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }
        $authorId = $bookData['author'];
        $bookData['authorData'] = $this->getAuthorData((int) $authorId);
        return $bookData;
    }
    
    /**
     * @param int $authorId
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    private function getAuthorData(int $authorId):array{
    	
    	try {
    		$authorData = $this->authorDataProvider->getData($authorId);
    	} catch (NoSuchEntityException $e) {
    		throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
    	}
    		return $authorData;
    }
}
