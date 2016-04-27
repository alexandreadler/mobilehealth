$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load
$(function() {

    $(window).bind("load", function() {
        if ($(this).width() < 768) {
            $('.titulo').addClass('collapse')
        } else {
            $('.titulo').removeClass('collapse')
        }
    })

    if ($('body').width() < 768) {
        $('.titulo').addClass('collapse')
        $('.titulo').hide();

        $('.voltar').addClass('collapse')
        $('.voltar').hide();
        $('.logotipo img').css("margin","auto");
    }

    $(window).bind("resize", function() {
        if ($(this).width() < 768) {
            $('.titulo').hide();
            $('.voltar').parent().hide();
            $('.logotipo img').css("margin","inline");
        } else {
            $('.titulo').show();
            $('.voltar').parent().show();
            $('.logotipo img').css("margin","auto");
        }
    })

});

function validaCPF(cpf)
{
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
        return false;
    if (cpf.length > 11)
        cpf = unformatNumber(cpf);

    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1))
        {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais)
    {
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    }
    else
        return false;
}

function unformatNumber(pNum)
{
    return String(pNum).replace(/\D/g, "").replace(/^0+/, "");
}

