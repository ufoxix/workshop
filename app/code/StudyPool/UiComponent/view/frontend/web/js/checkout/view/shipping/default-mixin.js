define([
    'jquery',
    'Magento_Checkout/js/checkout-data',
    'Magento_Ui/js/modal/confirm'
], function ($, checkoutData, confirmation) {
    'use strict';

    return function (target) {
        return target.extend({
            /**
             * @inheritdoc
             */
            placeOrder: function (data, event) {
                alert(checkoutData.getNewCustomerShippingAddress());
                return this._super(data, event);
            }
        });
    };
});
