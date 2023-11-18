define([], function () {
    'use strict';

    return {
        /**
         * Here we can specify rules to display or not the Next Day Delivery shipping method based on address.
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
