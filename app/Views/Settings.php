<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Expenses Tracker</title>
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

        :root {
            /* Light mode colors */
            --bg-primary: #f1f1f1;
            --bg-secondary: #ffffff;
            --text-primary: #1a152e;
            --text-secondary: #666;
            --border-color: #e0e0e0;
            --shadow: rgba(0, 0, 0, 0.08);
        }

        body.dark-mode {
            /* Dark mode colors */
            --bg-primary: #1a1a2e;
            --bg-secondary: #16213e;
            --text-primary: #e0e0e0;
            --text-secondary: #b8b8b8;
            --border-color: #2d3748;
            --shadow: rgba(0, 0, 0, 0.3);
        }

        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
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
        }

        /* ===== SETTINGS SECTION ===== */
        .settings-container {
            max-width: 800px;
        }

        .settings-card {
            background-color: var(--bg-secondary);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px var(--shadow);
            margin-bottom: 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .settings-card h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-card h2 i {
            font-size: 24px;
            color: #d946ef;
        }

        .settings-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            transition: border-color 0.3s ease;
        }

        .settings-option:last-child {
            border-bottom: none;
        }

        .option-info {
            flex: 1;
        }

        .option-info h3 {
            font-size: 16px;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .option-info p {
            font-size: 13px;
            color: var(--text-secondary);
            margin: 0;
        }

        /* ===== TOGGLE SWITCH ===== */
        .theme-toggle {
            position: relative;
            width: 60px;
            height: 30px;
        }

        .theme-toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #d94fff, #9c4fff);
            border-radius: 30px;
            transition: 0.3s;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            border-radius: 50%;
            transition: 0.3s;
        }

        input:checked+.toggle-slider {
            background: linear-gradient(135deg, #4a5568, #2d3748);
        }

        input:checked+.toggle-slider:before {
            transform: translateX(30px);
        }

        /* Icons in toggle */
        .toggle-slider i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            color: white;
            transition: opacity 0.3s;
        }

        .toggle-slider .bx-sun {
            left: 8px;
            opacity: 1;
        }

        .toggle-slider .bx-moon {
            right: 8px;
            opacity: 0;
        }

        input:checked+.toggle-slider .bx-sun {
            opacity: 0;
        }

        input:checked+.toggle-slider .bx-moon {
            opacity: 1;
        }

        /* ===== THEME PREVIEW ===== */
        .theme-preview {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .preview-box {
            flex: 1;
            padding: 30px 20px;
            border-radius: 12px;
            text-align: center;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .preview-box.light {
            background-color: #f8f9fa;
            color: #1a152e;
        }

        .preview-box.dark {
            background-color: #16213e;
            color: #e0e0e0;
        }

        .preview-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px var(--shadow);
        }

        .preview-box.active {
            border-color: #d946ef;
        }

        .preview-box i {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .preview-box h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .preview-box p {
            font-size: 12px;
            opacity: 0.7;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .settings-card {
                padding: 20px;
            }

            .settings-option {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .theme-preview {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- Include Navigation -->
    <?= view('Navigation') ?>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">
        <h1>Settings</h1>

        <div class="settings-container">
            <!-- Appearance Settings -->
            <div class="settings-card">
                <h2><i class='bx bx-palette'></i> Appearance</h2>

                <div class="settings-option">
                    <div class="option-info">
                        <h3>Theme Mode</h3>
                        <p>Switch between light and dark mode</p>
                    </div>
                    <label class="theme-toggle">
                        <input type="checkbox" id="themeToggle">
                        <span class="toggle-slider">
                            <i class='bx bx-sun'></i>
                            <i class='bx bx-moon'></i>
                        </span>
                    </label>
                </div>

                <div class="theme-preview">
                    <div class="preview-box light" onclick="setTheme('light')">
                        <i class='bx bx-sun'></i>
                        <h4>Light Mode</h4>
                        <p>Classic bright theme</p>
                    </div>
                    <div class="preview-box dark" onclick="setTheme('dark')">
                        <i class='bx bx-moon'></i>
                        <h4>Dark Mode</h4>
                        <p>Easy on the eyes</p>
                    </div>
                </div>
            </div>

            <!-- Additional Settings (Optional) -->
            <div class="settings-card">
                <h2><i class='bx bx-info-circle'></i> About</h2>
                <div class="settings-option">
                    <div class="option-info">
                        <h3>Application Version</h3>
                        <p>Expenses Tracker v1.0.0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Theme Management
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
        const previewBoxes = document.querySelectorAll('.preview-box');

        // Load saved theme on page load
        function loadTheme() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
                themeToggle.checked = true;
            }
            updatePreviewSelection(savedTheme);
        }

        // Toggle theme
        themeToggle.addEventListener('change', function() {
            if (this.checked) {
                setTheme('dark');
            } else {
                setTheme('light');
            }
        });

        // Set theme function
        function setTheme(theme) {
            if (theme === 'dark') {
                body.classList.add('dark-mode');
                themeToggle.checked = true;
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.remove('dark-mode');
                themeToggle.checked = false;
                localStorage.setItem('theme', 'light');
            }
            updatePreviewSelection(theme);
        }

        // Update preview box selection
        function updatePreviewSelection(theme) {
            previewBoxes.forEach(box => {
                box.classList.remove('active');
                if ((theme === 'dark' && box.classList.contains('dark')) ||
                    (theme === 'light' && box.classList.contains('light'))) {
                    box.classList.add('active');
                }
            });
        }

        // Initialize theme on page load
        loadTheme();
    </script>
</body>

</html>