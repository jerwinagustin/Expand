<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Tracker - Expense</title>
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
            background-color: #222;
            border-radius: 2px;
            margin-top: 5px;
        }

        .balance-tran .content h2 {
            font-size: 24px;
            margin: 0;
            color: #222;
            font-weight: 700;
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
            color: #222;
            margin: 0;
            font-weight: 600;
        }

        /* ===== WALLET SECTION ===== */
        .wallet-section {
            width: 100%;
            margin-top: 30px;
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
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            width: 100%;
            margin-bottom: 20px;
        }

        /* ===== EXPENSE ITEMS ===== */
        .expense-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .expense-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-radius: 12px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            position: relative;
        }

        .expense-item.active {
            background: linear-gradient(135deg, #d94fff, #9c4fff);
            border: none;
            color: white;
        }

        .expense-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .expense-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .expense-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            background-color: #f5f5f5;
        }

        .expense-item.active .expense-icon {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .expense-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 4px 0;
            color: #222;
        }

        .expense-item.active .expense-details h3,
        .expense-item.active .expense-details p {
            color: white;
        }

        .expense-details p {
            font-size: 13px;
            margin: 0;
            color: #666;
        }

        .expense-menu {
            position: relative;
        }

        .menu-dots {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .expense-item.active .menu-dots {
            color: white;
        }

        .menu-dots:hover {
            color: #9c4fff;
        }

        .expense-item.active .menu-dots:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .dropdown-menu-custom {
            position: absolute;
            top: 35px;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 8px 0;
            min-width: 120px;
            z-index: 1000;
            display: none;
        }

        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-menu-custom a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
        }

        .dropdown-menu-custom a:hover {
            background-color: #f5f5f5;
        }

        .top-right-menu {
            position: absolute;
            top: 95px;
            right: 50px;
        }

        .menu-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(90deg);
        }

        .menu-btn:hover {
            color: #9c4fff;
        }

        .add-btn-visible {
            background-color: #e0e0e0;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            color: #333;
            transition: background 0.3s;
        }

        .add-btn-visible:hover {
            background-color: #d0d0d0;
        }

        .add-btn {
            background-color: transparent;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            color: #333;
            transition: background 0.3s;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: #f5f5f5;
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

            .top-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .balance-tran .content h2 {
                font-size: 24px;
            }

            .balance-tran .line {
                height: 50px;
            }

            .date-range {
                flex-wrap: wrap;
                gap: 8px;
            }

            .top-right-menu {
                right: 20px;
            }

            .expense-item {
                padding: 15px;
            }

            .expense-icon {
                width: 40px;
                height: 40px;
                font-size: 24px;
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

            <!-- Three Dots Menu -->
            <div class="top-right-menu">
                <button class="menu-btn" onclick="toggleTopMenu(event)">
                    <i class='bx bx-dots-vertical-rounded'></i>
                </button>
                <div class="dropdown-menu-custom" id="topMenu">
                    <a href="#" class="add-btn" onclick="showAddButton()">Add</a>
                </div>
            </div>
        </div>

        <div class="wallet-section">
            <span class="wallet-label">Expense</span>

            <div class="wallet-card">
                <div class="expense-list">
                    <!-- Expense Item 1: Foods -->
                    <div class="expense-item">
                        <div class="expense-left">
                            <div class="expense-icon">
                                <i class='bx bx-restaurant'></i>
                            </div>
                            <div class="expense-details">
                                <h3>FOODS</h3>
                                <p>Budget: 2,000.00</p>
                            </div>
                        </div>
                        <div class="expense-menu">
                            <button class="menu-dots" onclick="toggleDropdown(event, 'menu1')">
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </button>
                            <div class="dropdown-menu-custom" id="menu1">
                                <a href="#">Edit</a>
                                <a href="#">Delete</a>
                            </div>
                        </div>
                    </div>

                    <!-- Expense Item 2: Bills (Active) -->
                    <div class="expense-item active">
                        <div class="expense-left">
                            <div class="expense-icon">
                                <i class='bx bx-receipt'></i>
                            </div>
                            <div class="expense-details">
                                <h3>BILLS</h3>
                                <p>Budget: 6,000.00</p>
                            </div>
                        </div>
                        <div class="expense-menu">
                            <button class="menu-dots" onclick="toggleDropdown(event, 'menu2')">
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </button>
                            <div class="dropdown-menu-custom" id="menu2">
                                <a href="#">Edit</a>
                                <a href="#">Delete</a>
                            </div>
                        </div>
                    </div>

                    <!-- Expense Item 3: Transportation -->
                    <div class="expense-item">
                        <div class="expense-left">
                            <div class="expense-icon">
                                <i class='bx bx-bus'></i>
                            </div>
                            <div class="expense-details">
                                <h3>TRANSPORTATION</h3>
                                <p>Clothing items that consistently lead our sales charts.</p>
                            </div>
                        </div>
                        <div class="expense-menu">
                            <button class="menu-dots" onclick="toggleDropdown(event, 'menu3')">
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </button>
                            <div class="dropdown-menu-custom" id="menu3">
                                <a href="#">Edit</a>
                                <a href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== DATE FILTER ===== -->
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

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle dropdown menu for expense items
        function toggleDropdown(event, menuId) {
            event.stopPropagation();
            const menu = document.getElementById(menuId);

            // Close all other menus
            document.querySelectorAll('.dropdown-menu-custom').forEach(m => {
                if (m.id !== menuId) m.classList.remove('show');
            });

            menu.classList.toggle('show');
        }

        // Toggle top right menu
        function toggleTopMenu(event) {
            event.stopPropagation();
            const menu = document.getElementById('topMenu');

            // Close all other menus
            document.querySelectorAll('.dropdown-menu-custom').forEach(m => {
                if (m.id !== 'topMenu') m.classList.remove('show');
            });

            menu.classList.toggle('show');
        }

        // Show add button functionality
        function showAddButton() {
            alert('Add functionality will be implemented');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                menu.classList.remove('show');
            });
        });
    </script>
</body>

</html>