<!DOCTYPE html>
<html>
<?php
include('../struct/head.html');
?>

<body>
    <?php include('../struct/header.html') ?>

    <div>
        <div class = "index-headers">
            <h1>Cuida tu salud y tu bolsillo</h1>
            <h3>Encuentra siempre lo mejor</h3>
            <h2 class=titulos-align>Medicamentos destacados</h2>
        </div>
        <div class="all-line-container">
            <?php include('../struct/slidebar.html') ?>
            <script>
                document.querySelectorAll('.catalogue-slidebar-info').forEach(elementt => {
                elementt.addEventListener('click', function() {
                    let categoria = this.id;
                    console.log(categoria);
                    $.post('catalogo.php', {
                        data_category: JSON.stringify(categoria)
                    }, function(data_category) {
                        window.location.href="catalogo.php"
                    })
                })
                });
            </script>
            <div class="all-carousel-container">
                <div class="back button-carousel">&#60</div>
                <div class="forward button-carousel">&#62</div>
                <img src="../images/destacado1.png" alt="" id="actual-image-carousel">
            </div>
            <script>
                var images = ['../images/destacado1.png', '../images/destacado2.png', '../images/destacado3.png']
                var cont = 0;

                function carousel(container) {
                    container.addEventListener('click', e => {
                        let back = container.querySelector('.back'),
                            adelante = container.querySelector('.forward'),
                            img = container.querySelector('img'),
                            tgt = e.target;

                        if (tgt == back) {
                            if (cont > 0) {
                                cont--;
                                img.src = images[cont];
                            } else {
                                cont = images.length - 1;
                                img.src = images[cont];
                            }
                        } else if (tgt == adelante) {
                            if (cont < images.length - 1) {
                                cont++;
                                img.src = images[cont];
                            } else {
                                cont = 0;
                                img.src = images[cont];
                            }
                        }
                    });
                }

                document.addEventListener("DOMContentLoaded", () => {
                    let container = document.querySelector('.all-carousel-container'); // 
                    carousel(container);
                });
            </script>
        </div>
    </div>
    </div>
    <?php include('../struct/footer.html'); ?>
</body>

</html>