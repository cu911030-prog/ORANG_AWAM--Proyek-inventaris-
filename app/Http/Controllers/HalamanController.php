<?php

namespace App\Http\Controllers;

class HalamanController extends Controller
{
    public function dashboard()
    {
        $ringkasan = ['materi' => 7, 'tugas' => 3, 'kuis' => 2];
        return view('dashboard', compact('ringkasan'));
    }

    public function jadwal(string $hari)
    {
        return "Jadwal kuliah hari {$hari}";
    }
}