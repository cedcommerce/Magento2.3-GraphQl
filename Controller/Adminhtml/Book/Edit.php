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
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Ced\GraphQl\Model\Book;

/**
 * Class Edit
 * @package Ced\GraphQl\Controller\Adminhtml\Book
 */
class Edit extends \Magento\Backend\App\Action
{
	/**
	 *
	 * @var Ced\GraphQl\Model\Book
	 */
	protected  $book;
	/**
	 *
	 * @var Magento\Framework\Registry
	 */
	protected $_coreRegistry;
	/**
	 *
	 * @var Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;
    /**
     * 
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param Book $book
     */
    public function __construct(
        Context $context,
    	PageFactory $resultPageFactory,
    	Registry $registry,
    	Book $book
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->book = $book;
    }
    /**
     * (non-PHPdoc)
     * @see \Magento\Framework\App\ActionInterface::execute()
     */
    public function execute()
    {
        $bookId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
	     if($bookId){
	       	$bookDetails = $this->book->load($bookId);
	       	if(!$bookDetails->getId()){
	       		$this->messageManager->addErrorMessage(__('Author Does Not Exist'));
	       		return $resultRedirect->setPath('*/*/*');
	       	}
	       	$this->_coreRegistry->register('book',$bookDetails);
	       	$resultPage = $this->resultPageFactory->create();
	       	$resultPage->addHandle('cedgraphql_book_new');
	       	$resultPage->setActiveMenu('Ced_Book::'.$bookDetails->getBookName());
	       	$resultPage->getConfig()->getTitle()->prepend(__($bookDetails->getBookName()));
	       	return $resultPage;
	       	
	     }else{
	     	$this->messageManager->addErrorMessage(__('Something Went Wrong'));
	     	return $resultRedirect->setPath('*/*/*');
	     }
    }
}