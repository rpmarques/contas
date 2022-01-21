$(document).ready(function () {
  $("#example1").DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json"
    },
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  


  // MÁSCARAS
  //TROCAR MÁSCARA DINAMICAMENTE CPF OU CNPJ
  var options = {
    onKeyPress: function (cpf, ev, el, op) {
      var masks = ['000.000.000-000', '00.000.000/0000-00'];
      $('.cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
  }

  //$('.cnpj').length > 11 ? $('.cnpj').data-inputmask-inputformat('00.000.000/0000-00', options) : $('.cnpj').data-inputmask-inputformat('000.000.000-00#', options);
  //data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask

});

