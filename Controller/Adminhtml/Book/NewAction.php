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
namespace Ced\GraphQl\Controller\Adminhtml\Book;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class NewAction
 * @package Ced\GraphQl\Controller\Adminhtml\Book
 */
class NewAction extends \Magento\Backend\App\Action
{
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;
    
	/**
	 * 
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param PageFactory $resultPageFactory
	 */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
    	PageFactory $resultPageFactory
    ) {
    	$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * (non-PHPdoc)
     * @see \Magento\Framework\App\ActionInterface::execute()
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ced_Author::book');
        $resultPage->getConfig()->getTitle()->prepend(__('Book'));
        $resultPage->getConfig()->getTitle()->prepend(__('New Book'));
        return $resultPage;
    }
}