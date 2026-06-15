<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function mutuelle()
    {
        return view('pages.mutuelle');
    }

    public function gouvernance()
    {
        return view('pages.gouvernance');
    }

    public function chefferie()
    {
        return view('pages.chefferie');
    }

    public function education()
    {
        return view('pages.education');
    }

    public function jeunesse()
    {
        return view('pages.jeunesse');
    }

    public function cadres()
    {
        return view('pages.cadres');
    }

    public function solidarite()
    {
        return view('pages.solidarite');
    }

    public function projets()
    {
        return view('pages.projets');
    }

    public function transparence()
    {
        return view('pages.transparence');
    }

    public function actualites()
    {
        return view('pages.actualites');
    }

    public function partenaires()
    {
        return view('pages.partenaires');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
