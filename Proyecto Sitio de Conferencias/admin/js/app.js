$(document).ready(function () {
    $('.sidebar-menu').tree()
    // $('#registros').DataTable();
    $('#registros').DataTable({
      'paging'      : true,
      'pageLength'  : 10,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'language'    : {
        paginate    : {
          next      : 'Siguiente',
          previous  : 'Anterior',
          last      : 'Último',
          first     : 'Primero'
        },
        info        : 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
        infoEmpty   : '0 registros',
        emptyTable  : 'No hay registros',
        search      : 'Buscar'
      }
  });
});