<?php

namespace App\Http\Controllers;

use App\Http\Resources\StreamDetailResource;
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
            'thumbnail' => 'required|image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');


        $thumbnailName = Str::random(40) . '.' . $request->file('thumbnail')->getClientOriginalExtension();


        Storage::move($thumbnailPath, 'public/thumbnails/' . $thumbnailName);


        $stream= new Stream();
        $stream->title = $request->input('title');
        $stream->code_id = $request->input('code_id');
        $stream->mentor_id = $request->input('mentor_id');
        $stream->name = $request->input('name');
        $stream->category = $request->input('category');
        $stream->link = $request->input('link');
        $stream->thumbnail = $thumbnailName;
        $stream->save();

        return response()->json($stream, 201);
    }

    public function show($code_id)
    {
        $stream = Stream::where('code_id', $code_id)->first();

        if ($stream) {
            $streamDetailResource = new StreamDetailResource($stream);
            $response = $streamDetailResource->toArray(request());

            return response()->json(['data' => $response], 200);
        } else {

            return response()->json(['error' => 'Masukan CODE_ID Dengan Benar'], 404);
        }
    }


}
