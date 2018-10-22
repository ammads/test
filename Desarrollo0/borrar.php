<?php
// include database connection
include './conn.php';
 
try {
     
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID no encontrado.');
 
    // query para borrar un registro
    $query = "DELETE FROM peliculas WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
    // redirige al listado
        header('Location: listado.php?action=deleted');
    }else{
        die('No he podido borrarlo.');
    }
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>