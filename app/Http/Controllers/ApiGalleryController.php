<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Http;
use App\Models\Post;

/**
* @OA\Info(
* description="ApiAngel",
* version="0.0.1",
* title="Contoh API documentation (pertemuan 12)",
* termsOfService="http://swagger.io/terms/",
* @OA\Contact(
* email="radityaangelita13@gmail.com"
* ),
* @OA\License(
* name="Apache 2.0",
* url="http://www.apache.org/licenses/LICENSE-2.0.html"
* )
* )
*/



class ApiGalleryController extends Controller
{
    /**
     * @OA\Get(
        * path="/api/getgallery",
        * tags={"Gets Data Gallery"},
        * summary="Ambil data gallerynya",
        * description="Cek Jalannya API",
        *operationId= "GetGallery",
     *@OA\Response(
        * response="default",
        * description="successful operation"
        * )
     * )
     */

     public function getGallery(){
        $post = Post::all();
        return response()->json(["data"=>$post]);
     }
    

    public function index() {
        $response = Http::get('http://127.0.0.1:9000/api/getgallery');
        $data = $response->object()->data;
    
        return view('auth.gallery', compact('data'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/postgallery",
     *     tags={"Upload Gambar"},
     *     summary="Mengunggah Gambar",
     *     description="Endpoint untuk mengunggah gambar.",
     *     operationId="storeGallery",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data untuk mengunggah gambar",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     description="Judul Upload",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="link",
     *                     description="Deskripsi link",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     description="Deskripsi Gambar",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="picture",
     *                     description="File Gambar",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Successful operation"
     *     )
     * )
     */

     public function storeGallery(Request $request)
     {
         $this->validate($request, [
             'title' => 'required|max:255',
             'description' => 'required',
             'picture' => 'image|nullable|max:1999',
             'link' => 'required|string'
         ]);
     
         // Membuat folder 'posts_image' jika belum ada
         $folderPath = public_path('storage/posts_image');
         if (!File::isDirectory($folderPath)) {
             File::makeDirectory($folderPath, 0777, true, true);
         }
     
         $filenameSimpan = 'noimage.png'; 
     
         if ($request->hasFile('picture')) {
             $filenameWithExt = $request->file('picture')->getClientOriginalName();
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
             $extension = $request->file('picture')->getClientOriginalExtension();
             $basename = uniqid() . time();
             $filenameSimpan = "{$basename}.{$extension}";
     
             $savepath = public_path('storage/posts_image/' . $filenameSimpan);
     
             $image = Image::make($request->file('picture'))
                 ->fit(375, 235)
                 ->save($savepath);
         }
     
         $post = new Post;
         $post->picture = $filenameSimpan;
         $post->title = $request->input('title');
         $post->description = $request->input('description');
         $post->link = $request->input('link');
         $post->save();
     
        //  return redirect()->route('ApiGetGallery')->with('success', 'Berhasil memperbarui data');
        return redirect()->route('ApiGetGallery')->with('success', 'Berhasil memperbarui data');

     }
}


