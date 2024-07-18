<!DOCTYPE html>
<html>
<head>
    <title>IP Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            margin-top: 20px;
        }
        body {
            padding-top: 56px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">Network Tools</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ipwithmap.html">Ip_Info.</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="location.php">Location_Info.</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dns_lookup.php">dns_lookup</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="whoisapi.php">Whois_info</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>Welcome to Network Tools</h1>
            <p class="lead">Your one-stop solution for network management</p>
        </div>
    </header>
    <div class="container mt-5">
        <h1 class="text-center mb-4">IP Information</h1>
        <?php
        // Fetch the public IP address using an external service
        $publicIp = file_get_contents('http://api.ipify.org');
  // Fetch IP information from IP-API
  $url = "http://ip-api.com/json/{$publicIp}";
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  if ($data['status'] == 'success') {
      echo "<div class='card mb-4'>";
      echo "<div class='card-header'>IP Information for " . htmlspecialchars($data['query']) . "</div>";
      echo "<div class='card-body'>";
      echo "<p><strong>Country:</strong> " . htmlspecialchars($data['country']) . "</p>";
      echo "<p><strong>Country Code:</strong> " . htmlspecialchars($data['countryCode']) . "</p>";
      echo "<p><strong>Region:</strong> " . htmlspecialchars($data['region']) . "</p>";
      echo "<p><strong>Region Name:</strong> " . htmlspecialchars($data['regionName']) . "</p>";
      echo "<p><strong>City:</strong> " . htmlspecialchars($data['city']) . "</p>";
      echo "<p><strong>ZIP:</strong> " . htmlspecialchars($data['zip']) . "</p>";
      echo "<p><strong>Timezone:</strong> " . htmlspecialchars($data['timezone']) . "</p>";
      echo "<p><strong>ISP:</strong> " . htmlspecialchars($data['isp']) . "</p>";
      echo "<p><strong>Organization:</strong> " . htmlspecialchars($data['org']) . "</p>";
      echo "<p><strong>AS:</strong> " . htmlspecialchars($data['as']) . "</p>";
      echo "</div>";
      echo "</div>";

      // Add map container
      echo "<div id='map'></div>";

      // Add JavaScript to display map
      echo "<script src='https://unpkg.com/leaflet/dist/leaflet.js'></script>";
      echo "<script>
          var map = L.map('map').setView([" . $data['lat'] . ", " . $data['lon'] . "], 13);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors'
          }).addTo(map);
          L.marker([" . $data['lat'] . ", " . $data['lon'] . "]).addTo(map)
              .bindPopup('" . htmlspecialchars($data['city']) . "')
              .openPopup();
      </script>";
  } else {
      echo "<div class='alert alert-danger' role='alert'>";
      echo "Could not retrieve information for IP: " . htmlspecialchars($publicIp);
      echo "</div>";
  }
  ?>
</div>

 <!-- Bootstrap JS and dependencies -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>