<?php

namespace App\Controllers;

use App\Models\WalletModel;

class Pages extends BaseController
{
    protected $walletModel;
    protected $session;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
        $this->session = \Config\Services::session();
    }

    public function transaction()
    {
        // Check if user is logged in
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        $currentMonth = date('Y-m-01');

        // Get available balance
        $availableBalance = $this->walletModel->getAvailableBalance($userId, $currentMonth);

        // Get all transactions for the user
        $db = \Config\Database::connect();
        $builder = $db->table('transactions t');
        $builder->select('t.*, ec.CategoryName, ec.Icon');
        $builder->join('expense_categories ec', 'ec.CategoryID = t.CategoryID', 'left');
        $builder->where('t.UserID', $userId);
        $builder->orderBy('t.TransactionDate', 'DESC');
        $builder->orderBy('t.CreatedAt', 'DESC');
        $transactions = $builder->get()->getResultArray();

        $data = [
            'availableBalance' => $availableBalance,
            'transactions' => $transactions
        ];

        return view('Transaction', $data);
    }

    public function expense()
    {
        return view('Expense');
    }

    public function report()
    {
        // Check if user is logged in
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        $currentMonth = date('Y-m-01');

        // Get available balance
        $availableBalance = $this->walletModel->getAvailableBalance($userId, $currentMonth);

        // Get expense categories with spending
        $db = \Config\Database::connect();

        // Get categories with their budgets and actual spending
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        $builder = $db->table('expense_categories ec');
        $builder->select('ec.CategoryID, ec.CategoryName, ec.Budget, ec.Icon, COALESCE(SUM(e.Amount), 0) as TotalSpent');
        $builder->join('expenses e', 'e.CategoryID = ec.CategoryID AND e.UserID = ' . $userId . ' AND e.ExpenseDate >= "' . $startDate . '" AND e.ExpenseDate <= "' . $endDate . '"', 'left');
        $builder->where('ec.UserID', $userId);
        $builder->groupBy('ec.CategoryID, ec.CategoryName, ec.Budget, ec.Icon');
        $builder->orderBy('ec.CategoryName', 'ASC');
        $categories = $builder->get()->getResultArray();

        // Get monthly expense trends (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m-01', strtotime("-$i months"));
            $monthEnd = date('Y-m-t', strtotime($month));

            $builder = $db->table('expenses');
            $builder->selectSum('Amount');
            $builder->where('UserID', $userId);
            $builder->where('ExpenseDate >=', $month);
            $builder->where('ExpenseDate <=', $monthEnd);
            $result = $builder->get()->getRowArray();

            $amount = $result['Amount'] ?? 0;

            $monthlyData[] = [
                'month' => date('M', strtotime($month)),
                'amount' => $amount
            ];

            // Debug logging
            log_message('debug', "Month: $month | Amount: $amount");
        }

        // Get total budget and total spent
        $totalBudget = array_sum(array_column($categories, 'Budget'));
        $totalSpent = array_sum(array_column($categories, 'TotalSpent'));

        $data = [
            'availableBalance' => $availableBalance,
            'categories' => $categories,
            'monthlyData' => $monthlyData,
            'totalBudget' => $totalBudget,
            'totalSpent' => $totalSpent,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('Report', $data);
    }

    public function settings()
    {
        return view('Settings');
    }
}
