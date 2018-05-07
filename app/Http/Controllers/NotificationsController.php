<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Show the dashboard Notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('notifications/index');
    }

    /**
     * Show the dashboard Notification Compose.
     *
     * @return \Illuminate\Http\Response
     */
    public function compose(Request $request)
    {
        return view('notifications/compose');
    }

    /**
     * Show the dashboard Single Notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification(Request $request)
    {
        return view('notifications/notification');
    }

    
}
