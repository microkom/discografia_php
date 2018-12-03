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


	$titulo  = $_POST['titulo'];
	$album = $_POST['album'];
	$posicion = $_POST['posicion'];
	$duracion = $_POST['duracion'];
	$genero = $_POST['genero'];

	$stmt = $dbh->prepare("INSERT INTO cancion (titulo,album,posicion,duracion,genero) VALUES (?,?,?,?,?)");

	$stmt->bindValue(1, $titulo);
	$stmt->bindValue(2, $album);
	$stmt->bindValue(3, $posicion);
	$stmt->bindValue(4, $duracion);
	$stmt->bindValue(5, $genero);

	$stmt->execute();

	$dsn = null;
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
		<meta charset="utf-8">
		<title>Canciones</title>
		<style>
			label{padding: 8px;}
			.table{display: table;	border-collapse: collapse;}
			.table div{display: table-row;}
			.table>div>div{display: table-cell;border: 1px solid lightgray;padding: 7px;}

		</style>
	</head>
	<body>

<?php		

				//PARA MOSTRAR EL ALBUM DESDE LA BASE DE DATOS

				$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
				//$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
				$resultado = $dwes->query('SELECT * FROM cancion;');

				while ($registro = $resultado->fetch()) {
					$resultado2 = $dwes->query('SELECT distinct titulo FROM album');
					$registro2 = $resultado2->fetch();
					$album = $registro2['titulo'];
					print '<ption value="'.$album.'">'.$album.'</option>';
					var_dump($album);
				}

				

				$dwes = null;

				?>
		<form action="<?= $_SERVER["PHP_SELF"];?>" method="post" >


			<h3>Canción</h3>
			<label for="titulo">Título</label>		<input type="text" name="titulo"><br><br>
			<label for="album">Album</label>


			<select name="album">
				
			</select>

			<br><br>
			<label for="posicion">Posición</label>	<input type="number" name="posicion"><br><br>
			<label for="duracion">Duración</label>	<input type="time" name="duracion"><br><br>

			<label for="genero">Género</label>


			<select name="genero" ><br><br>

				<?php
				//para mostrar los generos en como opciones
				$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
				$resultado = $dwes->query('SHOW COLUMNS from cancion like "genero";');

				while ($registro = $resultado->fetch()) {
					$genero = $registro['Type'];  ///generos traidos de la base de datos
					$otro = explode(',',$genero);
				}
				$dwes = null;

				$otro = str_replace("enum(","",$otro);
				$otro = str_replace(")","",$otro);
				$otro = str_replace("'","",$otro);


				foreach($otro as $value){
					print '<option value="'.$value.'">'.$value.'</option>';
				}

				?>

			</select>
			<br><br>
			<input type="submit" value="Guardar">
		</form>


		<?php		




		$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
		//$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
		$resultado = $dwes->query('SELECT * FROM cancion;');

		print "<div class=\"table\"> 
		<div>
		<div>Titulo </div> 
		<div>album</div>
		<div>posicion</div>
		<div>duracion</div>
		<div>genero</div></div>";

		while ($registro = $resultado->fetch()) {


			$resultado2 = $dwes->query('SELECT titulo FROM album where codigo='.$registro['album']);
			$registro2 = $resultado2->fetch();
			$album = $registro2['titulo'];

			$titulo = $registro['titulo'];
			/*$album = $registro['album'];*/
			$posicion = $registro['posicion'];
			$duracion = $registro['duracion'];
			$genero = $registro['genero'];


			print "<div>
			<div>$titulo</div> <div>$album</div><div>$posicion</div><div>$duracion</div><div>$genero</div></div>";
		}

		print "</div>";

		$dwes = null;

		?>
		<a href="disconuevo.php">Discografia</a>
		<a href="index.php">HOME</a>
	</body>
</html>