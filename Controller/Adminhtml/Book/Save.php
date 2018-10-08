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

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use Ced\GraphQl\Model\Book;
/**
 * Class Save
 * @package Ced\GraphQl\Controller\Adminhtml\Book
 */
class Save extends \Magento\Backend\App\Action
{
	
	/**
	 * 
	 * @var Ced\GraphQl\Model\Book
	 */
	public $book;
    /**
     * 
     * @param Action\Context $context
     * @param Book $book
     */
    public function __construct(		
    	Action\Context $context,
    	Book $book
	)
    {
        parent::__construct($context);
        $this->book = $book;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->book->load($id);
            }
            unset($data['id']);
            $this->book->addData($data);
            try {
                $this->book->getResource()->save($this->book);
                $this->messageManager->addSuccess(__('You saved the book.'));
                
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                
                    return $resultRedirect->setPath('*/*/edit', ['id' => $this->book->getId(), '_current' => true]);
                }
                
                return $resultRedirect->setPath('*/*');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the book.'));
            }
            return $resultRedirect->setPath('*/*/');
        }
        $this->messageManager->addErrorMessage( __('Something went wrong while saving the book.'));
        return $resultRedirect->setPath('*/*/');
    }
}

