/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/form/components/insert-form',
    'uiRegistry',
], function (Insert) {
    'use strict';

    return Insert.extend({
        defaults: {
            listens: {
                responseData: 'onResponse'
            },
            modules: {
                simpleUiListing: '${ $.simpleUiListingProvider }',
                simpleUiModal: '${ $.simpleUiModalProvider }'
            }
        },

        /**
         * Close modal, reload simpleUi listing and save entity
         *
         * @param {Object} responseData
         */
        onResponse: function (responseData) {
            if (!responseData.error) {
                this.simpleUiModal().closeModal();
                this.simpleUiListing().reload({
                    refresh: true
                });
            }
        }
    });
});
