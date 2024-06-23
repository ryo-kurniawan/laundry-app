<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    // public function proses_login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('/home');
    //     }

    //     return back()->withErrors([
    //         'email' => 'Email atau password yang anda masukkan salah',

    //     ]);
    // }
    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $client = new Client();
        $url = 'http://127.0.0.1:5001/user/login';

        try {
            $response = $client->request('POST', $url, [
                'json' => [
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['msg']) && $data['msg'] == 'Berhasil Login') {
                Session::put([
                    'logged_in' => true,
                    'user_id' => $data['data']['_id'],
                    'username' => $data['data']['username'],
                    'name' => $data['data']['namalengkap'],
                    'phone' => $data['data']['telepon'],
                    'role' => $data['data']['role']
                ]);
                $request->session()->regenerate();
                return redirect('/home');
            } else {
                return back()->withErrors(['message' => $data['msg']]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Unable to login, please try again later']);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
