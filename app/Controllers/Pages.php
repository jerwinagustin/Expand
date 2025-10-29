<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function transaction()
    {
        return view('Transaction');
    }

    public function expense()
    {
        return view('Expense');
    }

    public function report()
    {
        return view('Report');
    }

    public function settings()
    {
        return view('Settings');
    }
}
