<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mailbox;

class MailboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Show the dashboard Mailbox.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('mailbox/index');
    }

    /**
     * Show the dashboard Mailbox Compose.
     *
     * @return \Illuminate\Http\Response
     */
    public function compose(Request $request)
    {
        return view('mailbox/compose');
    }

    /**
     * Show the dashboard Single Message.
     *
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {
        return view('mailbox/message');
    }

    
}
