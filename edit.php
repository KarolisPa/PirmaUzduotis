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
<?php
$id = $_GET['id'];
$data = file_get_contents('kontaktai.json');
$data_array = json_decode($data, true);
$row = $data_array[$id];
?>
<?php
if(isset($_POST['editBtn'])){
//    istrina sena foto
    if($_FILES['fotoTxt']['tmp_name'] !== "") {
        unlink('nuotraukos/' . $row['Foto']);
    }
    $target_dir = "nuotraukos/";
    $target_file = $target_dir . basename($_FILES["fotoTxt"]["name"]);

   if($_FILES['fotoTxt']['tmp_name'] !== ""){
        $foto = $_FILES['fotoTxt']['name'];
    }else{
       $foto = $row['Foto'];
   }
   //    $foto = isset($_FILES["fotoTxt"]["tmp_name"]) ? $_FILES['fotoTxt']['name'] : $row['Foto'];

    $kontaktasArr = array(
        'Vardas' => $_POST['vardasTxt'],
        'Pavarde' => $_POST['pavardeTxt'],
        'Telefono_nr' => $_POST['telefonasTxt'],
        'Adresas' => $_POST['adresasTxt'],
        'Foto' => $foto
    );


if (move_uploaded_file($_FILES['fotoTxt']['tmp_name'], $target_file)) {
    $data_array[$id] = $kontaktasArr;
    $data = json_encode($data_array, JSON_PRETTY_PRINT);
    file_put_contents('kontaktai.json', $data);

//			suteikiamos Read&Write teises visiems vartotojams
    chmod($target_file, 777);
    header('location: index.php');
}else{
    $data_array[$id] = $kontaktasArr;
    $data = json_encode($data_array, JSON_PRETTY_PRINT);
    file_put_contents('kontaktai.json', $data);
    header('location: index.php');
}
}
?>
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
                foreach($data as $kontaktas){
                    ?>
                    <tr>
                        <td><img class="foto" src="nuotraukos/<?php echo $kontaktas->Foto; ?>"></td>
                        <td><?php echo $kontaktas->Vardas; ?></td>
                        <td><?php echo $kontaktas->Pavarde; ?></td>
                        <td><?php echo $kontaktas->Telefono_nr;  ?></td>
                        <td><?php echo $kontaktas->Adresas; ?></td>
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
<form method="post" name="editFrm" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <td colspan="2" align="center"><h1>Redaguoti</h1></td>
        </tr>

        <tr>
            <td>Vardas</td>
            <td><input type="text" name="vardasTxt" value="<?php echo $row['Vardas'] ;?>"> </td>
        </tr>
        <tr>
            <td>Pavardė</td>
            <td><input type="text" name="pavardeTxt" value="<?php echo $row['Pavarde'];?>"> </td>
        </tr>
        <tr>
            <td>Telefono nr.</td>
            <td><input type="number" name="telefonasTxt" value="<?php echo $row['Telefono_nr'];?>"> </td>
        </tr>
        <tr>
            <td>Adresas</td>
            <td><input type="text" name="adresasTxt" value="<?php echo $row['Adresas'];?>"> </td>
        </tr>
        <tr>
            <td>Foto</td>
            <td><input type="file" name="fotoTxt"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Update" name="editBtn"> </td>
        </tr>
    </table>
</form>
</div>
</div>
</body>
</html>
