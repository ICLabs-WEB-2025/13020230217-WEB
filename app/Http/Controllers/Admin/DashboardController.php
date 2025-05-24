<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;

class DashboardController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::with('jadwal')->get(); // Sesuaikan dengan relasi model Anda
        return view('admin.dashboard', compact('lapangans'));
    }
}