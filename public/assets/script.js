jQuery(document).ready(function(){

    var $j = jQuery.noConflict();

    let datesDisabled = jQuery('#pret_date_debut').attr('data-dates-disabled');

    $j('#pret_date_debut').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        datesDisabled: datesDisabled
    });
    
});