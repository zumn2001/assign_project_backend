<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemImageResource;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemImageController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->response('all images' , ItemImageResource::collection(ItemImage::all()));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->errors($validator->errors() , "validation error");
        }

        $itemImage = new ItemImage();   
        $filename = time()."_".$req->file('image')->getClientOriginalName();
        $req->file('image')->move(public_path('image'),$filename);
        $itemImage->image = $filename;
        $itemImage->save();

        return $this->response('item images' , new ItemImageResource($itemImage));
    }

}
