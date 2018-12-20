<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Borrar Disco</title>
		<style>
			section{margin: auto;width: 600px;}
			body{
				background-color: beige;
				color:navy;
				font-family: sans-serif;
				text-align: center;
			}
			label{padding: 8px;}
			.table{display: table;	border-collapse: collapse;}
			.table div{display: table-row;}
			.table>div>div{display: table-cell;border: 1px solid lightgray;padding: 7px;}
			.row{background-color: black; color: white; font-weight: 500;}
			div{
				margin: auto;
				text-align: left;
				border: 1px solid white;
				padding: 1em;

			}
			p{text-align: center;}

		</style>
	</head>
	<body>
		<?php
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
			$resultado = $dwes->query('SELECT c.titulo, a.titulo as "album", a.discografica, a.formato, c.genero, a.fechaCompra, a.fechaLanzamiento FROM album a, cancion c WHERE a.codigo=c.album and a.codigo='.$id.';');


			print "<div class=\"table\"> 
				<div class='row'>
				<div>Titulo Canción</div> 
				<div>Titulo Album</div> 
				<div>Discográfica</div> 
				<div>Formato</div>
				<div>Genero</div>
				<div>Fecha Compra</div>
				<div>Fecha Lanzamiento</div>
				</div>";


			while ($r  = $resultado->fetch()) {
				print "<div>
				<div>".$r['titulo']."</div> 
				<div>".$r['album']."</div> 
				<div>".$r['discografica']."</div> 
				<div>".$r['formato']."</div>
				<div>".$r['genero']."</div>
				<div>".$r['fechaCompra']."</div>
				<div>".$r['fechaLanzamiento']."</div></div>";

			}

			print "</div>";

			$dwes =null;

		}


	print '<br><a href="borrarDisco.php?borrar='.$id.'">Borrar Album</a><br><br>';


		?>	
		<a href="index.php">HOME</a>
		<a href="cancionnueva.php">Cancion nueva</a>
		<a href="canciones.php">Búsqueda</a>
	</body>
</html>