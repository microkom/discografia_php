<?php

/*

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

*/

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Discografia</title>
		<style>
			section{
				margin: auto;
				width: 600px; 
				border: 1px solid lightgrey; 
				padding: 2em;
			}

			label{
				padding: 8px;
			}
			.table{
				display: table;	
				border-collapse: collapse;
			}
			.table div{
				display: table-row;
			}
			.table>div>div{
				display: table-cell;
				border: 1px solid lightgray;
				padding: 3px;
			}

		</style>
	</head>
	<body>
		<section>
			<?php		

			$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
			$resultado = $dwes->query('SELECT * FROM album;');

	
			print "<div class=\"table\"> 
		<div>
		<div>Titulo Album</div> 
		<div>Discografica</div>
		<div>Formato</div>
		<div>Fecha lanzamiento</div>
		<div>Fecha compra</div>
		<div>Precio</div></div>";

			while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
				$tituloAlbum = $registro['titulo'];
				$discografica = $registro['discografica'];
				$formato = $registro['formato'];
				$flanzamiento = $registro['fechaLanzamiento'];
				$fcompra = $registro['fechaCompra'];
				$precio = $registro['precio'];

				print "<div>
			<div><a href=\"disco.php?id=".$registro['codigo']."\">$tituloAlbum</a></div> 
			<div>$discografica</div>
			<div>$formato</div>
			<div>$flanzamiento</div>
			<div>$fcompra</div>
			<div>$precio</div>
			</div>";
			}

			print "</div>";
			$dwes =null;

			?>


			<a href="disconuevo.php">Disco nuevo</a>
			<a href="cancionnueva.php">Canción nueva</a>
			<a href="canciones.php">Búsqueda</a>
		</section>
	</body>
</html>