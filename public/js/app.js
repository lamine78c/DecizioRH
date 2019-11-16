$(document).ready(function () {
    _initDatatable();
    _initDatePicker();
});

function _initDatatable(){

    $('#datatable-list').DataTable({
          "language": {"url": "../localisation/fr_FR.json"}, 
          "columnDefs": [{ targets: 'no-sort', orderable: false }],
    });
}

function _initDatePicker() {
    $(".datepicker").datepicker({
        language : "fr",
        format: 'dd/mm/yyyy'
    });
}