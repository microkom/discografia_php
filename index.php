<?php


$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );

//$dwes->close();


/*
Para las consultas INSERT, DELETE y UPDATE se usa el método exec que
devuelve el número de filas afectadas.


$registros = $dwes->exec('DELETE FROM stock WHERE unidades=0;');
echo 'Se han borrado .' $registros .' registros';
*/
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

		

		<?php		




		$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
		//$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
		$resultado = $dwes->query('SELECT * FROM album;');

		print "<div class=\"table\"> 
		<div>
		<div>Titulo Album</div> 
		<div>Discografica</div>
		<div>Formato</div>
		<div>Fecha lanzamiento</div>
		<div>Fecha compra</div>
		<div>Precio</div></div>";

		while ($registro = $resultado->fetch()) {
			$tituloAlbum = $registro['titulo'];
			$discografica = $registro['discografica'];
			$formato = $registro['formato'];
			$flanzamiento = $registro['fechaLanzamiento'];
			$fcompra = $registro['fechaCompra'];
			$precio = $registro['precio'];

			print "<div>
			<div>$tituloAlbum</div> <div>$discografica</div><div>$formato</div><div>$flanzamiento</div><div>$fcompra</div><div>$precio</div></div>";
		}

		print "</div>";

		//$dwes->close();

		?>
		
		
		<a href="disconuevo.php">Disco nuevo</a>
		<a href="cancionnueva.php">Canción nueva</a>
	</body>
</html>