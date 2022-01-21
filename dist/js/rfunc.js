$(document).ready(function() {
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

$(function () {
    //Initialize Select2 Elements

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()




  })
