<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('frontend.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $contact = ContactMessage::create($validated);

        try {
            $adminEmail = \App\Models\Setting::get('contact_email', 'booking.siangholidays@gmail.com');
            \Illuminate\Support\Facades\Mail::raw(
                "New Contact Message Received on SiangExplorer!\n\n" .
                "Name: {$contact->name}\n" .
                "Email: {$contact->email}\n" .
                "Phone: {$contact->phone}\n" .
                "Subject: " . ($contact->subject ?: 'General Enquiry') . "\n\n" .
                "Message:\n{$contact->message}",
                function ($mail) use ($adminEmail, $contact) {
                    $mail->to($adminEmail)
                        ->replyTo($contact->email, $contact->name)
                        ->subject('New Website Message: ' . ($contact->subject ?: 'General Enquiry'));
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Contact mail dispatch error: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you for reaching out! Our travel concierge team will contact you within 24 hours.');
    }

    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $sub = NewsletterSubscriber::firstOrCreate(['email' => $validated['email']]);

        try {
            $adminEmail = \App\Models\Setting::get('contact_email', 'booking.siangholidays@gmail.com');
            \Illuminate\Support\Facades\Mail::raw(
                "New Newsletter Subscription on SiangExplorer!\n\nSubscriber Email: {$sub->email}",
                function ($mail) use ($adminEmail, $sub) {
                    $mail->to($adminEmail)
                        ->subject('New Newsletter Subscriber: ' . $sub->email);
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Newsletter mail dispatch error: ' . $e->getMessage());
        }

        return back()->with('success', 'You have successfully subscribed to SiangExplorer travel newsletter and exclusive deals!');
    }
}
