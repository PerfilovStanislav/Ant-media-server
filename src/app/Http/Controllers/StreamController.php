<?php

namespace App\Http\Controllers;

use App\Http\Requests\StreamStoreRequest;
use App\Models\Stream;
use App\Services\StreamService;

class StreamController
{
    public function index()
    {
        $streams = Stream::query()
            ->orderBy('id', 'desc')
            ->get();

        return view('stream.index', [
            'streams' => $streams
        ]);
    }

    public function viewAddPage()
    {
        return view('stream.add');
    }

    public function view(Stream $stream)
    {
        return view('stream.view', [
            'stream' => $stream
        ]);
    }

    public function store(StreamStoreRequest $request, StreamService $streamService)
    {
        $streamService->store(
            auth()->id(),
            $request->validated(['title']),
            $request->validated(['description']),
            $request->validated(['preview']),
        );

        return redirect( route('stream.index') )
            ->with('message', 'Stream successfully created!');
    }
}
