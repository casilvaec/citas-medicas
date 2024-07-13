<?php
// app/Http/Controllers/Admin/RpuController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RpuController extends Controller
{
    public function index()
    {
        return view('admin.rpu.index');
    }
}
