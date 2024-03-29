$(function () {

    var data = new Date();
    var mesAtual = data.getMonth() + 1;

    $('#mes_' + mesAtual).show();

    $('#vai').on('click', function (e) {
        e.preventDefault();
        mesAtual += 1;
        hideShow();
        return false;
    });

    $('#volta').on('click', function (e) {
        e.preventDefault();
        mesAtual -= 1;
        hideShow();
        return false;
    });

    function hideShow() {
        if (mesAtual > 12) {
            mesAtual = 1;
        } else if (mesAtual < 1) {
            mesAtual = 12;
        }

        $('.mes').hide();
        $('#mes_' + mesAtual).show();
    }

    //Initialize Select2 Elements
    if ($('.select2').length !== 0) {
        $('.select2').select2()
    }

    // if #javascript-ajax-button exists
    if ($('#depto').length !== 0) {

        $('#depto').on('change', function () {

            var depto = $("#depto").val();

            if (depto != 0) {

                $.ajax(url + "/home/getAllRolesByDeptoID/" + depto)
                    .done(function (result) {
                        $('#listcargos').html(result);
                    })
                    .fail(function () {

                    })
                    .always(function () {

                    });
            }
        });
    }

    // BUSCA CNPJ
    if ($('#VerificarCNPJ').length !== 0) {

        $('#VerificarCNPJ').on('click', function () {

            var cnpj = $("#cnpj").val();

            if (cnpj != 0) {

                $.ajax(url + "/home/checkCnpj/" + cnpj)
                    .done(function (result) {
                        $('#msg').html(result.info);
                        var type = "";
                        if (!result.data) {
                            type = "warning";
                            $('#msg').addClass('alert-danger').removeClass('alert-success')
                            $('#razao').val("").removeAttr('readonly')
                            $('#fantasia').val("").removeAttr('readonly')
                            $('#cep').val("");
                            $('#endereco').val("")
                            $('#complemento').val("")
                            $('#cidade').val("")
                            $('#estado').val("")
                        } else {
                            type = "success";
                            $('#msg').addClass('alert-success').removeClass('alert-danger')
                            $('#razao').val(result.data.nome).attr('readonly', true)
                            $('#fantasia').val(result.data.fantasia).attr('readonly', true)
                            $('#cep').val(result.data.cep.replace('.', ''))
                            $('#endereco').val(result.data.logradouro + ", " + result.data.numero)
                            $('#complemento').val(result.data.complemento)
                            $('#cidade').val(result.data.municipio)
                            $('#estado').val(result.data.uf)
                        }

                        toastr[type](result.info)
                    })
                    .fail(function () {

                    })
                    .always(function () {

                    });
            }
        });
    }

    // BUSCA CNPJ
   /* if ($('#VerificarCNPJFornecedor').length !== 0) {

        $('#VerificarCNPJFornecedor').on('click', function () {

            var cnpj = $("#cnpj").val();

            if (cnpj != 0) {

                $.ajax(url + "/home/checkCnpjFornecedor/" + cnpj)
                    .done(function (result) {
                        $('#cnpjDetails').html(result);
                    })
                    .fail(function () {

                    })
                    .always(function () {

                    });
            }
        });
    }*/

    if ($('#cargo').length !== 0) {

        $('#cargo').on('change', function () {

            var cargo = $("#cargo").val();

            if (cargo != 0) {

                $.ajax(url + "/home/getJobRolePermissionsByID/" + cargo)
                    .done(function (result) {
                        $('#cargo-result').html(result);
                    })
                    .fail(function () {

                    })
                    .always(function () {

                    });
            }
        });
    }
});


function toggleFullScreen(elem) {

    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}

function showResult(str) {
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            document.getElementById("livesearch").style.display = "block";
        }
    }
    xmlhttp.open("GET", url + "/home/getClienteByName/" + str, true);
    xmlhttp.send();
}

function contaSearch(id) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("conta").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", url + "/home/getAllContasByClienteID/" + id, true);
    xmlhttp.send();
}

function getContaContato(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("contato").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", url + "/home/getContaContatoByID/" + id, true);
    xmlhttp.send();
}

function showHide(id) {
    console.log(id)
    var e = document.getElementById(id);
    if (e.style.display == 'block')
        e.style.display = 'none';
    else
        e.style.display = 'block';
}

function showVip(val) {
    var vip = document.getElementById("vip");
    if (val == 'y') {
        vip.style.display = 'block';
    } else if (val == 'n') {
        vip.style.display = 'none';
    }
}


function delBriefingItem(produto, briefing) {
    $.ajax(url + "/home/delBriefingItem/" + produto + "/" + briefing)
        .done(function (result) {
            $('#briefingItens').html(result);
        })
        .fail(function () {

        })
        .always(function () {

        });
}

function addVeiculacao(qtd, data, prod, brief, crm) {
    console.log('crm: ' + crm);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("return").innerHTML = this.responseText;
            return true
        }
    }
    xmlhttp.open("GET", url + "/home/addBriefingDetail/" + brief + "/" + prod + "/" + data + "/" + qtd + "/" + crm, true);
    xmlhttp.send();
}

function getCargoList(id) {
    var depto = id
    console.log(depto);
    if (depto != 0) {

        $.ajax(url + "/home/getAllRolesByDeptoID/" + depto)
            .done(function (result) {
                $('.listcargos').html(result);
            })
            .fail(function () {

            })
            .always(function () {

            });
    }
}

$(function () {
    $('.currency').maskMoney();
})

$(function () {
    $(".money").mask("#.##0,00", {
        reverse: true
    });
    $('#cep').mask('99999-999');
    $('#cpf').mask('999.999.999-99');
    $('#rg').mask('99.999.999-9');
    //$('#celular').mask('(99) 99999-9999');
    //$('#telefone').mask('(99) 9999-9999');
    $('#cnpj').mask('99.999.999/9999-99');
    $('#data').mask('99/99/9999');
})

var behavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
options = {
    onKeyPress: function (val, e, field, options) {
        field.mask(behavior.apply({}, arguments), options);
    }
};
$('.telefone').mask(behavior, options);