<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expense_categories';
    protected $primaryKey = 'CategoryID';
    protected $allowedFields = ['UserID', 'CategoryName', 'Icon', 'Budget', 'Description'];
    protected $useTimestamps = true;
    protected $createdField = 'CreatedAt';
    protected $updatedField = 'UpdatedAt';

    /**
     * Get all expense categories for a user
     */
    public function getCategoriesByUser($userId)
    {
        return $this->where('UserID', $userId)
            ->orderBy('CreatedAt', 'DESC')
            ->findAll();
    }

    /**
     * Get a single category by ID and UserID
     */
    public function getCategoryByIdAndUser($categoryId, $userId)
    {
        return $this->where('CategoryID', $categoryId)
            ->where('UserID', $userId)
            ->first();
    }

    /**
     * Get category with total expenses
     */
    public function getCategoriesWithExpenses($userId, $startDate = null, $endDate = null)
    {
        $builder = $this->db->table('expense_categories');
        $builder->select('expense_categories.*, COALESCE(SUM(expenses.Amount), 0) as TotalSpent');

        if ($startDate && $endDate) {
            $builder->join(
                'expenses',
                'expenses.CategoryID = expense_categories.CategoryID 
                AND expenses.UserID = expense_categories.UserID 
                AND expenses.ExpenseDate >= ' . $this->db->escape($startDate) . ' 
                AND expenses.ExpenseDate <= ' . $this->db->escape($endDate),
                'left'
            );
        } else {
            $builder->join(
                'expenses',
                'expenses.CategoryID = expense_categories.CategoryID 
                AND expenses.UserID = expense_categories.UserID',
                'left'
            );
        }

        $builder->where('expense_categories.UserID', $userId);
        $builder->groupBy('expense_categories.CategoryID');
        $builder->orderBy('expense_categories.CreatedAt', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * Add a new expense category
     */
    public function addCategory($data)
    {
        return $this->insert($data);
    }

    /**
     * Update expense category
     */
    public function updateCategory($categoryId, $userId, $data)
    {
        return $this->where('CategoryID', $categoryId)
            ->where('UserID', $userId)
            ->set($data)
            ->update();
    }

    /**
     * Delete expense category
     */
    public function deleteCategory($categoryId, $userId)
    {
        return $this->where('CategoryID', $categoryId)
            ->where('UserID', $userId)
            ->delete();
    }

    /**
     * Get total budget for user
     */
    public function getTotalBudget($userId)
    {
        $result = $this->selectSum('Budget')
            ->where('UserID', $userId)
            ->first();

        return $result['Budget'] ?? 0;
    }

    /**
     * Get available balance (budget - expenses)
     */
    public function getAvailableBalance($userId, $startDate = null, $endDate = null)
    {
        $totalBudget = $this->getTotalBudget($userId);

        $builder = $this->db->table('expenses');
        $builder->selectSum('Amount');
        $builder->where('UserID', $userId);

        if ($startDate && $endDate) {
            $builder->where('ExpenseDate >=', $startDate);
            $builder->where('ExpenseDate <=', $endDate);
        }

        $result = $builder->get()->getRowArray();
        $totalExpenses = $result['Amount'] ?? 0;

        return $totalBudget - $totalExpenses;
    }
}
