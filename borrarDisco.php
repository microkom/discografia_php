<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Borrar Disco</title>
		<style>
			section{margin: auto;width: 600px;text-align: center;}
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
		if(isset($_GET['id']))
			$id = $_GET['id'];

		if(isset($_GET['borrar'])) {
			$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );

			$ok = false;
			$dwes->beginTransaction();
			$ok = $dwes->exec('DELETE FROM album where codigo='.$_GET['borrar']);
			
			
			if ($ok){
				$dwes->commit();
				print "Disco borrado.<br><br>";
				header('Location: index.php');
			}else{
				print "Disco borrado.<br><br>";
				$dwes->rollback();
				header('Location:'.$_SERVER['HTTP_REFERER']);
			}
			$dwes =null;
		}


		?>	

		<a href="index.php">HOME</a>
		
	</body>
</html>