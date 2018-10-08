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
namespace Ced\GraphQl\Controller\Adminhtml\Author;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Ced\GraphQl\Model\Author;

/**
 * Class Edit
 * @package Ced\GraphQl\Controller\Adminhtml\Author
 */
class Edit extends \Magento\Backend\App\Action
{
	/**
	 * 
	 * @var Ced\GraphQl\Model\Author
	 */
	protected  $author;
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
     * @param Author $author
     */
    public function __construct(
        Context $context,
    	PageFactory $resultPageFactory,
    	Registry $registry,
    	Author $author
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->author = $author;
    }
    /**
     * (non-PHPdoc)
     * @see \Magento\Framework\App\ActionInterface::execute()
     */
    public function execute()
    {
        $authorId = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
	     if($authorId){
	       	$authorDetails = $this->author->load($authorId);
	       	if(!$authorDetails->getId()){
	       		$this->messageManager->addErrorMessage(__('Author Does Not Exist'));
	       		return $resultRedirect->setPath('*/*/*');
	       	}
	       	$this->_coreRegistry->register('author',$authorDetails);
	       	$resultPage = $this->resultPageFactory->create();
	       	$resultPage->addHandle('cedgraphql_author_new');
	       	$resultPage->setActiveMenu('Ced_Author::'.$authorDetails->getAuthorName());
	       	$resultPage->getConfig()->getTitle()->prepend(__($authorDetails->getAuthorName()));
	       	return $resultPage;
	       	
	     }else{
	     	$this->messageManager->addErrorMessage(__('Something Went Wrong'));
	     	return $resultRedirect->setPath('*/*/*');
	     }
    }
}