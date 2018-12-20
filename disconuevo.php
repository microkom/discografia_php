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

}


?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Discografia</title>
		<style>
			section{margin: auto;width: 600px;}
			
			label{padding: 8px;}
			.table{display: table;	border-collapse: collapse;}
			.table div{display: table-row;}
			.table>div>div{display: table-cell;border: 1px solid lightgray;padding: 7px;}

		</style>
	</head>
	<body>

<section>
		<form action="<?= $_SERVER["PHP_SELF"];?>" method="post" >
			<fieldset>
				<legend>Disco</legend>

				<label for="titulo">Título</label>
				<input type="text" name="titulo" value="<?php if(isset($tituloAlbum)) print $tituloAlbum;?>"><br><br>

				<label for="discografica">Discográfica</label>
				<input type="text" name="discografica"  value="<?php if(isset($discografica)) print $discografica;?>"><br><br>
				<label for="formato">Formato</label>
				
				<select name="formato" ><br><br>

					<?php
					//para mostrar los generos en como opciones
					$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
					$resultado = $dwes->query('SHOW COLUMNS from album like "formato";');

					while ($registro = $resultado->fetch()) {
						$genero = $registro['Type'];  ///generos traidos de la base de datos
						$otro = explode(',',$genero);
					}
					$dwes = null;  //terminar la conexión con la base de datos

					$otro = str_replace("enum(","",$otro);
					$otro = str_replace(")","",$otro);
					$otro = str_replace("'","",$otro);

					//mostrar las opciones de los generos como opción
					foreach($otro as $value){
						print '<option value="'.$value.'">'.$value.'</option>';
					}

					?>

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
		<a href="canciones.php">Búsqueda</a>
		</section>
	</body>
</html>