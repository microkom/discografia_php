<?php
session_start();
/*
se debe añadir una página llamada canciones.php con un formulario que permita buscar canciones. 
Debe ser el propio archivo canciones.php el que reciba la información del formulario y muestre las canciones encontradas. Se debe usar PDO.
*/
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Canciones</title>
		<style>
			section{margin: auto;width: 600px;}

			label{padding: 8px;}
			.table{display: table;	border-collapse: collapse;}
			.table div{display: table-row;}
			.table>div>div{display: table-cell;border: 1px solid lightgray;padding: 7px;}

		</style>
	</head>
	<body>

		<h1>Búsqueda de canciones</h1>
		<form action="<?= $_SERVER["PHP_SELF"];?>" method="post" >
			<fieldset>
				<legend>Buscar</legend>

				<label for="searchedText">Texto a buscar</label><input type="text" name="searchedText"><br>
				<spam>Buscar en: </spam>
				<input type="radio" name="searchType" value="songTitle" checked><label for="songTitle">Titulos de canción</label>
				<input type="radio" name="searchType" value="albumTitle"><label for="albumTitle">Nombre de album</label>
				<input type="radio" name="searchType" value="songAlbumTitle"><label for="songAlbumTitle">Ambos</label>
				<br>
				<label for="musicGenre">Género Musical</label>
				<select name="musicGenre" ><br><br>

					<?php
					//para mostrar los generos en como opciones
					$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );
					$resultado = $dwes->query('SHOW COLUMNS from cancion like "genero";');

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

				</select><br><br>
				<input type="submit" >

			</fieldset>
		</form>
		<br><br>

		<?php
		//$dwes = new PDO('mysql:host=localhost;dbname=discografia', 'root', '' );


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			//realizar conexión
			try {
				$dsn = "mysql:host=localhost;dbname=discografia";
				$dbh = new PDO($dsn, 'root');
			} catch (PDOException $e){
				echo $e->getMessage();
			}

			if(isset($_POST['searchedText'])){
				$searchedText  = $_POST['searchedText'];
				$cookieText = $searchedText;
				$searchedText  = "%".$searchedText."%";//permite una busqueda de la palabra
			}

			if(isset($_POST['searchType']))
				$songTitle = $_POST['searchType'];

			if(isset($_POST['searchType']))
				$albumTitle = $_POST['searchType'];

			if(isset($_POST['songAlbumTitle']))
				$songAlbumTitle = $_POST['songAlbumTitle'];

			if(isset($_POST['musicGenre']))
				$musicGenre = $_POST['musicGenre'];

			//búsqueda por título de canción
			if($songTitle === 'songTitle'){

				/*$stmt = $dbh->prepare("SELECT * from cancion where genero=? and titulo like ?  ");*/
				$stmt = $dbh->prepare("SELECT c.titulo, a.titulo as 'album', a.discografica, a.formato, c.genero FROM album a, cancion c WHERE a.codigo=c.album and c.genero=? and c.titulo like ? ");
				$stmt->bindParam(1, $musicGenre);
				$stmt->bindParam(2, $searchedText);
				$stmt->execute();

				print "<div class=\"table\"> 
					<div>
						<div>Titulo </div><div>Album</div><div>Discografica</div><div>Formato</div><div>Genero</div>
					</div>";

				while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
					print "<div>
						<div>".$r['titulo']."</div> 
						<div>".$r['album']."</div>
						<div>".$r['discografica']."</div>
						<div>".$r['formato']."</div>
						<div>".$r['genero']."</div>
						</div>";

				}
				print "</div>";
			}
			if($albumTitle === 'albumTitle'){

				$stmt = $dbh->prepare("SELECT c.titulo, a.titulo as 'album', a.discografica, a.formato, c.genero FROM album a, cancion c WHERE a.codigo=c.album and c.genero=? and a.titulo like ? ");
				$stmt->bindParam(1, $musicGenre);
				$stmt->bindParam(2, $searchedText);
				$stmt->execute();

				print "<div class=\"table\"> 
					<div>
						<div>Titulo </div><div>Album</div><div>Discografica</div><div>Formato</div><div>Genero</div>
					</div>";

				while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
					print "<div>
						<div>".$r['titulo']."</div> 
						<div>".$r['album']."</div>
						<div>".$r['discografica']."</div>
						<div>".$r['formato']."</div>
						<div>".$r['genero']."</div>
						</div>";

				}
				print "</div>";
			}
			if($albumTitle === 'songAlbumTitle'){

				$stmt = $dbh->prepare("SELECT c.titulo, a.titulo as 'album', a.discografica, a.formato, c.genero FROM album a, cancion c WHERE a.codigo=c.album and ((c.genero=? and a.titulo like ? ) OR (c.genero=? and c.titulo like ? ))");
				$stmt->bindParam(1, $musicGenre);
				$stmt->bindParam(2, $searchedText);
				$stmt->bindParam(3, $musicGenre);
				$stmt->bindParam(4, $searchedText);
				$stmt->execute();
				print "<div class=\"table\"> 
					<div>
						<div>Titulo </div><div>Album</div><div>Discografica</div><div>Formato</div><div>Genero</div>
					</div>";

				while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {

					print "<div>
						<div>".$r['titulo']."</div> 
						<div>".$r['album']."</div>
						<div>".$r['discografica']."</div>
						<div>".$r['formato']."</div>
						<div>".$r['genero']."</div>
						</div>";
				}
				print "</div>";
			}
		}

		$dsn = null;

		print "<br><br>";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			
			// imprimirlas
			if (isset($_COOKIE['cookie'])) {
				
				//tamaño del array de cookies
				$i = sizeof($_COOKIE['cookie']);
				
				//establecer cookie 
				setcookie("cookie[$i]", "$cookieText");
				
				//recorrer el array de cookies
				foreach ($_COOKIE['cookie'] as $nombre => $valor) {
					$name = htmlspecialchars($nombre);
					$value = htmlspecialchars($valor);
					echo $name.':'. $value .'<br>';
				}
			}else{
				//primera cookie.
				setcookie("cookie[0]", "$cookieText");
			}
		}
		?>

		<br>
		<a href="disconuevo.php">Disco nuevo</a>
		<a href="cancionnueva.php">Canción nueva</a>
		<a href="canciones.php">Búsqueda</a>

	</body>
</html>
