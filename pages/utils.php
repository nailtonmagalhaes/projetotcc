<?php

	function mask($val, $mask){
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++){
			if($mask[$i] == '#'){
				if(isset($val[$k]))
				$maskared .= $val[$k++];
			}else{
				if(isset($mask[$i]))
				$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}

class Mascaras{
	public static function geraMascara($texto, $mascara){
		if(empty($texto)) return "";
		$texto = self::removeMascara($texto);
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mascara)-1; $i++){
			if($mascara[$i] == '#'){
			if(isset($texto[$k]))
			$maskared .= $texto[$k++];
			}else{
			if(isset($mascara[$i]))
			$maskared .= $mascara[$i];
			}
		}
		return $maskared;
	}

	public static function geraMascaraTelefone($numero)
	{
		$numero = self::getNumeros($numero);

		switch (strlen($numero)) {
			case '8':
				return self::geraMascara($numero, "####-####");
			case '9':
				return self::geraMascara($numero, "#####-####");
			case '10':
				return self::geraMascara($numero, "(##) ####-####");
			case '11':
				return self::geraMascara($numero, "(##) #####-####");			
			default:
				return $numero;
		}
	}

	public static function removeMascara($texto){
		$texto = trim($texto);
		$texto = str_replace(".", "", $texto);
		$texto = str_replace(",", "", $texto);
		$texto = str_replace("-", "", $texto);
		$texto = str_replace("_", "", $texto);
		$texto = str_replace(" ", "", $texto);
		$texto = str_replace("/", "", $texto);
		$texto = str_replace("(", "", $texto);
		$texto = str_replace(")", "", $texto);
		$texto = str_replace("\\", "", $texto);
		return $texto;
	}

	function getNumeros($texto){
		//$texto = preg_replace('/[0-9]/', '', $texto);
		//return $texto;

		//preg_match_all('/\d+/', $texto, $matches);
    	//echo $matches[0];die;

    	$texto = preg_replace('/\D/', '', $texto);
		return $texto;
	}
}

	class Validacoes{
		
		

		function validaCPF($cpf = null) {
		
			// Verifica se um número foi informado
			if(empty($cpf)) {
				return false;
			}
		
			// Elimina possivel mascara
			$cpf = ereg_replace('[^0-9]', '', $cpf);
			$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
			
			// Verifica se o numero de digitos informados é igual a 11 
			if (strlen($cpf) != 11) {
				return false;
			}
			// Verifica se nenhuma das sequências invalidas abaixo 
			// foi digitada. Caso afirmativo, retorna falso
			else if ($cpf == '00000000000' || 
				$cpf == '11111111111' || 
				$cpf == '22222222222' || 
				$cpf == '33333333333' || 
				$cpf == '44444444444' || 
				$cpf == '55555555555' || 
				$cpf == '66666666666' || 
				$cpf == '77777777777' || 
				$cpf == '88888888888' || 
				$cpf == '99999999999') {
				return false;
			// Calcula os digitos verificadores para verificar se o
			// CPF é válido
			} else {   
				
				for ($t = 9; $t < 11; $t++) {
					
					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf{$c} * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf{$c} != $d) {
						return false;
					}
				}
		
				return true;
			}
		}

		function validaEmail($email){
			$er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
			if (preg_match($er, $email)){
				return true;
			} else {
				return false;
			}
		}
	}
	//echo mask($cpf,'###.###.###-##');	
?>
<script>
function addRowToTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  
  // left cell
  var cellLeft = row.insertCell(0);
  var textNode = document.createTextNode(iteration);
  cellLeft.appendChild(textNode);
  
  // right cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.size = 40;
  
  el.onkeypress = keyPressTest;
  cellRight.appendChild(el);
  
  // select cell
  var cellRightSel = row.insertCell(2);
  var sel = document.createElement('select');
  sel.name = 'selRow' + iteration;
  sel.options[0] = new Option('text zero', 'value0');
  sel.options[1] = new Option('text one', 'value1');
  cellRightSel.appendChild(sel);
}
function keyPressTest(e, obj)
{
  var validateChkb = document.getElementById('chkValidateOnKeyPress');
  if (validateChkb.checked) {
    var displayObj = document.getElementById('spanOutput');
    var key;
    if(window.event) {
      key = window.event.keyCode; 
    }
    else if(e.which) {
      key = e.which;
    }
    var objId;
    if (obj != null) {
      objId = obj.id;
    } else {
      objId = this.id;
    }
    displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
  }
}
function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}
function openInNewWindow(frm)
{
  // open a blank window
  var aWindow = window.open('', 'TableAddRowNewWindow',
   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
   
  // set the target to the blank window
  frm.target = 'TableAddRowNewWindow';
  
  // submit
  frm.submit();
}
function validateRow(frm)
{
  var chkb = document.getElementById('chkValidate');
  if (chkb.checked) {
    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i=1; i<=lastRow; i++) {
      var aRow = document.getElementById('txtRow' + i);
      if (aRow.value.length <= 0) {
        alert('Row ' + i + ' is empty');
        return;
      }
    }
  }
  openInNewWindow(frm);
}
</script>