<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function store(Request $request)
    {
        Access::create([
            'accessed_at' => now(),
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with(['message' => 'Prezenta a fost realizata cu succes']);
    }
}
