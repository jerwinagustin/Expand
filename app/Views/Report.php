<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Tracker - Report</title>
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
            --text-primary: #222;
            --text-secondary: #666;
            --text-muted: #333;
            --border-color: #ccc;
            --input-bg: transparent;
            --shadow: rgba(0, 0, 0, 0.08);
            --grid-color: #e5e5e5;
            --chart-text: #666;
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
            --grid-color: #2d3748;
            --chart-text: #b8b8b8;
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
            min-height: 400px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* ===== CHART ===== */
        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        .chart-title::before {
            content: '';
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, #d94fff, #9c4fff);
            border-radius: 50%;
        }

        /* ===== DATE RANGE ===== */
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

            .top-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .balance-tran .content h2 {
                font-size: 20px;
            }

            .balance-tran .line {
                height: 45px;
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
        <div class="top-header">
            <div class="balance-tran">
                <div class="line"></div>
                <div class="content">
                    <h2>₱ 0.00</h2>
                    <p>Available Balance</p>
                </div>
            </div>

            <h1>Expenses Tracker</h1>
        </div>

        <div class="group">
            <div class="wallet-section">
                <span class="wallet-label">Report</span>

                <div class="wallet-card">
                    <div class="chart-title">Budget</div>
                    <div class="chart-container">
                        <canvas id="expenseChart"></canvas>
                    </div>
                </div>

                <!-- ===== DATE FILTER ===== -->
                <div class="wallet-date">
                    <div class="date-range">
                        <i class='bx bx-calendar'></i>
                        <input type="date" id="from-date" value="">
                        <span>To</span>
                        <i class='bx bx-calendar'></i>
                        <input type="date" id="to-date" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Load theme on page load
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
            }
        })();

        // Get theme-aware colors
        function getThemeColors() {
            const isDark = document.body.classList.contains('dark-mode');
            return {
                text: isDark ? '#b8b8b8' : '#666',
                textPrimary: isDark ? '#e0e0e0' : '#222',
                grid: isDark ? '#2d3748' : '#e5e5e5',
                tooltipBg: isDark ? '#16213e' : '#fff',
                tooltipText: isDark ? '#e0e0e0' : '#222',
                tooltipBody: isDark ? '#b8b8b8' : '#666'
            };
        }

        // Expense Chart
        const ctx = document.getElementById('expenseChart').getContext('2d');
        let colors = getThemeColors();

        const expenseChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Budget',
                    data: [0, 12, 38, 30, 32],
                    borderColor: '#d946ef',
                    backgroundColor: 'rgba(217, 70, 239, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    pointBackgroundColor: '#d946ef',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'start',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                family: 'Poppins',
                                size: 14,
                                weight: '500'
                            },
                            color: colors.text,
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: colors.tooltipBg,
                        titleColor: colors.tooltipText,
                        bodyColor: colors.tooltipBody,
                        borderColor: '#d946ef',
                        borderWidth: 2,
                        padding: 12,
                        displayColors: true,
                        bodyFont: {
                            family: 'Poppins',
                            size: 13
                        },
                        titleFont: {
                            family: 'Poppins',
                            size: 14,
                            weight: '600'
                        },
                        callbacks: {
                            label: function(context) {
                                return 'Budget: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 40,
                        ticks: {
                            stepSize: 10,
                            font: {
                                family: 'Poppins',
                                size: 12
                            },
                            color: colors.text
                        },
                        grid: {
                            color: colors.grid,
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: 'Poppins',
                                size: 12
                            },
                            color: colors.text
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Update chart colors when theme changes
        window.addEventListener('storage', function(e) {
            if (e.key === 'theme') {
                colors = getThemeColors();
                expenseChart.options.plugins.legend.labels.color = colors.text;
                expenseChart.options.plugins.tooltip.backgroundColor = colors.tooltipBg;
                expenseChart.options.plugins.tooltip.titleColor = colors.tooltipText;
                expenseChart.options.plugins.tooltip.bodyColor = colors.tooltipBody;
                expenseChart.options.scales.y.ticks.color = colors.text;
                expenseChart.options.scales.x.ticks.color = colors.text;
                expenseChart.options.scales.y.grid.color = colors.grid;
                expenseChart.update();
            }
        });
    </script>
</body>

</html>