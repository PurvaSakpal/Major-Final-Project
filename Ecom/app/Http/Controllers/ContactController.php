<?php

namespace App\Http\Controllers;

use App\Mail\SendReplyToContact;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\SentReply;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Show contact Details
    public function ShowContactDetails()
    {
        $contactus = ContactUs::orderBy('created_at', 'desc')->paginate(10);
        return view('Contact.ShowContactDetails', compact('contactus'));
    }

    //Send Reply
    public function ReplyContact($id)
    {
        $contactinfo = ContactUs::whereId($id)->first();
        return view('Contact.ReplyContact', compact('contactinfo'));
    }

    public function SendReplyToContact(Request $req)
    {
        $validate = $req->validate([
            'to' => 'required|email',
            'msg' => 'required|min:2'
        ]);
        if ($validate) {
            $reply = new SentReply();
            $reply->email = $req->to;
            $reply->message = $req->msg;
            $reply->save();
            Mail::to($req->to)->send(new SendReplyToContact($req->all()));
            return redirect('/contact/showcontactdetails')->withSuccess('Reply sent successfully');
        }
    }
}
