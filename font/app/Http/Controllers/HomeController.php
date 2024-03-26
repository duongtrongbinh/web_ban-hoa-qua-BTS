<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    private $products;
    private $slides;
    public function __construct(){
        $response = Http::get(env('API_URL').'/'.'products');
        $response1 = Http::get(env('API_URL').'/'.'slides');
        $this->products = $response->json();
        $this->slides = $response1->json();
    }
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = $this->slides;
        $products = $this->products;

            // return view('mains.main',compact('slides','products','idUser'));
        
        // dd($products['data'][0]['images'][0]['code_image']);
        return view('mains.main',compact('slides','products'));
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
