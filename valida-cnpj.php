<?php

// CNPJ testes que são passado para a função afim de validar o algoritmo
$cnpjValido = '32.987.287/0001-81';
$cnpjValido1 = '28.791.150/0001-80';
$cnpjValido2 = '54.499.264/0001-60';
$cnpjValido3 = '72.457.070/0001-84';
$cnpjValido3 = '72.457.070/0001-84';
$cnpjValido4 = '72457070000184';
$cnpjInvalido = '77.777.777/7777-77';
$cnpjTeste = '00.044.444/4444-44';

function validaCNPJ($cnpj = null) {

	// Verifica se um número foi informado
	if(empty($cnpj)) {
		return false;
	}

	// Elimina possivel mascara
	$cnpj = preg_replace("/[^0-9]/", "", $cnpj);

	$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
  
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cnpj) != 14) {
		return false;
	}
	
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cnpj == '00000000000000' || 
		$cnpj == '11111111111111' || 
		$cnpj == '22222222222222' || 
		$cnpj == '33333333333333' || 
		$cnpj == '44444444444444' || 
		$cnpj == '55555555555555' || 
		$cnpj == '66666666666666' || 
		$cnpj == '77777777777777' || 
		$cnpj == '88888888888888' || 
		$cnpj == '99999999999999') {
		return false;
		
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
	 
		$j = 5;
		$k = 6;
		$soma1 = "";
		$soma2 = "";

		for ($i = 0; $i < 13; $i++) {

			$j = $j == 1 ? 9 : $j;
			$k = $k == 1 ? 9 : $k;

			$soma2 += ($cnpj{$i} * $k);

			if ($i < 12) {
				$soma1 += ($cnpj{$i} * $j);
			}

			$k--;
			$j--;

		}

		$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
		$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

		return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
	 
	}
}

echo("Retorno ao passar um CNPJ <b>VÁLIDO</b> - ".validaCNPJ($cnpjValido));
echo "<br>";
echo("Retorno ao passar um CNPJ <b>VÁLIDO</b> - ".validaCNPJ($cnpjValido1));
echo "<br>";
echo("Retorno ao passar um CNPJ <b>VÁLIDO</b> - ".validaCNPJ($cnpjValido2));
echo "<br>";
echo("Retorno ao passar um CNPJ <b>VÁLIDO</b> - ".validaCNPJ($cnpjValido3));
echo "<br>";
echo("Retorno ao passar um CNPJ <b>VÁLIDO</b> - ".validaCNPJ($cnpjValido3));
echo "<br>";
echo("Retorno ao passar um CNPJ <b>INVÁLIDO</b> - ".validaCNPJ($cnpjInvalido));
echo "<br>";
echo("Retorno ao passar um CNPJ  - ".validaCNPJ($cnpjTeste));
