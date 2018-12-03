<?php


$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//realizar conexión
	try {
		$dsn = "mysql:host=localhost;dbname=discografia";
		$dbh = new PDO($dsn, 'root');
	} catch (PDOException $e){
		echo $e->getMessage();
	}

	/*$ok = true;
	$dsn->beginTransaction();*/
	
	$stmt = $dbh->prepare("INSERT INTO album (titulo,discografica,formato,fechaLanzamiento,fechaCompra,precio) VALUES (?,?,?,?,?,?)");
	
	$tituloAlbum = $_POST['titulo'];
	$discografica = $_POST['discografica'];
	$formato = $_POST['formato'];
	$flanzamiento = $_POST['flanzamiento'];
	$fcompra = $_POST['fcompra'];
	$precio = $_POST['precio'];
	
	$stmt->bindValue(1, $tituloAlbum);
	$stmt->bindValue(2, $discografica);
	$stmt->bindValue(3, $formato);
	$stmt->bindValue(4, $flanzamiento);
	$stmt->bindValue(5, $fcompra);
	$stmt->bindValue(6, $precio);
	$stmt->execute();
	/*if($stmt->execute()==0)
		$ok = false;
	
	if($ok)
		print "Ok";
	else
		print "Error en la transacción";
	*/
	/*echo $dbh->lastInsertId();*/
}


?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Discografia</title>
		<style>
			label{padding: 8px;}
			.table{display: table;	border-collapse: collapse;}
			.table div{display: table-row;}
			.table>div>div{display: table-cell;border: 1px solid lightgray;padding: 7px;}

		</style>
	</head>
	<body>

		<form action="<?= $_SERVER["PHP_SELF"];?>" method="post" >
			<fieldset>
				<legend>Disco</legend>

				<label for="titulo">Título</label>
				<input type="text" name="titulo" value="<?php if(isset($tituloAlbum)) print $tituloAlbum;?>"><br><br>

				<label for="discografica">Discográfica</label>
				<input type="text" name="discografica"  value="<?php if(isset($discografica)) print $discografica;?>"><br><br>
				<label for="formato">Formato</label>
				<select name="formato" >
					<option  value="<?php if(isset($formato)) print $formato;?>"><?php if(isset($formato)) print $formato;?></option>
					<option value="vinilo">Vinilo</option>
					<option value="cd">CD</option>
					<option value="dvd">DVD</option>
					<option value="Mp3">Mp3</option>
				</select>
				<br><br>
				<label for="flanzamiento">Fecha Lanzamiento</label>
				<input type="date" name="flanzamiento"  value="<?php if(isset($flanzamiento)) print $flanzamiento;?>"><br><br>

				<label for="fcompra">Fecha Compra</label>
				<input type="date" name="fcompra"  value="<?php if(isset($fcompra)) print $fcompra;?>"><br><br>

				<label for="precio">Precio</label>
				<input type="number" name="precio"  value="<?php if(isset($precio)) print $precio;?>"><br><br>




				<br><br>
				<input type="submit" value="Guardar">
			</fieldset>
		</form>

		<a href="index.php">HOME</a>
		<a href="cancionnueva.php">Cancion nueva</a>
	</body>
</html>