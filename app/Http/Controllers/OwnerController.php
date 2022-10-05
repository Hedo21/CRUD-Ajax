<?php

namespace App\Http\Controllers;

use App\Models\kopi;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function create()
    {
        $owners = Owner::all();
        return view('/kopi/list/tambah', compact('owners'));
    }
}
