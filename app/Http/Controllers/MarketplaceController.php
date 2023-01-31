<?php

namespace App\Http\Controllers;

use App\Models\CategoryMarketplace;
use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketplaceController extends Controller
{
    public function index(){

        $categories = CategoryMarketplace::all();


        return view('marketplace.index', compact('categories'));
    }

    public function shop($marketplace){
        return view('marketplace.shop',compact('marketplace'));
    }

    public function add_files($marketplace){
        return view('marketplace.add_file',compact('marketplace'));
    }

    public function compras(){
        return view('mis_compras.index');
    }


    public function files(Marketplace $marketplace, Request $request){

        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        
        $url = Storage::put('marketplace', $request->file('file'));

        $marketplace->images()->create([
            'url' => $url
        ]);
    }
}
