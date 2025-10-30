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
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 100%;
            margin-bottom: 20px;
        }

        .balance-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .line {
            width: 5px;
            height: 80px;
            background: linear-gradient(135deg, #d94fff, #9c4fff);
            border-radius: 10px;
        }

        .balance-content h2 {
            font-size: 48px;
            margin: 0;
            color: #222;
            font-weight: 600;
        }

        .balance-content p {
            color: #c04eff;
            font-weight: 600;
            margin: 5px 0 0 0;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .wallet-date {
            margin-top: 0;
        }

        .date-range {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #333;
        }

        .date-range i {
            font-size: 18px;
            color: #666;
        }

        .date-range input[type="date"] {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background-color: transparent;
        }

        .date-range input[type="date"]:focus {
            outline: none;
            border-color: #9c4fff;
        }

        .date-range span {
            font-weight: 500;
            color: #666;
            text-transform: uppercase;
            font-size: 12px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .balance-content h2 {
                font-size: 36px;
            }

            .line {
                height: 60px;
            }

            .date-range {
                flex-wrap: wrap;
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
                <div class="balance-section">
                    <div class="line"></div>
                    <div class="balance-content">
                        <h2>₱ 0.00</h2>
                        <p>AVAILABLE BALANCE</p>
                    </div>
                </div>

                <div class="wallet-date">
                    <div class="date-range">
                        <i class='bx bx-calendar'></i>
                        <input type="date" id="from-date" value="2030-07-25">
                        <span>To</span>
                        <i class='bx bx-calendar'></i>
                        <input type="date" id="to-date" value="2030-07-29">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>