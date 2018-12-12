$(document).ready(function () {
    $('.sidebar-menu').tree()
    // $('#registros').DataTable();
    $('#registros').DataTable({
      'paging'      : true,
      'pageLength'  : 3,
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

  $('#crear-registro-admin').attr("disabled", true);
  $('#repetir_password').on('input',function(){

    var password_nuevo = $('#password').val();
    // console.log("¿Son iguales?: " + ($(this).val() == password_nuevo) );

    if($(this).val() == password_nuevo){
      $('#resultado_password').text('Correcto');
      $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
      $('input#password').parents('.form-group').addClass('has-success').removeClass('has-error');
      $('#crear-registro-admin').attr("disabled", false);
    } else{
      $('#resultado_password').text('No son iguales!');
      $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
      $('input#password').parents('.form-group').addClass('has-error').removeClass('has-success');
    };
  });


});