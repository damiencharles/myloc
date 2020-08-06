jQuery(document).ready(function(){

    var $j = jQuery.noConflict();

    let datesDisabled = jQuery('.js-datepicker').attr('data-dates-disabled');
    $j('.js-datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        datesDisabled: datesDisabled
    });
    
});