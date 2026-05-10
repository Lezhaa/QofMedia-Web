<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }
    
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }
    
    public function markAsRead(Contact $contact)
    {
        $contact->update(['read_at' => now()]);
        
        return redirect()->back()->with('success', 'Pesan ditandai sudah dibaca');
    }
    
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus');
    }
}