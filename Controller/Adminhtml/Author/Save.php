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

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use Ced\GraphQl\Model\Author;

/**
 * Class Save
 * @package Ced\GraphQl\Controller\Adminhtml\Author
 */

class Save extends \Magento\Backend\App\Action
{
	
	/**
	 * @var Ced\GraphQl\Model\Author
	 */
	public $author;
	
    /**
     * 
     * @param Action\Context $context
     * @param Author $author
     */
    public function __construct(		
    	Action\Context $context,
    	Author $author
	)
    {
        parent::__construct($context);
        $this->author = $author;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ced_Author::save');
    }


    /**
     * Filter request data
     *
     * @deprecated 101.0.8
     * @param array $rawData
     * @return array
     */
    protected function _filterPostData(array $rawData)
    {
        $data = $rawData;
        if (isset($data['logo'][0]['name'])) {
            $data['logo'] = $data['logo'][0]['name'];
        } else {
            $data['logo'] = '';
        }
            
        return $data;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->_filterPostData($this->getRequest()->getPostValue());
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($data) {

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->author->load($id);
            }
            unset($data['id']);
            $this->author->addData($data);
            try {
                $this->author->getResource()->save($this->author);
                $this->messageManager->addSuccess(__('You saved the Author.'));
                
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {             
                    return $resultRedirect->setPath('*/*/edit', ['id' => $this->author->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the author.'));
            }
            return $resultRedirect->setPath('*/*/');
        }
        $this->messageManager->addErrorMessage( __('Something went wrong while saving the author.'));
        return $resultRedirect->setPath('*/*/');
    }
    
}

