<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        // Redirect to login by default
        return redirect()->to('/login');
    }

    public function login()
    {
        // Display the login view
        return view('Login');
    }

    public function loginProcess()
    {
        // STATIC MODE - Skip validation and database, just set session and redirect
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Set session data for static display
        $session = session();
        $session->set([
            'user_id' => 1,
            'email' => $email ?: 'user@example.com',
            'full_name' => 'Demo User',
            'logged_in' => true
        ]);

        // Redirect directly to dashboard/home
        return redirect()->to('/dashboard');
    }

    public function signup()
    {
        // Display register view
        return view('Register');
    }

    public function signupProcess()
    {
        // Load UserModel
        $userModel = new \App\Models\UserModel();

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'fullname' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ], [
            'fullname' => [
                'required' => 'Full name is required',
                'min_length' => 'Full name must be at least 3 characters'
            ],
            'email' => [
                'required' => 'Email is required',
                'valid_email' => 'Please provide a valid email',
                'is_unique' => 'This email is already registered'
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 6 characters'
            ],
            'confirm_password' => [
                'required' => 'Please confirm your password',
                'matches' => 'Passwords do not match'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, return to signup with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Prepare user data
        $userData = [
            'full_name' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        // Insert user into database
        try {
            $userModel->insert($userData);
            return redirect()->to('/login')->with('success', 'Account created successfully! Please login.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create account. Please try again.');
        }
    }

    public function logout()
    {
        // Clear session and redirect to login
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully!');
    }
}
