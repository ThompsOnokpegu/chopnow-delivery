<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glovo-like Hero Section</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS (for the search icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .hero-section {
            background: url('your-image-url.jpg') no-repeat center center fixed;
            background-color: #FFC244;
            background-size: cover;
            color: #fff;
            padding: 0px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .navbar {
            background: transparent;
        }

        .navbar .container {
            padding: 0;
        }

        .navbar .navbar-brand img {
            height: 30px;
            width: auto;
        }

        .navbar .form-control {
            padding: 4px 0px;
            font-size: 1rem;
            border-radius: 100px;
            border: none;
            text-align: center;
        }

        .navbar .form-control::placeholder {
            text-align: center;
        }

        .navbar .form-control:focus {
            box-shadow: none;
        }

        .navbar .btn {
            font-size: 1rem;
            padding: 4px 10px;
            border-radius: 100px;
            background:#ce2829;
            border-color:#ce2829;
        }

        @media (max-width: 768px) {
            .navbar .container {
                padding: 0 15px;
            }
        }
        .navbar .form-control {
            position: relative; /* Set the position of the input to relative */
            padding: 4px 30px 4px 10px; /* Adjust padding for icon alignment */
        }

        .svg-inline--fa {
            position: absolute;!important /* Set the position of the icon to absolute */
            right: 10px; /* Adjust the right position for icon alignment */
            top: 50%; /* Vertically center the icon */
            transform: translateY(-50%); /* Vertically center the icon */
            color: #999; /* Set the color of the icon */
            font-weight:100;
            padding-left:5px;
        }
       
        
    </style>
</head>
<body>

    <div class="hero-section">
        <div class="hero">
            <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-transparent">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('customer/assets/img/fevicon.png') }}" alt="img">
                    </a>
                    <form class="d-flex mx-auto">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <i class="fa">&#xf002;</i>
                    </form>
                    
                      
                    <div class="text-end">
                        <a class="btn btn-sm btn-primary" href="#">Get Started</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container text-center pt-5">
            <h1>Welcome to Glovo</h1>
            <p>Your favorite delivery service</p>
        </div>
        
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>
