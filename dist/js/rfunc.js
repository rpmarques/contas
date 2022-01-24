$(document).ready(function () {
  $("#example1").DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json"
    },
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  // MÁSCARAS
   $('.cnpj').inputmask();
   $('.cpf').inputmask();
  $('.fone').inputmask();

});

