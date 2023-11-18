<?php

declare(strict_types=1);

namespace Envisage\NextDayDelivery\Model\Carrier;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;
use Psr\Log\LoggerInterface;

/**
 * Model to
 * @package Envisage_NextDayDelivery
 */
class NextDayDeliveryShippingMethod extends AbstractCarrier implements CarrierInterface
{
    // shipping method group code
    public $_code = 'nextdaydelivery';

    /**
     * NextDayDeliveryShippingMethod Constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        protected ScopeConfigInterface $scopeConfig,
        protected ErrorFactory $rateErrorFactory,
        protected LoggerInterface $logger,
        private readonly ResultFactory $rateResultFactory,
        private readonly MethodFactory $rateMethodFactory,
        protected array $data = [],
    ) {
        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $data
        );
    }

    /**
     * Shipping Rates Collector
     *
     * @param RateRequest $request
     * @return Result|bool
     */
    public function collectRates(RateRequest $request): Result|bool
    {
        // only add the delivery method if enabled
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var Result $result */
        $result = $this->rateResultFactory->create();

        // get shipping cost
        $shippingCost = (float) $this->getConfigData('shipping_cost');

        /** @var Method $shippingMethod */
        $shippingMethod = $this->rateMethodFactory->create();

        // set method data
        $shippingMethod->setData([
                'carrier'       => $this->_code,
                'carrier_title' => $this->getConfigData('title'),
                'method'        => $this->_code,
                'method_title'  => $this->getConfigData('name'),
                'price'         => $shippingCost,
                'cost'          => $shippingCost,
            ]);

        return $result->append($shippingMethod);
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods(): array
    {
        return [$this->_code => $this->getConfigData('name')];
    }
}
