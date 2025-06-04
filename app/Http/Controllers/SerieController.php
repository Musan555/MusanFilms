<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function reproducir($id)
    {
        $serie = Serie::findOrFail($id);
        return view('series.reproducir', compact('serie'));
    }
}
