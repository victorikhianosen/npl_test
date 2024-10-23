<?php


namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{


    public function showSignUpForm()
    {
        return view('auth.signup');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // If successful, redirect to intended location
            return redirect()->intended('dashboard'); 
        }

        // If unsuccessful, redirect back with an error message
        return back()->with('error','The provided credentials do not match our records.');
    }


    public function register(Request $request)
    {
        // Validate the request using the validate method directly
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to desired location
        return redirect()->route('dashboard')->with('success', 'Welcome');
    }
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('dashboard', [
            'books' => $books
        ]);
    }

    public function showSingle()
    {
        return view('single');
    }

    public function create(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'page_number' => 'required|integer|min:1',
            'publisher' => 'required|string|max:255',
            'year_published' => 'required|integer',
            'file' => 'required|file|mimes:pdf|max:99948', // Only PDF allowed for now
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:10240' // Optional image validation
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $fileName = time() . '_file.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('uploads/files'), $fileName);
            $validated['file'] = 'uploads/files/' . $fileName; // Save file path
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), $imageName);
            $validated['image'] = 'uploads/images/' . $imageName; // Save image path
        }

        // Create a new book entry with file and image paths
        Book::create($validated);

        // Redirect to the dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Book created successfully with image and file uploaded');
    }

    public function showBulk()
    {
        return view('bulk');
    }


    public function bulk(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'page_number' => 'required|integer|min:1',
            'publisher' => 'required|string|max:255',
            'year_published' => 'required|integer',
            'file.*' => 'required|file|mimes:pdf|max:99948', // Updated for multiple PDFs
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:10240' // Optional image validation
        ]);

        // Handle PDF file uploads
        if ($request->hasFile('file')) {
            $filePaths = [];
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . uniqid() . '_file.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/files'), $fileName);
                $filePaths[] = 'uploads/files/' . $fileName; // Save file path
            }
            $validated['file'] = json_encode($filePaths); // Save file paths as JSON
        }

        // Handle image uploads
        if ($request->hasFile('image')) {
            $imageName = time() . '_image.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/images'), $imageName);
            $validated['image'] = 'uploads/images/' . $imageName; // Save image path
        }

        // Create a new book entry with file and image paths
        Book::create($validated);

        // Redirect to the dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Books created successfully with images and files uploaded');
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to the desired location
        return redirect()->route('home');
    }
}
