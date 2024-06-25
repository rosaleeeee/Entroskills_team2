<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre titre</title>

    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <!-- Styles -->
    <style>
       
    </style>
</head>
<body>
    <nav class="nav1">
                    <img class="logo" src="{{ asset('Images/Logoo.png') }}" alt="logo">

        <ul >
            <li class="Button">
                <a class="a_nav" href="http://127.0.0.1:8000/profile">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
            <li class="Button">
                <a class="a_nav" href="http://127.0.0.1:8000/dashboard">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li class="Button">
                <a class="a_nav" href="#">
                    <i class="fas fa-users"></i>
                    <span class="nav-item">Team</span>
                </a>
            </li>
            <li  class="Button">
                <a class="a_nav" href="#">
                    <i class="fas fa-ellipsis-h"></i>
                    <span class="nav-item">More</span>
                </a>
            </li>
        </ul>
    </nav>
</body>
</html>
