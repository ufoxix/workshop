/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/form/components/insert-listing',
    'underscore'
], function (Insert, _) {
    'use strict';

    return Insert.extend({

        /**
         * On action call
         *
         * @param {Object} data - simpleUi entity and actions
         */
        onAction: function (data) {
            this[data.action + 'Action'].call(this, data.data);
        },

        /**
         * On mass action call
         *
         * @param {Object} data - simpleUi entity
         */
        onMassAction: function (data) {
            this[data.action + 'Massaction'].call(this, data.data);
        },

        /**
         * Delete simpleUi entity
         *
         * @param {Object} data - simpleUi entity
         */
        deleteAction: function (data) {
            this._delete([parseFloat(data[data['id_field_name']])]);
        },

        /**
         * Mass action delete
         *
         * @param {Object} data - simpleUi entity
         */
        deleteMassaction: function (data) {
            var ids = _.map(data, function (val) {
                return parseFloat(val);
            });

            this._delete(ids);
        }
    });
});
