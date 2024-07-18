<!DOCTYPE html>
<html>
<head>
    <title>WHOIS Lookup Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">WHOIS Lookup Result</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $domain = htmlspecialchars($_POST['domain']);

            // Validate domain
            if (!empty($domain) && filter_var(gethostbyname($domain), FILTER_VALIDATE_IP)) {
                $apiKey = 'DJW4DkkmpMLPYUWcvkvkp6N9HLx1G5R0'; // Your API key here
                $url = "https://api.apilayer.com/whois/query?domain={$domain}";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "apikey: $apiKey"
                ]);
                $response = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($response, true);

                if (isset($data['result'])) {
                    $result = $data['result'];
                    echo "<div class='card'>";
                    echo "<div class='card-header'>WHOIS Information for " . htmlspecialchars($result['domain_name']) . "</div>";
                    echo "<div class='card-body'>";
                    echo "<p><strong>Domain Name:</strong> " . htmlspecialchars($result['domain_name']) . "</p>";
                    echo "<p><strong>Creation Date:</strong> " . htmlspecialchars($result['creation_date']) . "</p>";
                    echo "<p><strong>Expiration Date:</strong> " . htmlspecialchars($result['expiration_date']) . "</p>";
                    echo "<p><strong>Updated Date:</strong> " . htmlspecialchars($result['updated_date']) . "</p>";
                    echo "<p><strong>Registrar:</strong> " . htmlspecialchars($result['registrar']) . "</p>";
                    echo "<p><strong>Status:</strong> " . htmlspecialchars(implode(', ', $result['status'])) . "</p>";
                    echo "<p><strong>Emails:</strong> " . htmlspecialchars($result['emails']) . "</p>";
                    echo "<p><strong>Name Servers:</strong> " . htmlspecialchars(implode(', ', $result['name_servers'])) . "</p>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Could not retrieve WHOIS information for domain: " . htmlspecialchars($domain);
                    echo "</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>";
                echo "Invalid domain: " . htmlspecialchars($domain);
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Please use the form to submit a domain.";
            echo "</div>";
        }
        ?>
        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary">Back</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>