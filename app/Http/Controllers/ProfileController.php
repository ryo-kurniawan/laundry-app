<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Session::get('user_id');
        $client = new Client();
        $url = 'http://103.175.220.104/user/getById/' . $id;
        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                $userData = json_decode($response->getBody()->getContents(), true);
                return view('pages.profile.index', compact('userData'));
            } else {
                return back()->with('error', 'Failed to fetch user data: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch user data: ' . $e->getMessage());
        }

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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
