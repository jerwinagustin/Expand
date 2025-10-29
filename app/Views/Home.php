<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Tracker - Home</title>
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

        /* ===== MAIN CONTENT ===== */
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

        /* ===== WALLET SECTION ===== */
        .wallet-section {
            width: 100%;
        }

        .wallet-label {
            display: inline-block;
            background: linear-gradient(135deg, #d94fff, #9c4fff);
            color: white;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 20px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .wallet-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 50px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 20px;
        }

        .wallet-balance h2 {
            font-size: 55px;
            margin: 0;
            color: #222;
            font-weight: 600;
        }

        .wallet-balance p {
            color: #c04eff;
            font-weight: 500;
            margin-top: 10px;
            font-size: 16px;
            letter-spacing: 0.5px;
        }

        .wallet-date {
            margin-top: 20px;
        }

        .date-range {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background-color: #fff;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            font-size: 14px;
            color: #333;
        }

        .date-range input[type="date"] {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        .date-range input[type="date"]:focus {
            outline: none;
            border-color: #9c4fff;
        }

        .date-range span {
            font-weight: 500;
            color: #666;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .wallet-balance h2 {
                font-size: 40px;
            }

            .date-range {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>

<body>

    <!-- Include Navigation -->
    <?= view('Navigation') ?>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">
        <h1>Expenses Tracker</h1>

        <div class="wallet-section">
            <span class="wallet-label">Wallet</span>

            <div class="wallet-card">
                <div class="wallet-balance">
                    <h2>₱ 0.00</h2>
                    <p><b>AVAILABLE BALANCE</b></p>
                </div>
            </div>

            <div class="wallet-date">
                <div class="date-range">
                    <input type="date" class="form-control form-control-sm" id="from-date" value="">
                    <span>To</span>
                    <input type="date" class="form-control form-control-sm" id="to-date" value="">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>