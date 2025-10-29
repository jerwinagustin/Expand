<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        // Load helpers if needed
        helper(['url', 'form']);
    }

    public function index()
    {
        // STATIC MODE - No authentication check, just display the page
        $session = session();

        // Display home view with static or session data
        $data = [
            'title' => 'Dashboard',
            'email' => $session->get('email') ?? 'user@example.com',
            'full_name' => $session->get('full_name') ?? 'Demo User'
        ];

        return view('Home', $data);
    }
}
