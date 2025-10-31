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
        // Get form inputs
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Load UserModel
        $userModel = new \App\Models\UserModel();

        // Find user by email
        $user = $userModel->where('Email', $email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password');
        }

        // Verify password (assuming passwords are hashed)
        // If passwords are stored as plain text (not recommended), use: if ($password !== $user['Password'])
        if (!password_verify($password, $user['Password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password');
        }

        // Set session data with actual user information
        $session = session();
        $session->set([
            'user_id' => $user['UserID'],
            'email' => $user['Email'],
            'full_name' => $user['Username'],
            'logged_in' => true
        ]);

        // Redirect to home
        return redirect()->to('/home');
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
            'username' => 'required|min_length[3]|max_length[255]|is_unique[users.Username]',
            'email' => 'required|valid_email|is_unique[users.Email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ], [
            'username' => [
                'required' => 'Username is required',
                'min_length' => 'Username must be at least 3 characters',
                'is_unique' => 'This username is already taken'
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
            'Username' => $this->request->getPost('username'),
            'Email' => $this->request->getPost('email'),
            'Password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
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
