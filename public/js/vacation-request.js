$(document).ready(function () {
    _initDatatable();
});

function initDateRangePicker() {
    var today = new Date();
    $('#startDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: today,
        format: 'dd/mm/yyyy',
        language: 'fr',
        startDate: today,
    }).change(function(e) {
        $('#endDate').datepicker('setStartDate', $('#startDate').val());
     });
    $('#endDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        startDate: today,
        format: 'dd/mm/yyyy',
        language: 'fr',
    }).change(function(e) {
        $('#startDate').datepicker('setEndDate', $('#endDate').val());
     });
}