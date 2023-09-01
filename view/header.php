<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beautiful Header with Bootstrap 5</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    .header {
      background-color: #f8f9fa;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .student-portal {
      font-size: 32px;
      font-weight: bold;
      animation: fadeInUp 1s ease-in-out infinite;
    }

    .logout-btn {
      transition: all 0.3s ease-in-out;
    }

    .logout-btn:hover {
      transform: scale(1.1);
    }

    @keyframes fadeInUp {
      0% {
        transform: translateY(0);
        opacity: 0.8;
      }

      50% {
        transform: translateY(-5px);
        opacity: 1;
      }

      100% {
        transform: translateY(0);
        opacity: 0.8;
      }
    }
  </style>
</head>

<body>
  <header class="header">
    <!-- Left section -->
    <div class="left-section">
      <a href="#">Home</a>
      <a href="#">Change Password</a>
      <a href="#">Update Profile</a>
    </div>

    <!-- Middle section -->
    <div class="student-portal">Student Portal</div>

    <!-- Right section -->
    <div class="right-section">
    <img src="path/to/user-image.jpg" alt="User Image" class="user-image rounded-circle">
      <span class="user-name"><?php echo $user['0']['fullname'] ?></span>
      <button class="btn btn-danger logout-btn">Logout</button>
    </div>
  </header>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>
