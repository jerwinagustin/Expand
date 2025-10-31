<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction - Expenses Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        :root {
            /* Light mode colors */
            --bg-primary: #f1f1f1;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f5f5f5;
            --text-primary: #222;
            --text-secondary: #666;
            --text-muted: #333;
            --border-color: #ccc;
            --input-bg: white;
            --shadow: rgba(0, 0, 0, 0.06);
            --hover-bg: #ebebeb;
        }

        body.dark-mode {
            /* Dark mode colors */
            --bg-primary: #1a1a2e;
            --bg-secondary: #16213e;
            --bg-tertiary: #1e2a3a;
            --text-primary: #e0e0e0;
            --text-secondary: #b8b8b8;
            --text-muted: #9d9d9d;
            --border-color: #2d3748;
            --input-bg: rgba(255, 255, 255, 0.05);
            --shadow: rgba(0, 0, 0, 0.3);
            --hover-bg: #0f1419;
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

        .top-header {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-left: 10px;
        }

        .balance-tran {
            display: flex;
            align-items: flex-start;
            gap: 5px;
        }

        .balance-tran .line {
            width: 4px;
            height: 50px;
            background-color: var(--text-primary);
            border-radius: 2px;
            margin-top: 5px;
            transition: background-color 0.3s ease;
        }

        .balance-tran .content h2 {
            font-size: 24px;
            margin: 0;
            color: var(--text-primary);
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .balance-tran .content p {
            color: #d946ef;
            font-weight: 500;
            margin: 0;
            font-size: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .top-header h1 {
            font-size: 24px;
            color: var(--text-primary);
            margin: 0;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .main-content {
            flex: 1;
            background-color: var(--bg-primary);
            padding: 40px 50px;
            margin-left: 267px;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

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

        .transaction-box {
            background: var(--bg-secondary);
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 8px var(--shadow);
            margin-top: 15px;
            max-width: 800px;
            overflow: hidden;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .transaction {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 25px;
            background-color: var(--bg-tertiary);
            margin-bottom: 2px;
            transition: all 0.2s ease;
        }

        .transaction:hover {
            background-color: var(--hover-bg);
        }

        .transaction:last-child {
            margin-bottom: 0;
        }

        .transaction .left-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .transaction .date-time {
            color: var(--text-secondary);
            font-size: 11px;
            margin: 0;
            font-weight: 400;
            transition: color 0.3s ease;
        }

        .transaction .desc {
            color: var(--text-primary);
            font-weight: 500;
            margin: 0;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .transaction .amount {
            font-weight: 600;
            font-size: 16px;
            white-space: nowrap;
            color: var(--text-primary);
            transition: color 0.3s ease;
        }

        .amount.positive {
            color: var(--text-primary);
        }

        .amount.negative {
            color: var(--text-primary);
        }

        .wallet-date {
            margin-top: 25px;
        }

        .date-range {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background-color: transparent;
            border-radius: 8px;
            padding: 0;
            font-size: 14px;
            color: var(--text-muted);
            transition: color 0.3s ease;
        }

        .date-range input[type=date] {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            background-color: var(--input-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .date-range input[type=date]:focus {
            outline: none;
            border-color: #9c4fff;
        }

        .date-range span {
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .date-range .calendar-icon {
            font-size: 18px;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        @media (max-width: 768px) {
            .top-header {
                left: 0;
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }

            .main-content {
                margin-left: 0;
                padding: 180px 20px 40px;
            }

            .transaction-box {
                padding: 15px;
            }

            .transaction {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .amount {
                align-self: flex-end;
            }

            .date-range {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <?php echo view('Navigation'); ?>
    <div class="main-content">
        <div class="top-header">
            <div class="balance-tran">
                <div class="line"></div>
                <div class="content">
                    <h2>₱ 0.00</h2>
                    <p>AVAILABLE BALANCE</p>
                </div>
            </div>
            <h1>Expenses Tracker</h1>
        </div>
        <div class="wallet-section">
            <span class="wallet-label">Transaction History</span>
            <div class="transaction-box">
                <div class="transaction">
                    <div class="left-content">
                        <p class="date-time">Oct 21, 2025</p>
                        <p class="date-time">9:30 PM</p>
                        <p class="desc">Send Money</p>
                    </div>
                    <p class="amount positive">+2,000.00</p>
                </div>
                <div class="transaction">
                    <div class="left-content">
                        <p class="date-time">Oct 11, 2025</p>
                        <p class="date-time">10:50 PM</p>
                        <p class="desc">Send Money</p>
                    </div>
                    <p class="amount negative">-500.00</p>
                </div>
                <div class="transaction">
                    <div class="left-content">
                        <p class="date-time">Oct 1, 2025</p>
                        <p class="date-time">12:50 PM</p>
                        <p class="desc">Send Money</p>
                    </div>
                    <p class="amount negative">-1000.00</p>
                </div>
            </div>
            <div class="wallet-date">
                <div class="date-range">
                    <i class='bx bx-calendar calendar-icon'></i>
                    <input type="date" id="from-date" value="2030-07-25">
                    <span>To</span>
                    <i class='bx bx-calendar calendar-icon'></i>
                    <input type="date" id="to-date" value="2030-07-29">
                </div>
            </div>
        </div>
    </div>
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