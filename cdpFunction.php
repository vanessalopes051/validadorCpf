<?php

$cpf = $_POST["cpf"];

$cpfComUmDigito = calculaPrimeiroDigito($cpf);
$cpfComDoisDigitos = calculaSegundoDigito($cpfComUmDigito);
validaCpf($cpf, $cpfComDoisDigitos);

//=======================================================================
//	FUNÇÃO CALCULA O PRIMEIRO DIGITO VERIFICADOR
//=======================================================================

function calculaPrimeiroDigito($cpf){
    $cont = 1;
    $multiplica = 0;
    $totalMultiplica = 0;

    for ($i = strlen($cpf) - 3; $i >= 0; $i--) {

        $cont++; //CONTADOR PARA MULTIPLICAR CADA DIGITO POR NUMEROS DECRECENTES A PARTIR DO 2	
        $multiplica = ($cpf[$i] * $cont);//MULTIPLICA CADA DIGITO POR UM NUMERO DECRESCENTE
        $totalMultiplica += $multiplica; //RECEBE A SOMA DA MULTIPLICAÇÃO DOS VALORES
    
    } //FIM DO FOR
    
    $restoDivisao = $totalMultiplica % 11; // RECEBE O RESTO DA DIVISÃO DO VALOR DA SOMA DIVIDO POR 11
    
    //SE O RESULTADO DO RESTO DA DIVISÃO FOR MENOR QUE 2 O PRIMEIRO DIGITO VERIFICADOR SERÁ IGUAL A 0
    if ($restoDivisao < 2) {
        $digitoVerificador = 0;
    
    //SE O RESULTADO DO RESTO DA DIVISÃO FOR MAIOR OU IGUAL QUE 2 O PRIMEIRO DIGITO VERIFICADOR SERÁ IGUAL AO RESULTADO DO RESTO DA DIVIDÃO MENOS 11	
    } else {
        $digitoVerificador = 11 - $restoDivisao;
    }


    for ($i = 0; $i <= 8; $i++) { //FOR PARA ATRIBUI OS NOVE PRIMEIROS DIGITOS DO CPF PARA O ARRAY
        $cpfRecebe[] = $cpf[$i];
    }
    
    $cpfComUmDigito = (implode("", $cpfRecebe) . $digitoVerificador); //CONCATENA OS NOVE PRIMEIROS DIGITOS DO CPF COM O DIGITO VERIFICADR JÁ CALCULADO
    
    return $cpfComUmDigito;
}


//=======================================================================
//	FUNÇÃO CALCULA O SEGUNDO DIGITO VERIFICADOR
//=======================================================================

function calculaSegundoDigito($cpfComUmDigito){
    $cont = 1;
    $multiplica = 0;
    $totalMultiplica = 0;

   for ($i = strlen($cpfComUmDigito) - 1; $i >= 0; $i--) { //ESSA LINHA VAI PEGAR OS 9 PRIMEIROS DIGITOS MAIS O DÍGITO VERIFICADOR E INVERTER

	$cont++; //CONTADOR PARA MULTIPLICAR CADA DIGITO POR NUMEROS DECRECENTES A PARTIR DO 2	
	$multiplica = ($cpfComUmDigito[$i] * $cont); //MULTIPLICA CADA DIGITO POR UM NUMERO DECRESCENTE
	$totalMultiplica += $multiplica; //RECEBE A SOMA DA MULTIPLICAÇÃO DOS VALORES

} //FIM DO FOR

$restoDivisao2Digito = $totalMultiplica % 11; // RECEBE O RESTO DA DIVISÃO DO VALOR DA SOMA DIVIDO POR 11

if ($restoDivisao2Digito < 2) { //SE O RESULTADO DO RESTO DA DIVISÃO FOR MENOR QUE 2 O PRIMEIRO DIGITO VERIFICADOR SERÁ IGUAL A 0
    $SegundodigitoVerificador = 0;
    echo "<br> Segundo Digito: ". $SegundodigitoVerificador;
	
} else { //SE O RESULTADO DO RESTO DA DIVISÃO FOR MAIOR OU IGUAL QUE 2 O PRIMEIRO DIGITO VERIFICADOR SERÁ IGUAL AO RESULTADO DO RESTO DA DIVIDÃO MENOS 11	
    $SegundodigitoVerificador = 11 - $restoDivisao2Digito;
    echo "<br> Segundo Digito: ". $SegundodigitoVerificador;
}

$cpfComDoisDigitos = ($cpfComUmDigito . $SegundodigitoVerificador); //VARIAVEL QUE CONCATENA O CPF COM O SEGUNDO DÍGITO VERIFICADOR

return $cpfComDoisDigitos;

}


//=======================================================================
// FUNÇÃO VALIDAÇÃO DO CFP
//=======================================================================

function validaCpf($cpf, $cpfComDoisDigitos){

    if ($cpf == $cpfComDoisDigitos) { //SE O CPF DE ENTRADA FOR IGUAL AO CPF CALCULADO ENTÃO EXIBE "CPF VÁLIDO"

        echo '<script language="javascript">alert("Cpf Válido e formatado:  '.substr($cpf, 0, -8).".".substr($cpf, 3, -5).".".substr($cpf, 6, -2)."-".substr($cpf, -2).'"); location.href="index.php";</script>';
    
    } else { //SENÃO EXIBE CPF INVÁLIDO
    
        echo '<script language="javascript">alert("Cpf Inválido!!"); location.href="index.php";</script>';
    
    }
}
?>