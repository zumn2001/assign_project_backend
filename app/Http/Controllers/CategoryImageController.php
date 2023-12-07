<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryImageResource;
use App\Models\CategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryImageController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->response('all images' , CategoryImageResource::collection(CategoryImage::all()));

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

        $categoryImage = new CategoryImage();   
        $filename = time()."_".$req->file('image')->getClientOriginalName();
        $req->file('image')->move(public_path('image'),$filename);
        $categoryImage->image = $filename;
        $categoryImage->save();

        return $this->response('category images' , new CategoryImageResource($categoryImage));
    }

}