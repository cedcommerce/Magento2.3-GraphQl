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

use Magento\Backend\App\Action\Context;
use Ced\GraphQl\Model\Book;
class Delete extends \Magento\Backend\App\Action
{
	/**
	 *
	 * @var Ced\GraphQl\Model\Book
	 */
	protected $book;
	
	/**
	 * @param Context $context
	 * @param Book $book
	 */
	public function __construct(
			Context $context,
			Book $book
	) {
		parent::__construct($context);
		$this->book = $book;
	}
	
	/**
	 * Delete action
	 *
	 * @return \Magento\Framework\Controller\ResultInterface
	 */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
			
        if (!$id) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
        	$this->book->load($id);
            $this->book->delete();
            $this->messageManager->addSuccess(__('Book Has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete Book: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
