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

namespace Ced\GraphQl\Model\Resolver\Author;

use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Ced\GraphQl\Model\Author;

/**
 * CreateAuthor Class
 */
class CreateAuthor implements ResolverInterface
{
    /**
     * @var Author
     */
    private $author;

    /**
     * 
     * @param Author $author
     */
    public function __construct(
        Author $author
    ) {
        $this->author = $author;
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
        try {
            if (!isset($args['author_email'])) {
                throw new GraphQlInputException(__('"author_email" value should be specified'));
            }
            if (!isset($args['author_name'])) {
                throw new GraphQlInputException(__('"author_name" value should be specified'));
            }
            if (!isset($args['age'])) {
            	throw new GraphQlInputException(__('"age" value should be specified'));
            }
            if (!isset($args['affliation'])) {
            	throw new GraphQlInputException(__('"affliation" value should be specified'));
            }
            $this->author->addData($args);
            $this->author->getResource()->save($this->author);
            if($this->author->getId())
            return ['message'=>'Author Successfully Created', 'id' => $this->author->getId()];
            else 
            	return ['message'=>'Not Able To Create Author'];
        } catch (AuthenticationException $e) {
            throw new GraphQlAuthorizationException(
                __($e->getMessage())
            );
        }
    }
}
