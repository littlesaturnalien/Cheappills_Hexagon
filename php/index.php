<?php
include("connect.php");
$connection = Conectar();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Cheappills</title>
    <link rel="stylesheet" href="../styles/body_lista.css">
    <script defer src="../js/jquery.js"></script>
    <script defer src="../js/IDs.js"></script>
    <script defer src = "../js/lista.js"></script>
</head>

<body>

    <div>
        <div>
            <div class="box-search-bar">
                <form action="busqueda.php" method="post" class="search-container">
                    <input type="search" class="search-button" name="txte" placeholder="Buscar" id="search-button">
                    <input type="submit" value="Buscar">
                </form>
                <img src="../images/gotolist.jpeg" class="gotolist">

            </div>
        </div>
        <div>
            <div class="header_information">
                <h4 class="indication">Indicaciones</h4>
                <h4>Precio</h4>
                <h4>Laboratorio</h4>
                <h4 class="distributor">Distribuidor</h4>
            </div>
    </div>
            <?php
            $filter = "Antiinflamatorio";
            $sql = "SELECT m.ID_Med AS ID_Med, m.Nombre AS Nombre, m.Precio AS Precio, m.Indicaciones AS Indicaciones, 
            l.Nombre AS Laboratorio, d.Nombre AS Distribuidor
            FROM medicamentos m
            LEFT JOIN laboratorios l ON m.ID_Laboratorio = l.ID_Laboratorio
            LEFT JOIN distribuidoras d ON m.ID_Distribuidor = d.ID_Distribuidor
            ORDER BY m.Nombre ASC";
            $result = mysqli_query($connection, $sql);


            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                <div class="all-medicine-container">
                    <div class="all-image-name-container">
                        <div class="image-container">
                            <img src="../images/Medicine/sertralina.jpg" class="real-image" alt="<?php echo $mostrar['Nombre'] ?>" id=<?php echo $mostrar['ID_Med'] ?>>
                            <img src="../images/add_list.png" class="add-list" title = "Añadir a la lista">
                        </div>
                        <h4 class="name-container"><?php echo $mostrar['Nombre'] ?></h4>
                    </div>
                    <div class="information-container">
                        <p class="inf" id="inf-ind"><?php echo $mostrar['Indicaciones'] ?></p>
                        <p zclass="inf" id="inf-pri"><?php echo "C$" . $mostrar['Precio'] ?></p>
                        <p class="inf" id="inf-lab"><?php echo $mostrar['Laboratorio'] ?></p>
                        <p class="inf" id="inf-dis"> <?php echo $mostrar['Distribuidor'] ?></p>
                    </div>
                </div>
        </div>
    <?php
            }
    ?>
    </div>
</body>

</html>