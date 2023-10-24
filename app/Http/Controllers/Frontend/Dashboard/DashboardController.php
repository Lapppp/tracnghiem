<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class DashboardController extends FrontendController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  index(Request $request)
    {
        return view('components.frontend.dashboard.index');
    }
}
