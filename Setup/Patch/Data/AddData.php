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
namespace Ced\GraphQl\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class AddData
 * @package Ced\GraphQl\Setup\Patch\Data
 */
class AddData implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var \Ced\GraphQl\Model\Author
     */
    private $author;

    /**
     * 
     * @param \Ced\GraphQl\Model\Author $author
     */
    public function __construct(
        \Ced\GraphQl\Model\Author $author
    ) {
        $this->author = $author;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function apply()
    {
    	$authorData = [];
    	$authorData['author_name'] = "Andrew Tye";
    	$authorData['author_email'] = "andrew@email.com";
    	$authorData['affliation'] = "Andrew Company";
    	$authorData['age'] = 32;
        
    	$this->author->addData($authorData);
    	$this->author->getResource()->save($this->author);

    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '2.0.0';
    }
    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

}
