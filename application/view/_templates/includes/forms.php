
<!-- Select2 -->
<script src="<?php echo URL; ?>plugins/select2.js"></script>
<!-- InputMask -->
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo URL; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script>
    $(function () {
        $('#datemask').inputmask('dd/mm/aaaa');
        $('#cep').inputmask('99999-999');
        $('#cpf').inputmask('999.999.999-99');
        $('#rg').inputmask('99.999.999-99');
        $('#celular').inputmask('(99) 99999-9999');
        $('#telefone').inputmask('(99) 9999-9999');
        $('#cnpj').inputmask('99.999.999/9999-99');
    })
</script>