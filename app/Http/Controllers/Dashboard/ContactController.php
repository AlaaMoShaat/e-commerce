<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        Cache::forget('contacts_count');
        return view('dashboard.contacts.index');
    }
}
