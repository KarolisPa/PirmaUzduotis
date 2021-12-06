<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pirma užduotis</title>
    <style>
.sarasas{
    border: 1px solid black;
}
td{
    text-align: center;
}
.foto{
    height: 60px;
    width: 60px;
}
.wrapas {
    display: flex;
}

.stulpelis {
    flex: 50%;
}
    </style>
</head>
<body>

<div class="wrapas">
    <div class="stulpelis">

<table class="sarasas">
    <tr>
        <td><a href="index.php">Pridėti</a></td>
    </tr>
    <tr>
        <td>Foto</td>
        <td>Vardas</td>
        <td>Pavardė</td>
        <td>Telefono nr.</td>
        <td>Adresas</td>
        </tr>

    <?php
    $data = file_get_contents('kontaktai.json');
 $data = json_decode($data);
 $index = 0;
 if(!empty($data)){
 foreach($data as $row){
        ?>
    <tr>
        <td><img class="foto" src="nuotraukos/<?php echo $row->Foto; ?>"></td>
        <td><?php echo $row->Vardas; ?></td>
        <td><?php echo $row->Pavarde; ?></td>
        <td><?php echo $row->Telefono_nr;  ?></td>
        <td><?php echo $row->Adresas; ?></td>
        <td><a href="edit.php?id=<?php echo $index; ?>">Redaguoti</a>&nbsp; &nbsp;<a href="delete.php?id=<?php echo $index; ?>">Ištrinti</a> </td>
    </tr>
    <?php
 $index++;
 }
    }
    ?>
</table>
    </div>

    <div class="stulpelis">
<h1 style="text-align: center">Pridėti kontaktą</h1>

<form method="post" name="pridetiForm" action="prideti.php" enctype="multipart/form-data">
    <table align="center">

        <tr>
            <td style="text-align: center; white-space: nowrap;">Vardas</td>
            <td><input type="text" name="vardastxt"> </td>
        </tr>
        <tr>
            <td>Pavardė</td>
            <td><input type="text" name="pavardetxt"> </td>
        </tr>
        <tr>
            <td>Telefono nr.</td>
            <td><input type="number" name="telefonastxt"> </td>
        </tr>
        <tr>
            <td>Adresas</td>
            <td><input type="text" name="adresastxt"> </td>
        </tr>
        <tr>
            <td>Foto</td>
            <td><input type="file" name="fotoTxt"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Pridėti" name="pridejimasBtn"> </td>
        </tr>
    </table>
</form>
    </div>
</div>
</body>
</html>