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
    /* ===== SIDEBAR ===== */
    .sidebar {
        width: 267px;
        background-color: #2b2639;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        height: 100vh;
        z-index: 1000;
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
        color: #e0e0e0;
        flex-shrink: 0;
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
        color: #ffffff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .profile p {
        font-size: 12px;
        color: #9d9d9d;
        margin: 2px 0 0 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
        color: #b8b8b8;
        text-decoration: none;
        padding: 14px 18px;
        border-radius: 14px;
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        font-size: 15px;
        font-weight: 400;
        transform: scale(1);
    }

    .menu a:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: #e0e0e0;
    }

    .menu a.active {
        background-color: #f0f0f5;
        color: #d946ef;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        padding: 16px 22px;
        font-size: 15.5px;
    }

    .menu a.active i {
        color: #d946ef;
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
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 14px;
    }

    .sidebar-bottom a {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #b8b8b8;
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