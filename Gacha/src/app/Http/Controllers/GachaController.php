<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gacha;

class GachaController extends Controller
{
    public function index()
    {
        $Wrap = DB::table('gachas')->inRandomOrder()->first('name');
        return view('gacha.index', compact('Wrap'));
    }
}
