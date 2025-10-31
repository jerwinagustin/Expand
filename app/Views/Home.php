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
        :root {
            /* Light mode colors */
            --bg-primary: #f1f1f1;
            --bg-secondary: #ffffff;
            --text-primary: #1a152e;
            --text-secondary: #666;
            --text-muted: #333;
            --border-color: #ccc;
            --input-bg: transparent;
            --shadow: rgba(0, 0, 0, 0.08);
        }

        body.dark-mode {
            /* Dark mode colors */
            --bg-primary: #1a1a2e;
            --bg-secondary: #16213e;
            --text-primary: #e0e0e0;
            --text-secondary: #b8b8b8;
            --text-muted: #9d9d9d;
            --border-color: #2d3748;
            --input-bg: rgba(255, 255, 255, 0.05);
            --shadow: rgba(0, 0, 0, 0.3);
        }

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
            background-color: var(--bg-primary);
            transition: background-color 0.3s ease;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            background-color: var(--bg-primary);
            padding: 40px 50px;
            margin-left: 267px;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        .main-content h1 {
            font-size: 28px;
            color: var(--text-primary);
            margin-bottom: 30px;
            font-weight: 600;
            transition: color 0.3s ease;
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
            background-color: var(--bg-secondary);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 2px 10px var(--shadow);
            width: 100%;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
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
            color: var(--text-primary);
            font-weight: 600;
            transition: color 0.3s ease;
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
            color: var(--text-muted);
            transition: color 0.3s ease;
        }

        .date-range i {
            font-size: 18px;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .date-range input[type="date"] {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background-color: var(--input-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .date-range input[type="date"]:focus {
            outline: none;
            border-color: #9c4fff;
        }

        .date-range span {
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-size: 12px;
            transition: color 0.3s ease;
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

    <script>
        // Load theme on page load
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
            }
        })();
    </script>
</body>

</html>