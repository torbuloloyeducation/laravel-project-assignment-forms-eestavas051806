<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/services', 'services');
Route::view('/showcases', 'showcases');
Route::view('/blog', 'blog');

// Activity 2: Form handling
Route::get('/formtest', function () {
    $emails = session()->get('emails', []);

    return view('formtest', [
        'emails' => $emails,
    ]);
});

Route::post('/formtest', function () {
    // Task 2: Validation - reject empty and invalid email
    request()->validate([
        'email' => 'required|email',
    ]);

    $email = request('email');
    $emails = session()->get('emails', []);

    // Task 6: Limit to 5 emails
    if (count($emails) >= 5) {
        return redirect('/formtest')->with('warning', 'Maximum of 5 emails reached.');
    }

    // Task 3: Prevent duplicate emails
    if (in_array($email, $emails)) {
        return redirect('/formtest')->with('error', 'This email has already been added.');
    }

    $emails[] = $email;
    session()->put('emails', $emails);

    // Task 5: Success flash message
    return redirect('/formtest')->with('success', 'Email added successfully!');
});

// Task 4: Delete a single email by index
Route::post('/delete-email', function () {
    $index = request('index');
    $emails = session()->get('emails', []);

    if (isset($emails[$index])) {
        unset($emails[$index]);
        session()->put('emails', array_values($emails));
    }

    return redirect('/formtest')->with('success', 'Email removed.');
});

// Delete all emails
Route::get('/delete-emails', function () {
    session()->forget('emails');
    return redirect('/formtest');
});
