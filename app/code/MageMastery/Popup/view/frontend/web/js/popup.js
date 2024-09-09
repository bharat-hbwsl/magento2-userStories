define (
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],function($, modal){
        'use strict';
        return function (settings){
            // console.log(settings);
            console.log(settings.content);
            const content=settings.content,
                  timeout=settings.timeout;
            const options={
                type:'popup',
                responsive:true,
                autoOpen:true,
            };
            $('<div/>').html(content).modal(options);
        }
    }
);