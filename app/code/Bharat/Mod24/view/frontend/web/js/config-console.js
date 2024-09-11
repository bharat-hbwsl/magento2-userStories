define([
    'jquery',
    'mage/translate'
], function ($, $t) {
    'use strict';

    return function (config) {
        console.log('Config Data:', config.configData);
        console.log($t('Sales Email:'), config.configData.sales_email);
        console.log($t('Payment Methods:'), config.configData.payment_methods);
    };
});
