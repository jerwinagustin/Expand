<!-- ===== SIDEBAR NAVIGATION ===== -->
<?php
$uri = service('uri');
$segment = $uri->getSegment(1);
if (empty($segment)) {
    $segment = 'dashboard';
}
?>
<div class="sidebar">
    <div class="sidebar-top">
        <div class="profile">
            <i class='bx bxs-user-circle'></i>
            <div>
                <h4><?= session()->get('full_name') ?? 'Kyrene Aguilar' ?></h4>
                <p><?= session()->get('email') ?? 'User' ?></p>
            </div>
        </div>

        <ul class="menu">
            <li>
                <a href="<?= base_url('dashboard') ?>" class="<?= ($segment == 'dashboard') ? 'active' : '' ?>">
                    <i class='bx bxs-home'></i> Home
                </a>
            </li>
            <li>
                <a href="<?= base_url('transaction') ?>" class="<?= ($segment == 'transaction') ? 'active' : '' ?>">
                    <i class='bx bx-line-chart'></i> Transaction
                </a>
            </li>
            <li>
                <a href="<?= base_url('expense') ?>" class="<?= ($segment == 'expense') ? 'active' : '' ?>">
                    <i class='bx bx-wallet'></i> Expense
                </a>
            </li>
            <li>
                <a href="<?= base_url('report') ?>" class="<?= ($segment == 'report') ? 'active' : '' ?>">
                    <i class='bx bxs-report'></i> Report
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-bottom">
        <a href="<?= base_url('settings') ?>" class="setting <?= ($segment == 'settings') ? 'active' : '' ?>">
            <i class='bx bx-cog'></i> Setting
        </a>
        <a href="<?= base_url('logout') ?>" class="logout"><i class='bx bx-log-out'></i> Log Out</a>
    </div>
</div>

<style>
    :root {
        /* Light mode sidebar */
        --sidebar-bg: #2b2639;
        --sidebar-text: white;
        --sidebar-text-muted: #b8b8b8;
        --sidebar-hover-bg: rgba(255, 255, 255, 0.05);
        --sidebar-active-bg: #f0f0f5;
        --sidebar-active-text: #d946ef;
        --sidebar-border: rgba(255, 255, 255, 0.1);
        --profile-icon: #e0e0e0;
        --profile-text: #ffffff;
        --profile-email: #9d9d9d;
    }

    body.dark-mode {
        /* Dark mode sidebar */
        --sidebar-bg: #0f0f1e;
        --sidebar-text: #e0e0e0;
        --sidebar-text-muted: #8a8a8a;
        --sidebar-hover-bg: rgba(255, 255, 255, 0.1);
        --sidebar-active-bg: #1a1a2e;
        --sidebar-active-text: #bb86fc;
        --sidebar-border: rgba(255, 255, 255, 0.05);
        --profile-icon: #bb86fc;
        --profile-text: #e0e0e0;
        --profile-email: #8a8a8a;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
        width: 267px;
        background-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        height: 100vh;
        z-index: 1000;
        transition: background-color 0.3s ease;
    }

    .sidebar-top {
        padding: 30px 20px;
    }

    .profile {
        text-align: left;
        margin-bottom: 50px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .profile i {
        font-size: 48px;
        color: var(--profile-icon);
        flex-shrink: 0;
        transition: color 0.3s ease;
    }

    .profile div {
        flex: 1;
        min-width: 0;
        overflow: hidden;
    }

    .profile h4 {
        font-size: 16px;
        margin: 0;
        font-weight: 600;
        color: var(--profile-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.3s ease;
    }

    .profile p {
        font-size: 12px;
        color: var(--profile-email);
        margin: 2px 0 0 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.3s ease;
    }

    .menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu li {
        margin-bottom: 6px;
    }

    .menu a {
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--sidebar-text-muted);
        text-decoration: none;
        padding: 14px 18px;
        border-radius: 14px;
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        font-size: 15px;
        font-weight: 400;
        transform: scale(1);
    }

    .menu a:hover {
        background-color: var(--sidebar-hover-bg);
        color: #e0e0e0;
    }

    .menu a.active {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        padding: 16px 22px;
        font-size: 15.5px;
    }

    .menu a.active i {
        color: var(--sidebar-active-text);
        transform: scale(1.1);
    }

    .menu i {
        font-size: 22px;
        width: 22px;
        text-align: center;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-bottom {
        padding: 15px 20px 30px;
        border-top: 1px solid var(--sidebar-border);
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .sidebar-bottom a {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--sidebar-text-muted);
        text-decoration: none;
        margin-bottom: 8px;
        padding: 10px 12px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .sidebar-bottom a:hover {
        color: #d946ef;
        background-color: rgba(217, 70, 239, 0.1);
    }

    .sidebar-bottom a.active {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
    }

    .sidebar-bottom a i {
        font-size: 20px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            flex-direction: row;
            padding: 15px;
        }

        .sidebar-top {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile {
            margin-bottom: 0;
        }

        .menu {
            display: flex;
            gap: 10px;
        }
    }

    /* ===== CLICK ANIMATION ===== */
    @keyframes scaleIn {
        0% {
            transform: scale(0.95);
        }

        50% {
            transform: scale(1.08);
        }

        100% {
            transform: scale(1.05);
        }
    }

    @keyframes scaleOut {
        0% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .menu a.active {
        animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }
</style>

<script>
    // Load theme on page load
    (function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }
    })();

    // Add click animation effect
    document.addEventListener('DOMContentLoaded', function() {
        const menuLinks = document.querySelectorAll('.menu a');

        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all links
                menuLinks.forEach(l => {
                    if (l.classList.contains('active') && l !== link) {
                        l.style.animation = 'scaleOut 0.3s ease-out forwards';
                    }
                });

                // Add scale animation to clicked link
                if (!link.classList.contains('active')) {
                    link.style.animation = 'scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards';
                }
            });
        });
    });
</script>