<?php 
	include_once "menu.php";
    include_once 'includes.php';

    $p = new Pessoa();
    print_r($p);
    $p->listar();
    ?>

    <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-3"> </div>
<form action="tableaddrow_nw.html" method="get">
<p>
<input type="button" value="Add" onclick="addRowToTable();" />
<input type="button" value="Remove" onclick="removeRowFromTable();" />
<input type="button" value="Submit" onclick="validateRow(this.form);" />
<input type="checkbox" id="chkValidate" /> Validate Submit
</p>
<p>
<input type="checkbox" id="chkValidateOnKeyPress" checked="checked" /> Display OnKeyPress
<span id="spanOutput" style="border: 1px solid #000; padding: 3px;"> </span>
</p>
<table border="1" id="tblSample">
  <tr>
    <th colspan="3">Sample table</th>
  </tr>
  <tr>
    <td>1</td>
    <td><input type="text" name="txtRow1"
     id="txtRow1" size="40" onkeypress="keyPressTest(event, this);" /></td>
    <td>
    <select name="selRow0">
    <option value="value0">text zero</option>
    <option value="value1">text one</option>
    </select>
    </td>
  </tr>
</table>
</form>
