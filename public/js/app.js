$(document).ready(function () {
    _initDatatable();
});

function _initDatatable(){

    $('#datatable-list').DataTable({
          "language": {"url": "../localisation/fr_FR.json"},                
    });
}