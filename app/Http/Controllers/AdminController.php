<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin.category.index', );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    public function triggerSeeder()
    {
        $adminSeeder = new \Database\Seeders\AdminSeeder;
        $adminSeeder->run();
        return redirect('/');
    }
}
