<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - Expenses Tracker</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #f1f1f1;
        }

        .main-content {
            flex: 1;
            background-color: #f1f1f1;
            padding: 40px 50px;
            margin-left: 267px;
            min-height: 100vh;
        }

        .main-content h1 {
            font-size: 28px;
            color: #1a152e;
            margin-bottom: 30px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Include Navigation -->
    <?= view('Navigation') ?>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">
        <h1>Report</h1>
        <p>Report page content goes here...</p>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>