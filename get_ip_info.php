<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = htmlspecialchars($_POST['ip']);

    // Validate IP address
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        $url = "http://ip-api.com/json/{$ip}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data['status'] == 'success') {
            echo "<div class='container mt-5'>";
            echo "<h1 class='text-center mb-4'>IP Information</h1>";
            echo "<p>Country: " . $data['country'] . "</p>";
            echo "<p>Country Code: " . $data['countryCode'] . "</p>";
            echo "<p>Region: " . $data['region'] . "</p>";
            echo "<p>Region Name: " . $data['regionName'] . "</p>";
            echo "<p>City: " . $data['city'] . "</p>";
            echo "<p>ZIP: " . $data['zip'] . "</p>";
            echo "<p>Timezone: " . $data['timezone'] . "</p>";
            echo "<p>ISP: " . $data['isp'] . "</p>";
            echo "<p>Organization: " . $data['org'] . "</p>";
            echo "<p>AS: " . $data['as'] . "</p>";
            echo "<p>Query IP: " . $data['query'] . "</p>";

            // Add map container
            echo "<div id='map'></div>";
            echo "</div>";
// Add JavaScript to display map
echo "<script src='https://unpkg.com/leaflet/dist/leaflet.js'></script>";
echo "<script>
    var map = L.map('map').setView([" . $data['lat'] . ", " . $data['lon'] . "], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([" . $data['lat'] . ", " . $data['lon'] . "]).addTo(map)
        .bindPopup('" . $data['city'] . "')
        .openPopup();
</script>";
} else {
echo "<div class='container mt-5'>";
echo "<p>Could not retrieve information for IP: $ip</p>";
echo "</div>";
}
} else {
echo "<div class='container mt-5'>";
echo "<p>Invalid IP address.</p>";
echo "</div>";
}
} else {
echo "<div class='container mt-5'>";
echo "<p>Please use the form to submit an IP address.</p>";

}
?>