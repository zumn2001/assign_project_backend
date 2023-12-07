<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('image')->paginate(10);
        $paginationData = [
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage(),
            'per_page' => $categories->perPage(),
            'total' => $categories->total(),
        ];
        return $this->response('all categories' ,['categories' => CategoryResource::collection($categories) , 'pagination' => $paginationData] );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return $this->response( 'Created',new CategoryResource($category));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return $this->error( "category not found",[]);
        }
        return $this->response('Details of category',new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,string $id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return $this->error( "category not found",[]);
        }
        $data = $request->validated();
        $category->update($data);
        return $this->response('updated',new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->first();

        if (!$category) {
            return $this->error("category not found",[]);
        }
        $category->delete();
        return response()->json([
            'condition'=> true,
            'message' => "Delete!",
        ],200);

    }
}

