/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/form/components/button',
    'underscore'
], function (Button, _) {
    'use strict';

    return Button.extend({
        defaults: {
            entityId: null,
            customerId: null,
            listens: {
                entity: 'changeVisibility'
            }
        },

        /**
         * Apply action on target component,
         * but previously create this component from template if it is not existed
         *
         * @param {Object} action - action configuration
         */
        applyAction: function (action) {
            if (action.params && action.params[0]) {
                action.params[0]['entity_id'] = this.entityId;
                action.params[0]['customer_id'] = this.customerId;
            } else {
                action.params = [{
                    'entity_id': this.entityId,
                    'customer_id': this.customerId
                }];
            }

            this._super();
        },

        /**
         * Change visibility of the default simpleUi blocks
         *
         * @param {Object} entity - simpleUi
         */
        changeVisibility: function (entity) {
            this.visible(!_.isEmpty(entity));
        }
    });
});
