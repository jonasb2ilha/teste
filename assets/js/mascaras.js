//adiciona mascara de data
function MascaraData(idade){
        if(mascaraInteiro(idade)==false){
                event.returnValue = false;
        }
        return formataCampo(idade, '00/00/0000', event);
}
//adiciona mascara de rg
function MascaraRg(rg){
        if(mascaraInteiro(rg)==false){
                event.returnValue = false;
        }
        return formataCampo(rg, '00.000.000-0', event);
}
//mascara $
function MascaraReal(real){
        if(mascaraInteiro(real)==false){
                event.returnValue = false;
        }
        return formataCampo(real, '0,00', event);
}
//adiciona mascara de rg
function MascaraCNPJ(cnpj){
        if(mascaraInteiro(cnpj)==false){
                event.returnValue = false;
        }
        return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(telefone){
        if(mascaraInteiro(telefone)==false){
                event.returnValue = false;
        }
        return formataCampo(telefone, '(00) 0000-0000', event);
}

//adiciona mascara ao telefone
function MascaraCep(cep){
        if(mascaraInteiro(cep)==false){
                event.returnValue = false;
        }
        return formataCampo(cep, '00000-0000', event);
}
//adiciona mascara ao telefone
function MascaraTel2(tel2){
        if(mascaraInteiro(tel2)==false){
                event.returnValue = false;
        }
        return formataCampo(tel2, '(00) 0000-0000', event);
}

//adiciona mascara ao Celular
function MascaraCelular(cel){
        if(mascaraInteiro(cel)==false){
                event.returnValue = false;
        }
        return formataCampo(cel, '(00) 00000-0000', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
        if(mascaraInteiro(cpf)==false){
                event.returnValue = false;
        }
        return formataCampo(cpf, '000.000.000-00', event);
}




//valida numero inteiro com mascara
function mascaraInteiro(){
        if (event.keyCode < 48 || event.keyCode > 57){
                event.returnValue = false;
                return false;
        }
        return true;
}



//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) {
        var boleanoMascara;

        var Digitato = evento.keyCode;
        exp = /\-|\.|\/|\(|\)| /g
        campoSoNumeros = campo.value.toString().replace( exp, "" );

        var posicaoCampo = 0;
        var NovoValorCampo="";
        var TamanhoMascara = campoSoNumeros.length;;

        if (Digitato != 8) { // backspace
                for(i=0; i<= TamanhoMascara; i++) {
                        boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                                || (Mascara.charAt(i) == "/"))
                        boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(")
                                                                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
                        if (boleanoMascara) {
                                NovoValorCampo += Mascara.charAt(i);
                                  TamanhoMascara++;
                        }else {
                                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
                                posicaoCampo++;
                          }
                  }
                campo.value = NovoValorCampo;
                  return true;
        }else {
                return true;
        }
}


