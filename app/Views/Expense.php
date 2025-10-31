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
        :root {
            /* Light mode colors */
            --bg-primary: #f1f1f1;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f5f5f5;
            --text-primary: #222;
            --text-secondary: #666;
            --text-muted: #333;
            --border-color: #e0e0e0;
            --shadow: rgba(0, 0, 0, 0.08);
            --shadow-hover: rgba(0, 0, 0, 0.1);
        }

        body.dark-mode {
            /* Dark mode colors */
            --bg-primary: #1a1a2e;
            --bg-secondary: #16213e;
            --bg-tertiary: #0d1421;
            --text-primary: #f0f0f0;
            --text-secondary: #c0c0c0;
            --text-muted: #a8a8a8;
            --border-color: #2d3748;
            --shadow: rgba(0, 0, 0, 0.3);
            --shadow-hover: rgba(0, 0, 0, 0.5);
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
            background-color: var(--bg-secondary);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px var(--shadow);
            width: 100%;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
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
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
        }

        .expense-item.active {
            background: linear-gradient(135deg, #d94fff, #9c4fff);
            border: none;
            color: white;
        }

        .expense-item:hover {
            box-shadow: 0 4px 12px var(--shadow-hover);
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
            background-color: var(--bg-tertiary);
            transition: background-color 0.3s ease;
            color: var(--text-primary);
        }

        body.dark-mode .expense-icon {
            border: 1px solid var(--border-color);
        }

        .expense-item.active .expense-icon {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
        }

        .expense-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 4px 0;
            color: var(--text-primary);
            transition: color 0.3s ease;
        }

        .expense-item.active .expense-details h3,
        .expense-item.active .expense-details p {
            color: white;
        }

        .expense-details p {
            font-size: 13px;
            margin: 0;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .expense-menu {
            position: relative;
        }

        .menu-dots {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-secondary);
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
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
            background: var(--bg-secondary);
            border-radius: 8px;
            box-shadow: 0 4px 12px var(--shadow-hover);
            padding: 8px 0;
            min-width: 120px;
            z-index: 1000;
            display: none;
            border: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }

        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-menu-custom a {
            display: block;
            padding: 10px 20px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .dropdown-menu-custom a:hover {
            background-color: var(--bg-tertiary);
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
            color: var(--text-secondary);
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(90deg);
            transition: color 0.3s ease;
        }

        .menu-btn:hover {
            color: #9c4fff;
        }

        .add-btn-visible {
            background-color: var(--bg-tertiary);
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-primary);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .add-btn-visible:hover {
            background-color: var(--border-color);
        }

        .add-btn {
            background-color: transparent;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-primary);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: var(--bg-tertiary);
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
                    <h2>₱ <?= number_format($availableBalance ?? 0, 2) ?></h2>
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
                    <a href="#" class="add-btn" onclick="showAddModal(event)">Add</a>
                    <a href="#" class="add-btn" onclick="showExpendModal(event)">Expend</a>
                </div>
            </div>
        </div>

        <div class="wallet-section">
            <span class="wallet-label">Expense</span>

            <div class="wallet-card">
                <div class="expense-list" id="expenseList">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $index => $category): ?>
                            <div class="expense-item <?= $index === 0 ? 'active' : '' ?>" data-category-id="<?= $category['CategoryID'] ?>">
                                <div class="expense-left">
                                    <div class="expense-icon">
                                        <i class='bx <?= esc($category['Icon']) ?>'></i>
                                    </div>
                                    <div class="expense-details">
                                        <h3><?= esc(strtoupper($category['CategoryName'])) ?></h3>
                                        <p>Budget: ₱<?= number_format($category['Budget'], 2) ?> | Spent: ₱<?= number_format($category['TotalSpent'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="expense-menu">
                                    <button class="menu-dots" onclick="toggleDropdown(event, 'menu<?= $category['CategoryID'] ?>')">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <div class="dropdown-menu-custom" id="menu<?= $category['CategoryID'] ?>">
                                        <a href="#" onclick="editCategory(event, <?= $category['CategoryID'] ?>)">Edit</a>
                                        <a href="#" onclick="deleteCategory(event, <?= $category['CategoryID'] ?>)">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4" style="color: var(--text-secondary);">
                            <i class='bx bx-wallet' style="font-size: 48px;"></i>
                            <p>No expense categories yet. Click "Add" to create one.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== DATE FILTER ===== -->
            <div class="wallet-date">
                <div class="date-range">
                    <i class='bx bx-calendar'></i>
                    <input type="date" id="from-date" value="<?= esc($startDate ?? date('Y-m-01')) ?>" onchange="filterByDate()">
                    <span>To</span>
                    <i class='bx bx-calendar'></i>
                    <input type="date" id="to-date" value="<?= esc($endDate ?? date('Y-m-t')) ?>" onchange="filterByDate()">
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: var(--bg-secondary); color: var(--text-primary); border: 1px solid var(--border-color);">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <h5 class="modal-title" id="categoryModalLabel">Add Expense Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <input type="hidden" id="categoryId" name="categoryId">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" required
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">
                        </div>
                        <div class="mb-3">
                            <label for="budget" class="form-label">Budget (₱)</label>
                            <input type="number" step="0.01" class="form-control" id="budget" name="budget" required
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon (Boxicons class)</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="e.g., bx-restaurant"
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">
                            <small class="form-text" style="color: var(--text-secondary);">Browse icons at <a href="https://boxicons.com/" target="_blank" style="color: #9c4fff;">boxicons.com</a></small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveCategory()" style="background: linear-gradient(135deg, #d94fff, #9c4fff); border: none;">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Expend Modal -->
    <div class="modal fade" id="expendModal" tabindex="-1" aria-labelledby="expendModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: var(--bg-secondary); color: var(--text-primary); border: 1px solid var(--border-color);">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <h5 class="modal-title" id="expendModalLabel">Record Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="expendForm">
                        <div class="mb-3">
                            <label for="expenseCategory" class="form-label">Category</label>
                            <select class="form-select" id="expenseCategory" name="categoryId" required
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">
                                <option value="">Select a category</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['CategoryID'] ?>"><?= esc($cat['CategoryName']) ?> (Budget: ₱<?= number_format($cat['Budget'], 2) ?>)</option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="expenseAmount" class="form-label">Amount (₱)</label>
                            <input type="number" step="0.01" class="form-control" id="expenseAmount" name="amount" required
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">
                        </div>
                        <div class="mb-3">
                            <label for="expenseDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="expenseDate" name="expenseDate" value="<?= date('Y-m-d') ?>" required
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);">
                        </div>
                        <div class="mb-3">
                            <label for="expenseDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="expenseDescription" name="description" rows="2"
                                style="background-color: var(--bg-tertiary); color: var(--text-primary); border: 1px solid var(--border-color);"
                                placeholder="What did you spend on?"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveExpense()" style="background: linear-gradient(135deg, #d94fff, #9c4fff); border: none;">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Base URL for AJAX requests
        const baseUrl = '<?= base_url() ?>';
        const csrfToken = '<?= csrf_token() ?>';
        const csrfHash = '<?= csrf_hash() ?>';

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

        // Show add modal
        function showAddModal(event) {
            event.preventDefault();
            document.getElementById('categoryModalLabel').textContent = 'Add Expense Category';
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryId').value = '';
            const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
            modal.show();
        }

        // Show expend modal
        function showExpendModal(event) {
            event.preventDefault();
            document.getElementById('expendForm').reset();
            const modal = new bootstrap.Modal(document.getElementById('expendModal'));
            modal.show();
        }

        // Save expense (expend)
        function saveExpense() {
            const formData = new FormData();

            const categoryId = document.getElementById('expenseCategory').value;
            const amount = document.getElementById('expenseAmount').value;
            const expenseDate = document.getElementById('expenseDate').value;
            const description = document.getElementById('expenseDescription').value;

            if (!categoryId || !amount || !expenseDate) {
                alert('Please fill in all required fields');
                return;
            }

            console.log('Expense Data:', {
                categoryId,
                amount,
                expenseDate,
                description
            });

            formData.append('categoryId', categoryId);
            formData.append('amount', amount);
            formData.append('expenseDate', expenseDate);
            formData.append('description', description);
            formData.append(csrfToken, csrfHash);

            fetch(`${baseUrl}/expense/addExpense`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        alert(data.message);
                        bootstrap.Modal.getInstance(document.getElementById('expendModal')).hide();

                        // Preserve date filters when reloading
                        const startDate = document.getElementById('from-date').value;
                        const endDate = document.getElementById('to-date').value;
                        window.location.href = `${baseUrl}/expense?start_date=${startDate}&end_date=${endDate}`;
                    } else {
                        alert(data.message || 'Operation failed');
                        if (data.errors) {
                            console.error('Validation errors:', data.errors);
                            alert('Validation errors: ' + JSON.stringify(data.errors));
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving expense: ' + error.message);
                });
        }

        // Edit category
        function editCategory(event, categoryId) {
            event.preventDefault();

            fetch(`${baseUrl}/expense/get/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('categoryModalLabel').textContent = 'Edit Expense Category';
                        document.getElementById('categoryId').value = data.category.CategoryID;
                        document.getElementById('categoryName').value = data.category.CategoryName;
                        document.getElementById('budget').value = data.category.Budget;
                        document.getElementById('icon').value = data.category.Icon;
                        document.getElementById('description').value = data.category.Description || '';

                        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
                        modal.show();
                    } else {
                        alert('Failed to load category details');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while loading category details');
                });
        }

        // Save category (add or update)
        function saveCategory() {
            const categoryId = document.getElementById('categoryId').value;
            const formData = new FormData();

            const categoryName = document.getElementById('categoryName').value;
            const budget = document.getElementById('budget').value;
            const icon = document.getElementById('icon').value || 'bx-wallet';
            const description = document.getElementById('description').value;

            console.log('Form Data:', {
                categoryName,
                budget,
                icon,
                description
            });

            formData.append('categoryName', categoryName);
            formData.append('budget', budget);
            formData.append('icon', icon);
            formData.append('description', description);
            formData.append(csrfToken, csrfHash);

            const url = categoryId ? `${baseUrl}/expense/update/${categoryId}` : `${baseUrl}/expense/add`;
            console.log('Submitting to URL:', url);

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        alert(data.message);
                        bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide();

                        // Preserve date filters when reloading
                        const startDate = document.getElementById('from-date').value;
                        const endDate = document.getElementById('to-date').value;
                        window.location.href = `${baseUrl}/expense?start_date=${startDate}&end_date=${endDate}`;
                    } else {
                        alert(data.message || 'Operation failed');
                        if (data.errors) {
                            console.error('Validation errors:', data.errors);
                            alert('Validation errors: ' + JSON.stringify(data.errors));
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving category: ' + error.message);
                });
        }

        // Delete category
        function deleteCategory(event, categoryId) {
            event.preventDefault();

            if (!confirm('Are you sure you want to delete this category? All associated expenses will also be deleted.')) {
                return;
            }

            const formData = new FormData();
            formData.append(csrfToken, csrfHash);

            fetch(`${baseUrl}/expense/delete/${categoryId}`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);

                        // Preserve date filters when reloading
                        const startDate = document.getElementById('from-date').value;
                        const endDate = document.getElementById('to-date').value;
                        window.location.href = `${baseUrl}/expense?start_date=${startDate}&end_date=${endDate}`;
                    } else {
                        alert(data.message || 'Failed to delete category');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting category');
                });
        }

        // Filter by date range
        function filterByDate() {
            const startDate = document.getElementById('from-date').value;
            const endDate = document.getElementById('to-date').value;

            if (startDate && endDate) {
                window.location.href = `${baseUrl}/expense?start_date=${startDate}&end_date=${endDate}`;
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                menu.classList.remove('show');
            });
        });

        // Add click handler for expense items to toggle active state
        document.querySelectorAll('.expense-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't toggle if clicking on menu
                if (e.target.closest('.expense-menu')) return;

                // Remove active from all items
                document.querySelectorAll('.expense-item').forEach(i => i.classList.remove('active'));
                // Add active to clicked item
                this.classList.add('active');
            });
        });
    </script>

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