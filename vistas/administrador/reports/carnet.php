<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carnet de Identificación Oficial</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 20px;
    }

    .section {
      margin-bottom: 30px;
    }

    .carnet-container {
      width: 800px;
      margin: auto;
      display: flex;
      justify-content: space-between;
    }

    .carnet-card {
      width: 380px;
      border: 1px solid #000;
      padding: 10px;
    }

    .carnet-card img {
      width: 100%;
      height: auto;
    }

    .foto {
      width: 90px;
      height: 110px;
      margin-top: 10px;
    }

    .datos {
      margin-top: 10px;
    }

    .datos span {
      display: block;
      margin-bottom: 4px;
    }
  </style>
</head>
<body>
  <div class="section">
    <h2>Carnet de Identificación Oficial</h2>
    <p><strong>Estimado(a) Albert Quintero,</strong></p>
    <p>Hacemos entrega de tu <strong>Carnet de Identificación Oficial</strong> como miembro activo del <strong>Club Deportivo Agua Dulce</strong>.</p>
    <ul>
      <li>Este documento certifica tu condición de <strong>Jugador</strong> en la categoría <strong>Sub-15</strong> con el número de camiseta <strong>001</strong>.</li>
      <li>En el reverso encontrarás el <strong>Reglamento y Aval</strong>, certificado por la Federación Venezolana de Fútbol (FVF).</li>
    </ul>
    <p><strong>Instrucción Importante:</strong> Lleva contigo este carnet en todas las actividades oficiales del club.</p>
    <p>¡Éxitos en esta temporada!</p>
    <p style="text-align: right;"><strong>La Directiva</strong><br>Club Deportivo Agua Dulce</p>
  </div>

  <div class="carnet-container">
    <div class="carnet-card">
      <img src="http://localhost/FutbolClub/assets/img/2.png" alt="Frente del carnet">
      <img src="http://localhost/FutbolClub/assets/img/albert.jpg" class="foto" alt="Foto del jugador">
      <div class="datos">
        <span><strong>NOMBRES:</strong> Albert</span>
        <span><strong>APELLIDOS:</strong> Quintero</span>
        <span><strong>F. NAC.:</strong> 13/12/2003</span>
        <span><strong>CATEGORÍA:</strong> Sub-15</span>
        <span><strong>N° CAMISETA:</strong> 001</span>
        <span><strong>ENTRENADOR:</strong> Keninzon Rivas</span>
      </div>
    </div>

    <div class="carnet-card">
      <img src="http://localhost/FutbolClub/assets/img/3.png" alt="Reverso del carnet">
    </div>
  </div>
</body>
</html>