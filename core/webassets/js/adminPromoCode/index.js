$(document).ready(function(){
    promoCodeHandler();
    promoCodeReportByMonthHandler();
    promoCodeReportByUserHandler();
    promoCodeReportByBothHandler();
});

var promoCodeHandler = function() {

    var promocodeTrigger = $("#promocodeOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-promocode-button').off('click');
    $('#fab-promocode-button').on('click',function(e){
        e.preventDefault();
        $("#promocodeOverlay").overlay().load();
    });
}

var promoCodeReportByMonthHandler = function() {

    var promocodeReportByMonthTrigger = $("#promocodeReportByMonthOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-promocode-reportbymonth-button').off('click');
    $('#fab-promocode-reportbymonth-button').on('click',function(e){
        e.preventDefault();
        $("#promocodeReportByMonthOverlay").overlay().load();
    });
}

var promoCodeReportByUserHandler = function() {

    var promocodeReportByUserTrigger = $("#promocodeReportByUserOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-promocode-reportbyuser-button').off('click');
    $('#fab-promocode-reportbyuser-button').on('click',function(e){
        e.preventDefault();
        $("#promocodeReportByUserOverlay").overlay().load();
    });
}

var promoCodeReportByBothHandler = function() {

    var affidavitReportByBothTrigger = $("#promocodeReportByBothOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-promocode-reportbyboth-button').off('click');
    $('#fab-promocode-reportbyboth-button').on('click',function(e){
        e.preventDefault();
        $("#promocodeReportByBothOverlay").overlay().load();
    });
}