<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Route::get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->file('foto')) {
            $image_name = $request->file('foto')->store('image', 'public');
        }
        
        $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:2048'
        ]);
        $routes = new Route;
        $user = auth('sanctum')->user()->id;
        $routes->panjang = $request->get('panjang');
        $routes->ketinggianAwal = $request->get('ketinggianAwal');
        $routes->ketinggianAkhir = $request->get('ketinggianAkhir');
        $routes->foto = $image_name;
        $routes->kategori = $request->get('kategori');
        $routes->user_id = $user;

        $routes->save();
        return response()->json('succesfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Route::whereId($id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(Route::whereId($id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth('sanctum')->user()->id;
        $routes = Route::whereId($id)->first();
        $image_name = null;

        if ($request->file('foto')) {
            $image_name = $request->file('foto')->store('image', 'public');
        }
        
        $request->validate([
            'panjang' => 'required',
            'foto' => 'mimes:jpeg,png,jpg|max:2048'
        ]);
        $routeData = [
            'panjang' => $request->get('panjang'),
            'ketinggianAwal' => $request->get('ketinggianAwal'),
            'ketinggianAkhir' => $request->get('ketinggianAkhir'),
            'foto' => $image_name,
            'kategori' => $request->get('kategori'),
            'user_id' => $user,
        ];
        // $routes = new Route;
        // $routes->panjang = $request->get('panjang');
        // $routes->ketinggianAwal = $request->get('ketinggianAwal');
        // $routes->ketinggianAkhir = $request->get('ketinggianAkhir');
        // $routes->foto = $image_name;
        // $routes->kategori = $request->get('kategori');
        // $routes->user_id = $user;
        $routes->update($routeData);
        return response()->json('successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Route::whereId($id)->first()->delete();

        return response()->json('success');
    }
}
