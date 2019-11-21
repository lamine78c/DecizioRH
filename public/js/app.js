$(document).ready(function () {
    _initDatatable();
    _initDatePicker();
});

function _initDatatable(){

    $('#datatable-list').DataTable({
          "language": {"url": "../localisation/fr_FR.json"},                
    });
}

function _initDatePicker() {
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#startDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: today,
        format: 'dd-MM-yyyy',
        language: 'fr',
        startDate: today,
        maxDate: function () {
            return $('#endDate').val();
        }
    });
    $('#endDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: function () {
            return $('#startDate').val();
        },
        format: 'dd-MM-yyyy',
        language: 'fr',
    });

    $('.datepicker').datepicker({
        language : 'fr',
        format: 'dd-MM-yyyy'
    });
}