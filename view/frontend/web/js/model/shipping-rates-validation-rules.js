define([], function () {
    'use strict';

    return {
        /**
         * Here we can specify validation rules for the "Next Day Delivery" shipping method.
         *
         * @return {Object}
         */
        getRules: function () {
            return {
                'postcode': {
                    'required': false
                },
                'country_id': {
                    'required': false
                },
                'region_id': {
                    'required': false
                },
            };
        }
    };
});
