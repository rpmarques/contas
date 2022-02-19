$(document).ready(function () {

  //TROCAR MÁSCARA DINAMICAMENTE CPF OU CNPJ
  var options = {
    onKeyPress: function (cpf, ev, el, op) {
      var masks = ['000.000.000-000', '00.000.000/0000-00'];
      $('.cgc').mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
  }
  $('.cgc').length > 11 ? $('.cgc').mask('00.000.000/0000-00', options) : $('.cgc').mask('000.000.000-00#', options);


  // PRICEFORMAT
  $('.valor').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.',
    allowNegative: false
  });
  $('.qtde').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.',
    allowNegative: false
  });
  //Date range picker
  $('.data_intervalo').daterangepicker({
    "locale": {
      "format": "DD/MM/YYYY", //DATA NO FORMATO DD/MM/AAAA
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar"
    }
  })
  // DATAPICKER
  $('.data').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    autoclose: "true",
    immediateUpdates: "true",
    todayHighlight: "true"
  });

  //Select2 
  $('.select2').select2({
    theme: 'bootstrap4'
  })

  // DATATABLE
  $("#example1").DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json"
    },
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  // MÁSCARAS
  // $('.cnpj').inputmask();
  // $('.cpf').inputmask();
  // $('.fone').inputmask();
  $('.fone').mask('(00)-00000-0000');
  $('.cep').mask('00000-000');



  $('.cgc').blur(function () {
    // O CPF ou CNPJ
    var cpf_cnpj = $(this).val();
    // Testa a validação
    if (valida_cpf_cnpj(cpf_cnpj)) {
      alert('OK');
    } else {
      alert('CPF ou CNPJ inválido!');
    }
  });

});

  // $(function validaCpf() {
  //   $('.cpf').blur(function () {
  //     var cpf = $('.cpf').val();
  //     // Testa a validação
  //     console.log(cpf);
  //     if (!valida_cpf_cnpj(cpf)) {
  //       console.log("CPF INVÁLIDO");
  //       alert('CPF  inválido!');
  //       let xxx = document.getElementById("fone1");
  //       xxx.focus();
  //     } else {
  //       console.log("CPF valido");
  //     }
  //   }); //FIM CPF
  // });
  // $(function validaCnpj() {
  //   $('.cnpj').blur(function () {
  //     var cnpj = $('.cnpj').val();
  //     console.log(cnpj);
  //     if (!valida_cpf_cnpj(cnpj)) {
  //       //console.log("CNPJ INVÁLIDO");
  //       alert('CNPJ  inválido!');
  //       let xxx = document.getElementById("fone1");
  //       xxx.focus();
  //     } else {
  //       console.log("CNPJ válido");
  //     }

  //   }); //FIM CNPJ
  // });
