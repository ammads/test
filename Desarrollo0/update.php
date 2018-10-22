<?php
//conexion a base de datos
include './conn.php'; 
// isset() es una función para verificar si existe un valor
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no encontrado.');
// comprobamos que hay POST del formulario
if($_POST){
     
    try{
     
        // query para update
        $query = "UPDATE peliculas 
                    SET title=:title, genre=:genre, year=:year 
                    WHERE id=:id";
 
        // preramos la query
        $stmt = $con->prepare($query);
 
        // recogemos valores
        $title=htmlspecialchars(strip_tags($_POST['title']));
        $genre=htmlspecialchars(strip_tags($_POST['genre']));
        $year=htmlspecialchars(strip_tags($_POST['year']));
        // bind de los parametros
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':id', $id);
         
        // Ejecutamos la query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Película actualizada.</div>";
        }else{
            echo "<div class='alert alert-danger'>Ha habido un error y no se ha actualizado.</div>";
        }
         
    }
     
    // mostramos errores
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Actualizar</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Actualizar pelicula</h1>
        </div>
     
        <?php


        
        // recogemos los datos de la pelicula
        try {
            // hacemos la consulta select
            $query = "SELECT id, title, genre, year FROM peliculas WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // Sustituimos por la primera interrogación
            $stmt->bindParam(1, $id);
            
            // ejecutamos la query
            $stmt->execute();
            
            // Almacenamos los resultados de la query en una variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Asignamos variables por cada campo
            $title = $row['title'];
            $genre = $row['genre'];
            $year = $row['year'];
        }
        
        // Mostramos errores
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
 
        <form action="update.php?id=<?php echo $row['id']; ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Titulo</td>
                    <td><input type='text' name='title' value="<?php echo htmlspecialchars($title, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Género</td>
                    <td><textarea name='genre' class='form-control'><?php echo htmlspecialchars($genre, ENT_QUOTES);  ?></textarea></td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td><input type='text' name='year' value="<?php echo htmlspecialchars($year, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Guardar cambios' class='btn btn-primary' />
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