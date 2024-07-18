<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP to Location</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        <h1 class="text-center">IP to Location</h1>
        <form action="location.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="ip">Enter IP Address:</label>
                <input type="text" class="form-control" id="ip" name="ip" required>
            </div>
            <button type="submit" class="btn btn-primary">Get Location</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ip = htmlspecialchars($_POST['ip']);
            $apiKey = 'I6xlSesNMqSk0wELUo5L4Elrv6gLVNQ2';
            $url = "https://api.apilayer.com/ip_to_location/$ip";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "apikey: $apiKey"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            if (isset($data['country_name'])) {
                echo '<div class="mt-5">';
                echo '<h2>Location Information for IP: ' . $ip . '</h2>';
                echo '<p><strong>Country:</strong> ' . $data['country_name'] . ' (' . $data['country_code'] . ')</p>';
                echo '<p><strong>Region:</strong> ' . $data['region_name'] . '</p>';
                echo '<p><strong>City:</strong> ' . $data['city'] . '</p>';
                echo '<p><strong>Latitude:</strong> ' . $data['latitude'] . '</p>';
                echo '<p><strong>Longitude:</strong> ' . $data['longitude'] . '</p>';
                echo '<p><strong>Continent:</strong> ' . $data['continent_name'] . ' (' . $data['continent_code'] . ')</p>';
                echo '<p><strong>ISP:</strong> ' . $data['connection']['isp'] . ' (ASN: ' . $data['connection']['asn'] . ')</p>';
                echo '<p><strong>Capital:</strong> ' . $data['location']['capital'] . '</p>';
                echo '<p><strong>Native Name:</strong> ' . $data['location']['native_name'] . '</p>';
                if (isset($data['location']['flag'])) {
                    echo '<p><strong>Flag:</strong> <img src="' . $data['location']['flag'] . '" alt="Flag" width="50"></p>';
                }
                echo '<p><strong>Top Level Domains:</strong> ' . implode(', ', $data['location']['top_level_domains']) . '</p>';
                echo '<p><strong>Calling Codes:</strong> ' . implode(', ', $data['location']['calling_codes']) . '</p>';
                echo '<p><strong>Currency:</strong> ' . $data['currencies'][0]['name'] . ' (' . $data['currencies'][0]['code'] . ') ' . $data['currencies'][0]['symbol'] . '</p>';
                echo '<p><strong>Timezone:</strong> ' . implode(', ', $data['timezones']) . '</p>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger mt- only include if the flag is available5">Invalid IP address or no data available.</div>';
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
