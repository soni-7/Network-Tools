<!DOCTYPE html>
<html>
<head>
    <title>WHOIS Lookup</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 50px;
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
    <div class="container">
        <h1 class="text-center mb-4">WHOIS Lookup</h1>
        <form action="whois_lookup.php" method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="domain">Domain:</label>
                <input type="text" class="form-control" id="domain" name="domain" required>
                <div class="invalid-feedback">Please enter a valid domain.</div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Get WHOIS Info</button>
        </form>
    </div>
   <!-- Bootstrap JS and dependencies -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
