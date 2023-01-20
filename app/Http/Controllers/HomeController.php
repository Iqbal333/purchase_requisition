<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\RequestItem;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $request_items = RequestItem::count();
        $user = User::count();
        $division = Division::count();
        $total_request_pending = RequestItem::where('status', '=', 'Pending')->count();

        return view('home', compact('request_items', 'user', 'division', 'total_request_pending'));
    }
}
