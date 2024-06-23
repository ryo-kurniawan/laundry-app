<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils as PromiseUtils;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $client = new Client();
    $urlPaket = 'http://127.0.0.1:5001/paket/getallpaket';
    $urlLayanan = 'http://127.0.0.1:5001/layanan/getalllayanan';
    $urlPromo = 'http://127.0.0.1:5001/promo/getallpromos';

    try {
        // Mengirimkan permintaan ke API untuk data paket, layanan, dan promo
        $promisePaket = $client->getAsync($urlPaket);
        $promiseLayanan = $client->getAsync($urlLayanan);
        $promisePromo = $client->getAsync($urlPromo);

        // Menunggu ketiga permintaan selesai dengan Promise\Utils::settle
        $responses = PromiseUtils::settle([$promisePaket, $promiseLayanan, $promisePromo])->wait();

        $dataPaket = [];
        $dataLayanan = [];
        $dataPromo = [];

        // Penanganan respons data paket
        if ($responses[0]['state'] === 'fulfilled') {
            $responsePaket = $responses[0]['value'];
            $dataPaket = json_decode($responsePaket->getBody()->getContents(), true);
            if (!is_array($dataPaket) || !isset($dataPaket['data'])) {
                $dataPaket = [];
            }
        }

        // Penanganan respons data layanan
        if ($responses[1]['state'] === 'fulfilled') {
            $responseLayanan = $responses[1]['value'];
            $dataLayanan = json_decode($responseLayanan->getBody()->getContents(), true);
            if (!is_array($dataLayanan) || !isset($dataLayanan['data'])) {
                $dataLayanan = [];
            }
        }

        // Penanganan respons data promo
        if ($responses[2]['state'] === 'fulfilled') {
            $responsePromo = $responses[2]['value'];
            $dataPromo = json_decode($responsePromo->getBody()->getContents(), true);
            if (!is_array($dataPromo) || !isset($dataPromo['data'])) {
                $dataPromo = [];
            }
        }

        // Konfigurasi pagination untuk data paket
        $paketCollection = collect($dataPaket['data'] ?? []);
        $perPagePaket = 10; // Jumlah item per halaman
        $currentPagePaket = $request->input('page_paket', 1); // Halaman saat ini dari query string

        $paginatedPaket = new \Illuminate\Pagination\LengthAwarePaginator(
            $paketCollection->forPage($currentPagePaket, $perPagePaket), // Item untuk halaman saat ini
            $paketCollection->count(), // Jumlah total item
            $perPagePaket, // Item per halaman
            $currentPagePaket, // Halaman saat ini
            ['path' => $request->url(), 'query' => $request->query()] // Path untuk link pagination
        );

        // Konfigurasi pagination untuk data layanan
        $layananCollection = collect($dataLayanan['data'] ?? []);
        $perPageLayanan = 10; // Jumlah item per halaman
        $currentPageLayanan = $request->input('page_layanan', 1); // Halaman saat ini dari query string

        $paginatedLayanan = new \Illuminate\Pagination\LengthAwarePaginator(
            $layananCollection->forPage($currentPageLayanan, $perPageLayanan), // Item untuk halaman saat ini
            $layananCollection->count(), // Jumlah total item
            $perPageLayanan, // Item per halaman
            $currentPageLayanan, // Halaman saat ini
            ['path' => $request->url(), 'query' => $request->query()] // Path untuk link pagination
        );

        // Konfigurasi pagination untuk data promo
        $promoCollection = collect($dataPromo['data'] ?? []);
        $perPagePromo = 10; // Jumlah item per halaman
        $currentPagePromo = $request->input('page_promo', 1); // Halaman saat ini dari query string

        $paginatedPromo = new \Illuminate\Pagination\LengthAwarePaginator(
            $promoCollection->forPage($currentPagePromo, $perPagePromo), // Item untuk halaman saat ini
            $promoCollection->count(), // Jumlah total item
            $perPagePromo, // Item per halaman
            $currentPagePromo, // Halaman saat ini
            ['path' => $request->url(), 'query' => $request->query()] // Path untuk link pagination
        );

        // Mengirimkan data ke view
        return view('pages.settings.index', [
            'paket' => $paginatedPaket,
            'layanan' => $paginatedLayanan,
            'promo' => $paginatedPromo,
        ]);

    } catch (\Exception $e) {
        return view('pages.settings.index')->with('error', 'Failed to fetch data: ' . $e->getMessage());
    }
}

    public function createPaket()
    {
        return view('pages.settings.create-paket');
    }

    public function createLayanan()
    {
        return view('pages.settings.create-layanan');
    }

    public function createPromo()
    {
        return view('pages.settings.create-promo');
    }

    public function storePaket(Request $request)
    {
        $request->validate([
            'namapaket' => 'required',
            'harga' => 'required',
        ]);

        $client = new Client();
        $url = 'http://127.0.0.1:5001/paketlaundry/create';

        try {
            $response = $client->request('POST', $url, [
                'json' => [
                    'namapaket' => $request->namapaket,
                    'harga' => $request->harga,
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Paket created successfully');
            } else {
                return back()->with('error', 'Failed to create paket: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create paket: ' . $e->getMessage());
        }
    }

    public function storeLayanan(Request $request)
    {
        $request->validate([
            'layanan' => 'required',
        ]);

        $client = new Client();
        $url = 'http://127.0.0.1:5001/layanan/create';

        try {
            $response = $client->request('POST', $url, [
                'json' => [
                    'layanan' => $request->layanan,
                ]
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Layanan created successfully');
            } else {
                return back()->with('error', 'Failed to create layanan: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create layanan: ' . $e->getMessage());
        }
    }

    public function storePromo(Request $request)
    {
        $request->validate([
            'promo' => 'required',
            'keterangan' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $client = new Client();
        $url = 'http://127.0.0.1:5001/promo/create';

        try {
            $response = $client->request('POST', $url, [
                'multipart' => [
                    [
                        'name' => 'promo',
                        'contents' => $request->promo,
                    ],
                    [
                        'name' => 'keterangan',
                        'contents' => $request->keterangan,
                    ],
                    [
                        'name' => 'image',
                        'contents' => fopen($request->file('image')->path(), 'r'),
                        'filename' => $request->file('image')->getClientOriginalName(),
                    ],
                ],
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 201) {
                return redirect()->route('settings.index')->with('success', 'Promo created successfully');
            } else {
                return back()->with('error', 'Failed to create promo: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create promo: ' . $e->getMessage());
        }
    }


    public function editPaket($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/paket/getbyid/' . $id;

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                $paket = json_decode($response->getBody()->getContents(), true);
                return view('pages.settings.edit-paket', compact('paket'));
            } else {
                return back()->with('error', 'Failed to fetch paket data: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch paket data: ' . $e->getMessage());
        }
    }

    public function updatePaket(Request $request, $id)
    {
        $request->validate([
            'namapaket' => 'required',
            'harga' => 'required',
        ]);

        try {

            $client = new Client();
            $url = 'http://127.0.0.1:5001/paket/edit/' . $id;

            $response = $client->request('PUT', $url, [
                'json' => $request->all(),
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Paket updated successfully');
            } else {
                return back()->with('error', 'Failed to update paket: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update paket: ' . $e->getMessage());
        }
    }

    public function editLayanan($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/layanan/getbyid/' . $id;

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                $layanan = json_decode($response->getBody()->getContents(), true);
                return view('pages.settings.edit-layanan', compact('layanan'));
            } else {
                return back()->with('error', 'Failed to fetch layanan data: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch layanan data: ' . $e->getMessage());
        }
    }

    public function updateLayanan(Request $request, $id)
    {
        $request->validate([
            'layanan' => 'required',
        ]);

        try {

            $client = new Client();
            $url = 'http://127.0.0.1:5001/layanan/edit/' . $id;

            $response = $client->request('PUT', $url, [
                'json' => $request->all(),
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Layanan updated successfully');
            } else {
                return back()->with('error', 'Failed to update layanan: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update layanan: ' . $e->getMessage());
        }

    }

    public function editPromo($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/promo/getbyid/' . $id;

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                $promo = json_decode($response->getBody()->getContents(), true);
                return view('pages.settings.edit-promo', compact('promo'));
            } else {
                return back()->with('error', 'Failed to fetch promo data: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch promo data: ' . $e->getMessage());
        }
    }

    public function updatePromo(Request $request, $id)
{
    $request->validate([
        'promo' => 'required',
        'keterangan' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $client = new Client();
    $url = 'http://127.0.0.1:5001/promo/update/' . $id;

    try {
        // Prepare the data for the request
        $data = [
            [
                'name' => 'promo',
                'contents' => $request->input('promo'),
            ],
            [
                'name' => 'keterangan',
                'contents' => $request->input('keterangan'),
            ]
        ];

        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->getPathname();
            $imageName = $image->getClientOriginalName();

            // Add image data to the multipart form data
            $data[] = [
                'name' => 'image',
                'contents' => fopen($imagePath, 'r'),
                'filename' => $imageName,
            ];
        }

        // Make the HTTP request to the Node.js server
        $response = $client->request('PUT', $url, [
            'multipart' => $data
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            return redirect()->route('settings.index')->with('success', 'Promo updated successfully');
        } else {
            return back()->with('error', 'Failed to update promo: Status code ' . $statusCode);
        }
    } catch (RequestException $e) {
        $statusCode = $e->getResponse()->getStatusCode();
        return back()->with('error', 'Failed to update promo: Status code ' . $statusCode);
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to update promo: ' . $e->getMessage());
    }
}

    public function destroyPromo($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/promo/delete/' . $id;

        try {
            $response = $client->request('DELETE', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Promo deleted successfully');
            } else {
                return back()->with('error', 'Failed to delete promo: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete promo: ' . $e->getMessage());
        }
    }

    public function destroyLayanan($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/layanan/delete/' . $id;

        try {
            $response = $client->request('DELETE', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Layanan deleted successfully');
            } else {
                return back()->with('error', 'Failed to delete layanan: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete layanan: ' . $e->getMessage());
        }
    }

    public function destroyPaket($id)
    {
        $client = new Client();
        $url = 'http://127.0.0.1:5001/paketlaundry/delete/' . $id;

        try {
            $response = $client->request('DELETE', $url);
            $statusCode = $response->getStatusCode(); // Mendapatkan kode status HTTP

            if ($statusCode == 200) {
                return redirect()->route('settings.index')->with('success', 'Paket deleted successfully');
            } else {
                return back()->with('error', 'Failed to delete paket: Status code ' . $statusCode);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete paket: ' . $e->getMessage());
        }
    }

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
