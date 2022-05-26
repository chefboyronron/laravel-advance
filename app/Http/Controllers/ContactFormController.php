<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactFormController extends Controller {
 
    public function create()
    {
        return view('contact.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        
        /**
         * Send Email
         * php artisan make:mail ContactFormMail --markdown=emails.contact.contact-form
         * Mailable class: app/Mail/ContactFromMail.php
         * dir: views/emails/contact/contact-form.blade.php
         *  # generated email template in --markdown flag
         * 
         * .env - configure mail environment viariables eq: MAIL_USERNAME
         * used: smtp.gmail.com port 587
         * 
         * config/mail added this to prevent timeout error
         * 'stream' => [
         *       'ssl' => [
         *           'allow_self_signed' => true,
         *           'verify_peer' => false,
         *           'verify_peer_name' => false,
         *       ],
         *   ],
         */

        $mail = Mail::to('testcamayacoast@gmail.com')->send(new ContactFormMail($data));

        session()->flash('message', 'Thanks for your message, We\'ll be in touch.');

        return redirect('/contact');
    }

}