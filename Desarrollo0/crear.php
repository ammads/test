<?php
if($_POST){
 
    // include conexion base de datos
    include './conn.php';
 
    try{
     
        // definimos la query
        $query = "INSERT INTO peliculas SET title=:title, genre=:genre, year=:year";
 
        // preparamos query
        $stmt = $con->prepare($query);
 
        // recogemos valores del POST
        $title=htmlspecialchars(strip_tags($_POST['title']));
        $genre=htmlspecialchars(strip_tags($_POST['genre']));
        $year=htmlspecialchars(strip_tags($_POST['year']));
 
        // bind de los parametros
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':year', $year);
         
        // Ejecutamos la query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Película guardada.</div>";
        }else{
            echo "<div class='alert alert-danger'>Ha habido un problema.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Nueva Pelicula</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <div class="container">
   
        <div class="page-header">
            <h1>Nueva Película</h1>
        </div>
      
        <form action="./crear.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Título</td>
            <td><input type='text' name='title' class='form-control' /></td>
        </tr>
        <tr>
            <td>Género</td>
            <td><textarea name='genre' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>Año</td>
            <td><input type='text' name='year' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Guardar' class='btn btn-primary' />
                <a href='listado.php' class='btn btn-danger'>Volver</a>
            </td>
        </tr>
    </table>
</form>
          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>