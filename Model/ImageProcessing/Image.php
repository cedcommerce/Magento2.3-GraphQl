<?php
/**
 * CedCommerce
  *
  * NOTICE OF LICENSE
  *
  * This source file is subject to the End User License Agreement (EULA)
  * that is bundled with this package in the file LICENSE.txt.
  * It is also available through the world-wide-web at this URL:
  * http://cedcommerce.com/license-agreement.txt
  *
  * @category  Ced
  * @package   Ced_GraphQl
  * @author    CedCommerce Core Team <connect@cedcommerce.com >
  * @copyright Copyright CEDCOMMERCE (http://cedcommerce.com/)
  * @license      https://cedcommerce.com/license-agreement.txt
  */
declare(strict_types=1);

namespace Ced\GraphQl\Model\ImageProcessing;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Image
{
    /**
     * @var FileInfo
     */
    private $fileInfo;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Initialize dependencies.
     *
     * @param FileInfo $fileInfo
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        FileInfo $fileInfo,
        StoreManagerInterface $storeManager
    ) {
        $this->fileInfo = $fileInfo;
        $this->storeManager = $storeManager;
    }
    /**
     * Resolve author image URL
     *
     * @param string $image
     * @return string
     * @throws LocalizedException
     */
    public function getUrl($image=null): string
    {
        $url = '';
        if ($image) {
            if (is_string($image)) {
                $store = $this->storeManager->getStore();
                $mediaBaseUrl = $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
                if ($this->fileInfo->isBeginsWithMediaDirectoryPath($image)) {
                    $relativePath = $this->fileInfo->getRelativePathToMediaDirectory($image);
                    $url = rtrim($mediaBaseUrl, '/') . '/' . ltrim($relativePath, '/');
                } elseif (substr($image, 0, 1) !== '/') {
                    $url = rtrim($mediaBaseUrl, '/') . '/' . ltrim(FileInfo::ENTITY_MEDIA_PATH, '/') . '/' . $image;
                } else {
                    $url = $image;
                }
            } else {
                throw new LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }
}
