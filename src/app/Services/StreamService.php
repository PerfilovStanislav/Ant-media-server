<?php

namespace App\Services;

use App\Gateways\AntMediaServerService;
use App\Models\Stream;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class StreamService
{
    public function store(int $userId, string $title, ?string $description, ?UploadedFile $file)
    {
        $path = $file !== null ? Storage::disk('public')->put('previews', $file) : null;

        $stream = new Stream();
        $stream->title          = $title;
        $stream->creator_id     = $userId;
        $stream->description    = $description;
        $stream->preview        = $path;
        $stream->save();

        (new AntMediaServerService())->createBroadcast($stream->hash_id, $title);

        return redirect( route('stream.index') )
            ->with('message', 'Stream created');
    }
}
