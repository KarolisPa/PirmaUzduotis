<?php
ini_set('display_errors', 1);
	if(isset($_POST['pridejimasBtn']) && !empty($_POST)) {
		$target_dir = "nuotraukos/";
		$target_file = $target_dir . basename($_FILES["fotoTxt"]["name"]);

		$foto = isset($_FILES["fotoTxt"]["tmp_name"]) ? $_FILES['fotoTxt']['name'] : "";

		$kontaktaiArr = array(
			'Vardas' => $_POST['vardastxt'],
			'Pavarde' => $_POST['pavardetxt'],
			'Telefono_nr' => $_POST['telefonastxt'],
			'Adresas' => $_POST['adresastxt'],
			'Foto' => $foto
		);

		if (move_uploaded_file($_FILES['fotoTxt']['tmp_name'], $target_file)) {
			$forma = json_decode(file_get_contents("kontaktai.json"), true);
			$forma[] = $kontaktaiArr;
			$duom_json = json_encode($forma, JSON_PRETTY_PRINT);
			file_put_contents("kontaktai.json", $duom_json);

//			suteikiamos Read&Write teises visiems vartotojams
			chmod($target_file, 777);
			header('location: index.php');
		} else {
			header('location: index.php');
		}
	}
?>
