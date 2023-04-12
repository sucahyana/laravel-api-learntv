<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\StreamResource;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StreamController extends Controller
{
    public function index()
    {
        $stream = Stream::all();
        $streamResource = StreamResource::collection($stream);

        $responseData = $streamResource->toArray(request());

        $responseData = [
            'event' => 'List URL Video',
            'data' => $responseData
        ];

        return response()->json($responseData);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('streams')->where(function ($query) use ($request) {
                    return $query->where('name', $request->input('name'))
                        ->where('title', $request->input('title'))
                        ->where('link', $request->input('link'))
                        ->where('category', $request->input('category'));
                }),
            ],
            'title' => 'required',
            'link' => 'required',
            'category' => 'required',
            'thumbnail' => 'required|image' // tambahkan validasi untuk file thumbnail, harus berupa gambar
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // ubah response menjadi JSON dengan status code 422 untuk error validasi
        }

        // Simpan file gambar ke storage
        $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');

        // Generate nama unik untuk file gambar
        $thumbnailName = Str::random(40) . '.' . $request->file('thumbnail')->getClientOriginalExtension();

        // Pindahkan file gambar ke folder yang diinginkan
        Storage::move($thumbnailPath, 'public/thumbnails/' . $thumbnailName);

        // Simpan data ke tabel streams menggunakan objek model Stream
        $stream = new Stream();
        $stream->title = $request->input('title');
        $stream->code_id = $request->input('code_id');
        $stream->mentor_id = $request->input('mentor_id');
        $stream->name = $request->input('name');
        $stream->category = $request->input('category');
        $stream->link = $request->input('link');
        $stream->thumbnail = $thumbnailName; // Simpan nama file gambar ke kolom thumbnail
        $stream->save();

        return response()->json($stream, 201);
    }
}
