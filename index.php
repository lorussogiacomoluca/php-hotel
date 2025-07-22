<?php

$hotels = [

  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],

];

if (isset($_GET['park_filter'])) {
  $filtred = [];
  foreach ($hotels as $hotel) {
    if ($hotel['parking'] === true) {
      $filtred[] = $hotel;
    }
  }
  $hotels = $filtred;
}

if (isset($_GET['vote_filter'])) {
  $filtred = [];
  foreach ($hotels as $hotel) {
    if ($hotel['vote'] >= $_GET['vote_filter']) {
      $filtred[] = $hotel;
    }
  }
  $hotels = $filtred;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotels</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">
  <div class="container mt-3">
    <div class="row ">
      <div class="col text-center">
        <h1>Hotels</h1>
      </div>
    </div>
    <div class="row my-4">
      <div class="col">
        <form class="row g-3 align-items-center" method="GET" action="./index.php">

          <!-- Switch Parking -->
          <div class="col-auto">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault" name="park_filter"
                <?php if (isset($_GET['park_filter'])) echo 'checked'; ?>>
              <label class="form-check-label" for="switchCheckDefault">Parking</label>
            </div>
          </div>

          <!-- Range votazione -->
          <div class="col-auto d-flex align-items-center">
            <label for="customRange3" class="form-label mb-0 me-2">Votazione:</label>
            <input type="range" class="form-range" min="0" max="5" step="1"
              value="<?php echo isset($_GET['vote_filter']) ? $_GET['vote_filter'] : 3; ?>"
              id="customRange3" name="vote_filter"
              oninput="document.getElementById('rangeValue').textContent = this.value" style="width: 150px;">
            <output id="rangeValue" class="ms-2"><?php echo isset($_GET['vote_filter']) ? $_GET['vote_filter'] : 3; ?></output>
          </div>

          <!-- Submit button -->
          <div class="col-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Parking</th>
              <th scope="col">Vote</th>
              <th scope="col">Distance to Center</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($hotels as $hotel) {
              echo '<tr>';
              foreach ($hotel as $key => $value) {
                if ($key === 'parking') {
                  echo $value ? '<td>✅</td> ' : '<td>❌</td> ';
                } else {
                  echo "
          <td> $value </td>";
                }
              }
              echo '<tr>';
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script>
    // This is an example script, please modify as needed
    const rangeInput = document.getElementById('customRange3');
    const rangeOutput = document.getElementById('rangeValue');

    // Set initial value
    rangeOutput.textContent = rangeInput.value;

    rangeInput.addEventListener('input', function() {
      rangeOutput.textContent = this.value;
    });
  </script>
</body>

</html>