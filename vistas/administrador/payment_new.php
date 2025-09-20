<?php
    //  if (isset($this->data)) {
    //  var_dump($this->data);
    //  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/index.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/players.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/payments.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Futbol Club | Panel Administrador</title>
</head>
<body>
    <?php include("vistas/layout/header.php") ?>
    <main class="index-main" id="index-main">
        <?php include('vistas/layout/session.php'); ?>
                <div class="newplayers-container">
            <h1>Generar Pago</h1>
            <form class="new_payment" action="/FutbolClub/administrador/nuevopago" method="post">
                <div class="new_payment_group">
                    <label for=""nombrepago>Concepto del Pago:</label>
                    <input type="text" name="nombrepago" id="nombrepago" placeholder="Ingresa el nombre del pago">
                </div>
                <div class="new_payment_group">
                    <label for=""nombrepago>Descripcion del Pago:</label>
                    <input type="text" name="descripcion" id="nombrepago" placeholder="Ingresa la descripcion">
                </div>
                <div class="new_payment_group">
                    <label for=""nombrepago>Monto del pago en $:</label>
                    <input type="number" name="montopago" id="montopago" placeholder="Ingresa el monto de pago">
                </div>
                <div class="new_payment_group">
                    <label for="nombrepago">Aplicable a estas categorias:</label>
                    <div class="new_payment_groups_checkbox">
                        <?php foreach ($this->data as $dato ):?>
                        <div class="new_payment_group_checkbox">
                            <input type="checkbox" name="categorias[]" value="<?php echo $dato['id']?>" id="">
                            <span><?php echo $dato['nombre_categoria']?></span>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="new_payment_buttons">
                    <button class="np-form-button-save" type="submit">Enviar</button>
                    <button class="np-form-button-reset" type="reset">Limpiar</button>
                </div>
            </form>
        </div>
    </main>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>