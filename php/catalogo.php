<?php
include('connect.php');
$connection = Conectar();

?>


<!DOCTYPE html>
<html>
<?php include('../struct/head.html') ?>

<body>
    <?php include('../struct/header.html') ?>
    <div class="box-search-bar">
        <form action="busqueda.php" method="post" class="search-container">
            <input type="search" class="search-button" name="txte" placeholder="Buscar" id="search-button">
            <input type="submit" value="Buscar">
        </form>
        <img src="../images/gotolist.jpeg" class="gotolist">
    </div>
    <div class="all-line-container">
        <?php include('../struct/slidebar.html') ?>
        <div>
            <div class="header_information">
                <h4 class="indication">Indicaciones</h4>
                <h4>Precio</h4>
                <h4>Laboratorio</h4>
                <h4 class="distributor">Distribuidor</h4>
            </div>
        </div>
        <?php
        $filter = json_decode($_POST['data_category']);
        $sql = "SELECT m.*, d.Nombre AS nombre_distribuidor, l.Nombre AS nombre_laboratorio
        FROM medicamentos m
        LEFT JOIN distribuidoras d ON m.ID_Distribuidor = d.ID_Distribuidor
        LEFT JOIN laboratorios l ON m.ID_Laboratorio = l.ID_Laboratorio
        WHERE m.Categoría_Terapéutica = '$filter'";

        $result = mysqli_query($connection, $sql);
        ?>
        <div class="father">
            <?php
            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                <div class="all-medicine-container">
                    <div class="all-image-name-container">
                        <div class="image-container">
                            <img src="../images/Medicine/sertralina.jpg" class="real-image" alt="<?php echo $mostrar['Nombre'] ?>" id=<?php echo $mostrar['ID_Med'] ?>>
                            <img src="../images/add_list.png" class="add-list" title="Añadir a la lista">
                        </div>
                        <h4 class="name-container"><?php echo $mostrar['Nombre'] ?></h4>
                    </div>
                    <div class="information-container">
                        <p class="inf" id="inf-ind"><?php echo $mostrar['Indicaciones'] ?></p>
                        <p class="inf" id="inf-pri"><?php echo "C$" . $mostrar['Precio'] ?></p>
                        <p class="inf" id="inf-lab"><?php echo $mostrar['nombre_laboratorio'] ?></p>
                        <p class="inf" id="inf-dis"> <?php echo $mostrar['nombre_distribuidor'] ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
    <?php include('../struct/footer.html') ?>
</body>

</html>