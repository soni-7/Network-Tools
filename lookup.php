<?php
if (isset($_GET['ip'])) {
    // Get the IP address from the query parameter
    $ip = htmlspecialchars($_GET['ip']);

    // API URL
    $apiUrl = "http://ip-api.com/json/{$ip}";

    // Fetch data from the API
    $response = file_get_contents($apiUrl);

    // Decode the JSON response
    $data = json_decode($response, true);

    if ($data['status'] === 'fail') {
        echo "<h1>Invalid IP Address</h1>";
    } else {
        echo "<h1>IP Address Information</h1>";
        echo "<p><strong>IP:</strong> " . htmlspecialchars($data['query']) . "</p>";
        echo "<p><strong>Country:</strong> " . htmlspecialchars($data['country']) . "</p>";
        echo "<p><strong>Country Code:</strong> " . htmlspecialchars($data['countryCode']) . "</p>";
        echo "<p><strong>Region:</strong> " . htmlspecialchars($data['region']) . "</p>";
        echo "<p><strong>Region Name:</strong> " . htmlspecialchars($data['regionName']) . "</p>";
        echo "<p><strong>City:</strong> " . htmlspecialchars($data['city']) . "</p>";
        echo "<p><strong>ZIP:</strong> " . htmlspecialchars($data['zip']) . "</p>";
        echo "<p><strong>Latitude:</strong> " . htmlspecialchars($data['lat']) . "</p>";
        echo "<p><strong>Longitude:</strong> " . htmlspecialchars($data['lon']) . "</p>";
        echo "<p><strong>Timezone:</strong> " . htmlspecialchars($data['timezone']) . "</p>";
        echo "<p><strong>ISP:</strong> " . htmlspecialchars($data['isp']) . "</p>";
        echo "<p><strong>Organization:</strong> " . htmlspecialchars($data['org']) . "</p>";
        echo "<p><strong>AS:</strong> " . htmlspecialchars($data['as']) . "</p>";
    }
} else {
    echo "<h1>No IP Address Provided</h1>";
}
?>
