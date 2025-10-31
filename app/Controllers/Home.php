<?php

namespace App\Controllers;

use App\Models\WalletModel;
use App\Models\ExpenseModel;

class Home extends BaseController
{
    protected $walletModel;
    protected $expenseModel;
    protected $session;

    public function __construct()
    {
        $this->walletModel = new WalletModel();
        $this->expenseModel = new ExpenseModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        $currentMonth = date('Y-m-01');

        // Get wallet balance
        $walletBalance = $this->walletModel->getCurrentMonthBalance($userId);

        // Get available balance (wallet - expenses)
        $availableBalance = $this->walletModel->getAvailableBalance($userId, $currentMonth);

        // Get total expenses for current month
        $db = \Config\Database::connect();
        $builder = $db->table('expenses');
        $builder->selectSum('Amount');
        $builder->where('UserID', $userId);
        $builder->where('ExpenseDate >=', date('Y-m-01'));
        $builder->where('ExpenseDate <=', date('Y-m-t'));
        $totalExpenses = $builder->get()->getRowArray()['Amount'] ?? 0;

        $data = [
            'walletBalance' => $walletBalance,
            'availableBalance' => $availableBalance,
            'totalExpenses' => $totalExpenses,
            'currentMonth' => date('F Y')
        ];

        return view('Home', $data);
    }

    /**
     * Add monthly balance
     */
    public function addBalance()
    {
        if (!$this->session->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');

        $rules = [
            'amount' => 'required|decimal|greater_than[0]',
            'month' => 'permit_empty|valid_date',
            'description' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $amount = $this->request->getPost('amount');
        $month = $this->request->getPost('month') ?: date('Y-m-01');
        $description = $this->request->getPost('description');

        try {
            if ($this->walletModel->setMonthlyBalance($userId, $amount, $month, $description)) {
                // Also create an income transaction
                $db = \Config\Database::connect();
                $transactionData = [
                    'UserID' => $userId,
                    'Type' => 'income',
                    'Amount' => $amount,
                    'Description' => $description ?: 'Monthly Balance',
                    'TransactionDate' => $month
                ];
                $db->table('transactions')->insert($transactionData);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Balance added successfully'
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
            'message' => 'Failed to add balance'
        ]);
    }
}
