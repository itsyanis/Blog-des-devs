<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\helpers\Notifier;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    
    public function contact(ContactRequest $request)
    {
        if(request()->ajax())
        {
            $contact = new Contact();
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->email = $request->email;
            $contact->phoneNumber = $request->phoneNumber;
            $contact->subject = ucfirst($request->subject);
            $contact->message = ucfirst($request->message);

            try{
                Mail::to('LeBlogdesDevs@mail.com')->send(new ContactMail($contact));
                $contact->save();

            }catch(Exception $e)
            {
                $notification = new Notifier('error','Une erreur est survenue lors de l\'envoie', null, null);
                return $notification->toJson();
            }
            
            $notification = new Notifier('success','Votre message aa été envoyé avec succès', null, null);
            return $notification->toJson();
        }
    }
}
