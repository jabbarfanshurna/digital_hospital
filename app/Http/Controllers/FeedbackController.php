<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Menampilkan semua feedback (Untuk Admin)
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('dashboard.admin.feedbacks.index', compact('feedbacks'));
    }

    // Menyimpan feedback (Untuk Pasien)
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
    
    // Menghapus feedback (Untuk Admin)
    public function destroy(Feedback $feedback)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $feedback->delete();
        return back()->with('success', 'Ulasan dihapus.');
    }
}