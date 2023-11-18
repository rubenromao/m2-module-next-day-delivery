define([
    'uiComponent',
    'Magento_Checkout/js/model/shipping-rates-validator',
    'Magento_Checkout/js/model/shipping-rates-validation-rules',
    '../model/shipping-rates-validator',
    '../model/shipping-rates-validation-rules',
], function (
    Component,
    defaultShippingRatesValidator,
    defaultShippingRatesValidationRules,
    nextdaydeliveryShippingRatesValidator,
    nextdaydeliveryShippingRatesValidationRules
) {
    'use strict';

    defaultShippingRatesValidator.registerValidator('nextdaydelivery', nextdaydeliveryShippingRatesValidator);
    defaultShippingRatesValidationRules.registerRules('nextdaydelivery', nextdaydeliveryShippingRatesValidationRules);


    return Component;
});
