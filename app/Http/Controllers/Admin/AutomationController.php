<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AutomationController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function run()
    {
        $exitCode = Artisan::call('automation:run');
        $output = Artisan::output();

        if ($exitCode === 0) {
            return back()->with('status', 'Automation completed successfully.')->with('output', $output);
        } else {
            return back()->with('status', 'Automation failed (Exit Code: ' . $exitCode . ').')->with('output', $output);
        }
    }
}
