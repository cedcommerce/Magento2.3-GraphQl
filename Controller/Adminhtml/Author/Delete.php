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
use Magento\Backend\App\Action\Context;
use Ced\GraphQl\Model\Author;

/**
 * Class Delete
 * @package Ced\GraphQl\Controller\Adminhtml\Author
 */
class Delete extends \Magento\Backend\App\Action
{
	/**
	 * 
	 * @var Ced\GraphQl\Model\Author
	 */
	protected $author;
	
	/**
     * @param Context $context
     * @param Author $author
     */
	public function __construct(
			Context $context,
			Author $author
	) {
		parent::__construct($context);
		$this->author = $author;
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
        	$this->author->load($id);
            $this->author->delete();
            $this->messageManager->addSuccess(__('Author Has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete Author: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
