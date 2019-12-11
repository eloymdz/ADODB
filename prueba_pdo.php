<?php
$host='10.10.0.17:5000';
$dbname='bdtec';
$user='consulta';
$pass='Ittux19#';
try {
  $pdo = new PDO("dblib:host=$host;dbname=$dbname", $user, $pass);
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
}
try {
    # Para ejecutar la consulta SELECT si no tenemos parámetros en la consulta podremos usar ->query() 
	$stmt = $pdo->query('SELECT * from carreras order by carrera');
	# Indicamos en qué formato queremos obtener los datos de la tabla en formato de array asociativo.
	# Si no indicamos nada por defecto se usará FETCH_BOTH lo que nos permitirá acceder como un array asociativo o array numérico.
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	# Leemos los datos del recordset con el método ->fetch() 
	while ($row = $stmt->fetch()) {
		echo $row['carrera'] . ",";
		echo $row['reticula'] . ",";
		echo $row['clave_oficial'] . "<br/>";
	}
	# Para liberar los recursos utilizados en la consulta SELECT
	$stmt = null;
} catch (PDOException $err) {
    // Mostramos un mensaje genérico de error.
	echo "Error: ejecutando consulta SQL.";
}
?>
