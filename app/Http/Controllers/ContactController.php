<?php

namespace App\Http\Controllers;

use App\Mail\ContactNotification;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    
    public function show(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        try {
            $contact = Contact::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip' => $request->ip(),
            ]);

            try {
                $adminEmail = config('mail.admin_email', env('MAIL_ADMIN', 'ihammad25@gmail.com'));
                Mail::to($adminEmail)->send(new ContactNotification($contact));
            } catch (\Exception $mailException) {
                // Log email error but don't fail the request
                Log::warning('Failed to send contact email: ' . $mailException->getMessage());
            }

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully.'
                ]);
            }

            return redirect()->route('contact')->with('success', 'Thank you! Your message has been sent successfully.');
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again later.',
                    'error' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }

            return redirect()->route('contact')->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }
}
