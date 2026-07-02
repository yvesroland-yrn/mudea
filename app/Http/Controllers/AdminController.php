<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function actualites()
    {
        return redirect()->route('admin.actualites.index');
    }

    public function pages()
    {
        return view('admin.pages');
    }

    public function vieCoutumes()
    {
        return view('admin.vie-coutumes');
    }

    public function education()
    {
        return view('admin.education');
    }

    public function communaute()
    {
        return view('admin.communaute');
    }

    public function bureau()
    {
        return view('admin.bureau');
    }

    public function projets()
    {
        return view('admin.projets');          
    }

    public function messages()
    {
        return view('admin.messages');
    }

    public function utilisateurs()
    {
        return view('admin.utilisateurs');
    }

    public function parametres()
    {
        return view('admin.parametres');
    }

    public function statistiques()
    {
        return view('admin.statistiques');
    }
}
