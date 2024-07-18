<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNS Lookup</title>
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
        <h1 class="text-center">DNS Lookup</h1>
        <form action="dns_lookup.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="domain">Enter Domain:</label>
                <input type="text" class="form-control" id="domain" name="domain" required>
            </div>
            <button type="submit" class="btn btn-primary">Lookup</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $domain = htmlspecialchars($_POST['domain']);
            $apiKey = 'I6xlSesNMqSk0wELUo5L4Elrv6gLVNQ2';
            $url = "https://api.apilayer.com/dns_lookup/api/a/$domain";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "apikey: $apiKey"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            if (isset($data['results'])) {
                echo '<div class="mt-5">';
                echo '<h2>DNS Lookup Results for Domain: ' . $domain . '</h2>';
                echo '<p><strong>Request Type:</strong> ' . $data['requestType'] . '</p>';
                echo '<p><strong>Process Response Time:</strong> ' . $data['processResponseTime'] . '</p>';
                echo '<table class="table table-bordered mt-3">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>IP Address</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($data['results'] as $result) {
                    echo '<tr>';
                    echo '<td>' . $result['ipAddress'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger mt-5">Invalid domain or no data available.</div>';
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
