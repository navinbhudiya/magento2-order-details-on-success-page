<?php

namespace Navin\OrderDetails\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    private $httpContext;
    protected $productRepository;
    protected $_session;
    protected $price_helper;
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param \Magento\Customer\Model\Session $session
     * @param \Magento\Framework\Pricing\Helper\Data
     */
    public function __construct(
    \Magento\Framework\App\Helper\Context $context,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
    \Magento\Catalog\Model\ProductRepository $productRepository,
    \Magento\Framework\App\Http\Context $httpContext,
    \Magento\Customer\Model\Session $session,
    \Magento\Framework\Pricing\Helper\Data $price_helper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->productRepository = $productRepository;
        $this->httpContext = $httpContext;
        $this->_session = $session;
        $this->price_helper=$price_helper;
        parent::__construct($context);
    }
    /**
     * Get Any Store Configuration
     * @param string $storePath Full path of any configuration
     * @return string $storeConfig
     */
    public function getStoreConfig($storePath) {
        $storeConfig = $this->scopeConfig->getValue($storePath, ScopeInterface::SCOPE_STORE);
        return $storeConfig;
    }

    /**
     * Load product from productId
     * @param int $id Product id
     * @return $this
     */
    public function getProductById($id) {
        return $this->productRepository->getById($id);
    }

    /**
     * Check Customer is login or not
     * @return boolean
     */
    public function isLoggedIn() {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }

    /**
     * Get Formated Price
     * @param fload price 
     * @return boolean
    */
    public function getFormatedPrice($price='')
    {
        return $this->price_helper->currency($price, true, false);
    }

}
