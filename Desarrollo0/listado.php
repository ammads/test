<?php

include './conn.php';
 
// Mensaje para confirmar borrado de una peli
 
// Query para seleccionar todas las peliculas
$query = "SELECT id, title, genre, year FROM peliculas ORDER BY id ASC";
$stmt = $con->prepare($query);
$stmt->execute();
 
// contamos las filas
$num = $stmt->rowCount();

echo "<div class='container'>";
echo "<div class='page-header'>";
echo "<h1>Listado de peliculas</h1>";
echo "</div>";

// enlazamos a la página para crear pelicula
echo "<a href='crear.php' class='btn btn-primary m-b-1em'>Alta de película</a>";
 
//Si tenemos más de una fila
if($num>0){
    //pintamos la tabla en html
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
    // creamos la cabecera
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Titulo</th>";
        echo "<th>Genero</th>";
        echo "<th>Año</th>";
        echo "<th></th>";
    echo "</tr>";
     
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        // una fila por cada registro
        echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td>{$row['year']}</td>";

            echo "<td>";
                
                                
                // Enlaces para actualizar cada registro
                echo "<a href='update.php?id={$row['id']}' class='btn btn-primary m-r-1em'>Editar</a>";
    
                // Enlace para borrar un registro
                echo "<a href='#' class='btn btn-danger'>Borrar</a>";
            echo "</td>";
        echo "</tr>";
    }
 
    // end table
    echo "</table>";
     
}
 
// si está vacio
else{
    echo "<div class='alert alert-danger'>No hay peliculas.</div>";
}
echo "</div>";

?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
    <meta charset="utf-8">
    <title>Listado de peliculas</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>     
</head>
<body>
 
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
 
</body>
</html>