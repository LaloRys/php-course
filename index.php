<?php
const API_URL = 'https://whenisthenextmcufilm.com/api';

// Inicializar una nueva sesion en cURL
$ch = curl_init(API_URL);

// Indicar que queremos recibir la respuesta de la peticion y no mostrar en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la peticion y guardar la respuesta
$result = curl_exec($ch);

//Una altenativa seria utilizar file_get_contents
// $result = file_get_contents(API_URL); //Si solo quieres hacer GET de una API


// Verificar si hubo errores en la solicitud cURL
if ($result === false) {
  $error = curl_error($ch);
  echo "Error en cURL: " . $error;
} else {
  // Verificar el contenido de la respuesta
  // echo "Contenido de la respuesta:\n";
  // var_dump($result);

  // Decodificar la respuesta JSON
  $data = json_decode($result, true);

  // Verificar si la decodificación fue exitosa
  if (json_last_error() === JSON_ERROR_NONE) {
    // echo "Datos decodificados:\n";
    // var_dump($data);
  } else {
    echo 'Error al decodificar JSON: ' . json_last_error_msg();
  }
}

curl_close($ch);
?>

<head>
  <meta charset="UTF-8">
  <title>La proxima pelicula de MCU</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="La proxima pelicula de MCU">
  <!-- Centered viewport -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
</head>

<main>
  <pre style="font-size: 8px; overflow: scroll; height: 250px">
    <?php
    var_dump($data);
    ?>
  </pre>
  <section>
    <img src=<?= $data['poster_url']; ?> width="200" alt="Poster de: <?= $data['title'] ?>" style="border-radius: 16px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);" />
  </section>
  <hgroup>
    <h2><?=
        $data['title'] . " se estrena en " . $data['days_until'] . " dias";
        ?>
    </h2>
    <p>
      Fecha de estreno <?=
                        $data['release_date'];
                        ?>
    </p>
    <p>
      La siguiete es: <?=
                      $data['following_production']['title']; ?>
    </p>
  </hgroup>
</main>

<style>
  :root {
    color-scheme: light dark;
  }

  body {
    display: grid;
    place-content: center;
  }

  section {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }

    hgroup {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
  

  img {
    margin: 0 auto;
  
  }

  pre {
      font-size: 12px;
      overflow: auto;
      height: 250px;
      white-space: pre-wrap;
      text-align: left;
      margin: 0 auto;
    }
</style>