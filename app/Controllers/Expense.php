<?php

namespace App\Controllers;

use App\Models\ExpenseModel;
use App\Models\WalletModel;

class Expense extends BaseController
{
    protected $expenseModel;
    protected $walletModel;
    protected $session;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
        $this->walletModel = new WalletModel();
        $this->session = \Config\Services::session();
    }

    /**
     * Display expense page
     */
    public function index()
    {
        // Check if user is logged in
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');

        // Get date range from request or use default
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        // Debug: Log the query
        log_message('debug', 'Getting categories for user: ' . $userId);
        log_message('debug', 'Date range: ' . $startDate . ' to ' . $endDate);

        // Get categories with expenses
        $categories = $this->expenseModel->getCategoriesWithExpenses($userId, $startDate, $endDate);

        log_message('debug', 'Categories found: ' . count($categories));
        log_message('debug', 'Categories data: ' . json_encode($categories));

        // Get available balance from wallet
        $availableBalance = $this->walletModel->getAvailableBalance($userId, $startDate);

        $data = [
            'categories' => $categories,
            'availableBalance' => $availableBalance,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('Expense', $data);
    }
    /**
     * Add new expense category
     */
    public function addCategory()
    {
        // Enable error reporting for debugging
        log_message('debug', 'addCategory method called');

        if (!$this->session->get('logged_in')) {
            log_message('debug', 'User not logged in');
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');
        log_message('debug', 'User ID: ' . $userId);

        // Log all POST data
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

        $rules = [
            'categoryName' => 'required|min_length[3]|max_length[100]',
            'budget' => 'required|decimal',
            'icon' => 'permit_empty|max_length[50]',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            log_message('debug', 'Validation failed: ' . json_encode($this->validator->getErrors()));
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'UserID' => $userId,
            'CategoryName' => $this->request->getPost('categoryName'),
            'Budget' => $this->request->getPost('budget'),
            'Icon' => $this->request->getPost('icon') ?: 'bx-wallet',
            'Description' => $this->request->getPost('description')
        ];

        log_message('debug', 'Data to insert: ' . json_encode($data));

        try {
            $insertId = $this->expenseModel->addCategory($data);
            log_message('debug', 'Insert ID: ' . $insertId);

            if ($insertId) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Category added successfully',
                    'categoryId' => $insertId
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Database error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to add category'
        ]);
    }

    /**
     * Get single category
     */
    public function getCategory($categoryId)
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');
        $category = $this->expenseModel->getCategoryByIdAndUser($categoryId, $userId);

        if ($category) {
            return $this->response->setJSON([
                'success' => true,
                'category' => $category
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Category not found'
        ]);
    }

    /**
     * Update expense category
     */
    public function updateCategory($categoryId)
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');

        $rules = [
            'categoryName' => 'required|min_length[3]|max_length[100]',
            'budget' => 'required|decimal',
            'icon' => 'permit_empty|max_length[50]',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'CategoryName' => $this->request->getPost('categoryName'),
            'Budget' => $this->request->getPost('budget'),
            'Icon' => $this->request->getPost('icon') ?: 'bx-wallet',
            'Description' => $this->request->getPost('description')
        ];

        try {
            if ($this->expenseModel->updateCategory($categoryId, $userId, $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Category updated successfully'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update category'
        ]);
    }

    /**
     * Delete expense category
     */
    public function deleteCategory($categoryId)
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');

        if ($this->expenseModel->deleteCategory($categoryId, $userId)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Category deleted successfully'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to delete category'
        ]);
    }

    /**
     * Get all categories as JSON
     */
    public function getCategories()
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        $categories = $this->expenseModel->getCategoriesWithExpenses($userId, $startDate, $endDate);
        $availableBalance = $this->expenseModel->getAvailableBalance($userId, $startDate, $endDate);

        return $this->response->setJSON([
            'success' => true,
            'categories' => $categories,
            'availableBalance' => $availableBalance
        ]);
    }

    /**
     * Add actual expense (record spending)
     */
    public function addExpense()
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');

        $rules = [
            'categoryId' => 'required|integer',
            'amount' => 'required|decimal|greater_than[0]',
            'expenseDate' => 'required|valid_date',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $categoryId = $this->request->getPost('categoryId');
        $amount = $this->request->getPost('amount');
        $expenseDate = $this->request->getPost('expenseDate');
        $description = $this->request->getPost('description');

        try {
            $db = \Config\Database::connect();

            // Insert into expenses table
            $expenseData = [
                'CategoryID' => $categoryId,
                'UserID' => $userId,
                'Amount' => $amount,
                'ExpenseDate' => $expenseDate,
                'Description' => $description
            ];

            $builder = $db->table('expenses');
            if ($builder->insert($expenseData)) {
                $expenseId = $db->insertID();

                // Also insert into transactions table
                $transactionData = [
                    'UserID' => $userId,
                    'Type' => 'expense',
                    'Amount' => $amount,
                    'CategoryID' => $categoryId,
                    'Description' => $description,
                    'TransactionDate' => $expenseDate
                ];

                $db->table('transactions')->insert($transactionData);

                // Deduct from wallet balance
                $walletModel = new \App\Models\WalletModel();
                $month = date('Y-m-01', strtotime($expenseDate));
                $walletModel->deductFromBalance($userId, $amount, $month);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Expense recorded successfully',
                    'expenseId' => $expenseId
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to record expense'
        ]);
    }

    /**
     * Test database connection and insert
     */
    public function test()
    {
        if (!$this->session->get('logged_in')) {
            return 'Please login first';
        }

        $userId = $this->session->get('user_id');

        echo "<h2>Database Test</h2>";
        echo "<p>User ID: " . $userId . "</p>";

        // Test database connection
        $db = \Config\Database::connect();
        echo "<p>Database connected: " . ($db->connID ? 'YES' : 'NO') . "</p>";

        // Check if table exists
        if ($db->tableExists('expense_categories')) {
            echo "<p>Table 'expense_categories' exists: YES</p>";
        } else {
            echo "<p>Table 'expense_categories' exists: NO</p>";
        }

        // Check all categories for this user
        echo "<h3>All categories in database for this user:</h3>";
        $allCategories = $this->expenseModel->where('UserID', $userId)->findAll();
        echo "<pre>" . json_encode($allCategories, JSON_PRETTY_PRINT) . "</pre>";

        echo "<h3>Categories count: " . count($allCategories) . "</h3>";

        // Try to insert a test record
        $testData = [
            'UserID' => $userId,
            'CategoryName' => 'Test Category',
            'Budget' => 1000.00,
            'Icon' => 'bx-test',
            'Description' => 'Test description'
        ];

        echo "<p>Attempting to insert test data...</p>";
        try {
            $insertId = $this->expenseModel->insert($testData);
            if ($insertId) {
                echo "<p style='color: green;'>✓ Insert successful! ID: " . $insertId . "</p>";

                // Try to read it back
                $category = $this->expenseModel->find($insertId);
                echo "<p>Retrieved data: " . json_encode($category) . "</p>";

                // Delete test record
                $this->expenseModel->delete($insertId);
                echo "<p>Test record deleted</p>";
            } else {
                echo "<p style='color: red;'>✗ Insert failed</p>";
                echo "<p>Errors: " . json_encode($this->expenseModel->errors()) . "</p>";
            }
        } catch (\Exception $e) {
            echo "<p style='color: red;'>✗ Exception: " . $e->getMessage() . "</p>";
        }
    }
}
