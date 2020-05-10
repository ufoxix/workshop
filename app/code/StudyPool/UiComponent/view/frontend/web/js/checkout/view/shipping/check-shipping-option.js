define([
    'jquery',
    'uiComponent',
    'Magento_Checkout/js/checkout-data',
    'Magento_Ui/js/modal/confirm'
], function ($, Component, checkoutData, confirmation) {
    'use strict';

    return Component.extend({

        /**
         * Get options from data provider
         *
         * @see \StudyPool\UiComponent\Model\Ui\Frontend\Checkout\Shipping\ShippingOptionsConfigProvider
         * @array
         */
        optionsArray: window.checkoutConfig.shipping_options,

        initialize: function () {
            this._super();
            if (!this.optionsArray.enabled) {
                return false;
            }

            this.checkShippingMethod();
        },

        /**
         * Check payment method was selected
         */
        checkShippingMethod: function () {
            let self = this;

            console.log(checkoutData.getSelectedPaymentMethod());

            $('body').on('click', '#cashondelivery', function () {
                self.showConfirmation();
            });

            if (checkoutData.getSelectedPaymentMethod()
                && checkoutData.getSelectedPaymentMethod() === 'cashondelivery') {
                self.showConfirmation();
            }
        },

        /**
         * Show confirmation popup
         */
        showConfirmation: function () {
            let self = this;
            confirmation({
                title: $.mage.__(self.optionsArray.title),
                content: $.mage.__(self.optionsArray.body),

                buttons: [{
                    text: $.mage.__('Cancel'),
                    class: 'action-secondary action-dismiss',
                    click: function (event) {
                        this.closeModal(event);
                    }
                }, {
                    text: $.mage.__('Confirm'),
                    class: 'action-primary action-accept',
                    click: function (event) {
                        this.closeModal(event, true);
                    }
                }]
            });
        }
    });
});
