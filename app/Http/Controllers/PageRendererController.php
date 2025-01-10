<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageRendererController extends Controller
{
    public function showSuperAdminBlankPage() : View
    {
        return view('super-admin.blank');
    }
    
    public function showAdminBlankPage() : View
    {
        return view('admin.blank');
    }
}
