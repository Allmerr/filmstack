<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Playlist;
use App\Models\Review;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Welcome back, Admin!');
            } else {
                Auth::logout();
                return back()->with('error', 'You do not have admin privileges.');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('is_admin', true)->count(),
            'total_playlists' => Playlist::count(),
            'total_reviews' => Review::count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
            'new_users_week' => User::whereBetween('created_at', [now()->subWeek(), now()])->count(),
        ];

        $recent_users = User::latest()->take(5)->get();
        $recent_playlists = Playlist::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_playlists'));
    }

    public function users(Request $request)
    {
        // $query = User::query();

        // if ($request->has('search')) {
        //     $search = $request->search;
        //     $query->where('username', 'like', "%{$search}%")
        //           ->orWhere('email', 'like', "%{$search}%");
        // }

        // if ($request->has('filter')) {
        //     if ($request->filter === 'admin') {
        //         $query->where('is_admin', true);
        //     } elseif ($request->filter === 'regular') {
        //         $query->where('is_admin', false);
        //     }
        // }

        // $users = $query->withCount(['playlists', 'reviews'])->latest()->paginate(20);

        return view('admin.users', [
            'users' => User::all()->sortByDesc('created_at'),
        ]);
    }

    public function toggleAdmin(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot modify your own admin status.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        $status = $user->is_admin ? 'granted' : 'revoked';
        return back()->with('success', "Admin privileges {$status} for {$user->username}.");
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $username = $user->username;
        $user->delete();

        return back()->with('success', "User {$username} has been deleted.");
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
