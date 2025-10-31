<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table = 'wallet';
    protected $primaryKey = 'WalletID';
    protected $allowedFields = ['UserID', 'Balance', 'Month', 'Description'];
    protected $useTimestamps = true;
    protected $createdField = 'CreatedAt';
    protected $updatedField = 'UpdatedAt';

    /**
     * Get wallet balance for current month
     */
    public function getCurrentMonthBalance($userId)
    {
        $currentMonth = date('Y-m-01');

        $wallet = $this->where('UserID', $userId)
            ->where('Month', $currentMonth)
            ->first();

        return $wallet ? $wallet['Balance'] : 0;
    }

    /**
     * Get wallet for specific month
     */
    public function getWalletByMonth($userId, $month)
    {
        return $this->where('UserID', $userId)
            ->where('Month', $month)
            ->first();
    }

    /**
     * Add or update wallet balance for a month
     */
    public function setMonthlyBalance($userId, $amount, $month = null, $description = null)
    {
        if (!$month) {
            $month = date('Y-m-01');
        }

        // Check if wallet already exists for this month
        $existing = $this->getWalletByMonth($userId, $month);

        if ($existing) {
            // Add to existing balance instead of replacing
            $newBalance = $existing['Balance'] + $amount;
            return $this->update($existing['WalletID'], [
                'Balance' => $newBalance,
                'Description' => $description
            ]);
        } else {
            // Insert new
            return $this->insert([
                'UserID' => $userId,
                'Balance' => $amount,
                'Month' => $month,
                'Description' => $description
            ]);
        }
    }

    /**
     * Get available balance (just return wallet balance, as it's already adjusted)
     */
    public function getAvailableBalance($userId, $month = null)
    {
        if (!$month) {
            $month = date('Y-m-01');
        }

        // Get wallet balance (already reflects all additions and deductions)
        $wallet = $this->getWalletByMonth($userId, $month);
        return $wallet ? $wallet['Balance'] : 0;
    }

    /**
     * Deduct amount from wallet balance (when expense is recorded)
     */
    public function deductFromBalance($userId, $amount, $month = null)
    {
        if (!$month) {
            $month = date('Y-m-01');
        }

        $wallet = $this->getWalletByMonth($userId, $month);

        if ($wallet) {
            $newBalance = $wallet['Balance'] - $amount;
            return $this->update($wallet['WalletID'], [
                'Balance' => $newBalance
            ]);
        }

        return false;
    }

    /**
     * Get all wallet records for a user
     */
    public function getUserWallets($userId, $limit = 12)
    {
        return $this->where('UserID', $userId)
            ->orderBy('Month', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get total income from wallet
     */
    public function getTotalIncome($userId, $startDate = null, $endDate = null)
    {
        $builder = $this->builder();
        $builder->selectSum('Balance');
        $builder->where('UserID', $userId);

        if ($startDate && $endDate) {
            $builder->where('Month >=', $startDate);
            $builder->where('Month <=', $endDate);
        }

        $result = $builder->get()->getRowArray();
        return $result['Balance'] ?? 0;
    }
}
