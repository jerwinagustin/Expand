<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'UserID';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'Email',
        'Username',
        'Password'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'Email' => 'required|valid_email|is_unique[users.Email]',
        'Username' => 'required|min_length[3]|is_unique[users.Username]',
        'Password' => 'required|min_length[6]'
    ];
    protected $validationMessages = [
        'Email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please provide a valid email',
            'is_unique' => 'This email is already registered'
        ],
        'Username' => [
            'required' => 'Username is required',
            'min_length' => 'Username must be at least 3 characters',
            'is_unique' => 'This username is already taken'
        ],
        'Password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters'
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash password before saving
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Verify user login credentials
     */
    public function verifyLogin($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Remove password from returned data
            unset($user['password']);
            return $user;
        }

        return false;
    }

    /**
     * Get user by email
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
