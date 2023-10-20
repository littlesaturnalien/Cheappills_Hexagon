<?php
$data = json_decode($_POST['data']);
$numeros = $data->ID_Med;
include("connect.php");
$connection = Conectar();
$sql = "SELECT * from medicamentos WHERE ID_Med IN (" . implode(',', $numeros) . ")";
$result = mysqli_query($connection, $sql);
?>

<body>
<link rel="stylesheet" href="../styles/body_lista.css">
    <div>
        <img src = "../images/gototable.jpg" class = "gototable" style="cursor: pointer;" >
    </div>
    <?php
    while ($mostrar = mysqli_fetch_array($result)) {
    ?>
        <div class="all-medicine-container">
            <div class="all-image-name-container">
                <div class="image-container">
                    <img src="../images/Medicine/sertralina.jpg" class="real-image" alt="<?php echo $mostrar['Nombre'] ?>" id=<?php echo $mostrar['ID_Med'] ?>>
                    <img src="../images/delete_list.jpeg" class="delete-list" title="Eliminar de la lista">
                </div>
                <h4 class="name-container"><?php echo $mostrar['Nombre'] ?></h4>
            </div>
            <div class="information-container">
                <p class="inf" id="inf-ind"><?php echo $mostrar['Indicaciones'] ?></p> 
                <p class="inf" id="inf-pri"><?php echo "C$" . $mostrar['Precio'] ?></p>
                <p class="inf" id="inf-lab"><?php echo $mostrar['Laboratorio'] ?></p>
                <p class="inf" id="inf-dis"> <?php echo $mostrar['Distribuidor'] ?></p>
            </div>
        </div>
    <?php
    }
    ?>
</body>

<div class = "response-container">
    </div>