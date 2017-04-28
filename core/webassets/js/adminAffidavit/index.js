$(document).ready(function(){
    affidavitHandler();
    affidavitReportByMonthHandler();
    affidavitReportByStationHandler();
    affidavitReportByMonthAndStationHandler();
});

var affidavitHandler = function() {

    var affidavitTrigger = $("#affidavitOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-affidavit-button').off('click');
    $('#fab-affidavit-button').on('click',function(e){
        e.preventDefault();
        $("#affidavitOverlay").overlay().load();
    });
}

var affidavitReportByMonthHandler = function() {

    var affidavitReportByMonthTrigger = $("#affidavitReportByMonthOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-affidavit-reportbymonth-button').off('click');
    $('#fab-affidavit-reportbymonth-button').on('click',function(e){
        e.preventDefault();
        $("#affidavitReportByMonthOverlay").overlay().load();
    });
}

var affidavitReportByStationHandler = function() {

    var affidavitReportByStationTrigger = $("#affidavitReportByStationOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-affidavit-reportbystation-button').off('click');
    $('#fab-affidavit-reportbystation-button').on('click',function(e){
        e.preventDefault();
        $("#affidavitReportByStationOverlay").overlay().load();
    });
}

var affidavitReportByMonthAndStationHandler = function() {

    var affidavitReportByMonthAndStationTrigger = $("#affidavitReportByMonthAndStationOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });

    $('#fab-affidavit-reportbymonthandstation-button').off('click');
    $('#fab-affidavit-reportbymonthandstation-button').on('click',function(e){
        e.preventDefault();
        $("#affidavitReportByMonthAndStationOverlay").overlay().load();
    });
}