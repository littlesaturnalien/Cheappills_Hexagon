<?php
include("connect.php");
$connection = Conectar();

if (isset($_POST['txte'])) {
    $search_query = $_POST['txte'];
    
    $sql = "SELECT m.ID_Med AS ID_Med, m.Nombre AS Nombre, m.Precio AS Precio, m.Indicaciones AS Indicaciones, 
    l.Nombre AS Laboratorio, d.Nombre AS Distribuidor
    FROM medicamentos m
    LEFT JOIN laboratorios l ON m.ID_Laboratorio = l.ID_Laboratorio
    LEFT JOIN distribuidoras d ON m.ID_Distribuidor = d.ID_Distribuidor
    WHERE m.Nombre LIKE '%$search_query%'
    ORDER BY m.Nombre ASC";
    $result = mysqli_query($connection, $sql);

    while ($mostrar = $result->fetch_assoc()) {
        echo '<div class="all-medicine-container">';
        echo '<div class="all-image-name-container">';
        echo '<div class="image-container">';
        echo '<img src="../images/Medicine/' . $mostrar['Imagen'] . '" class="real-image" alt="' . $mostrar['Nombre'] . '" id="' . $mostrar['ID_Med'] . '">';
        echo '<img src="../images/delete_list.jpeg" class="delete-list" title="Eliminar de la lista">';
        echo '</div>';
        echo '<h4 class="name-container">' . $mostrar['Nombre'] . '</h4>';
        echo '</div>';
        echo '<div class="information-container">';
        echo '<p class="inf" id="inf-ind">' . $mostrar['Indicaciones'] . '</p>';
        echo '<p class="inf" id="inf-pri">' . 'C$' . $mostrar['Precio'] . '</p>';
        echo '<p class="inf" id="inf-lab">' . $mostrar['Laboratorio'] . '</p>';
        echo '<p class="inf" id="inf-dis">' . $mostrar['Distribuidor'] . '</p>';
        echo '</div>';
        echo '</div>';
    }

    $connection->close();
} 

?>