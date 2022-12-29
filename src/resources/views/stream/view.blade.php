<?php
/** @var App\Models\Stream $stream */
?>
@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 g-3">
                <div class="col-md-6 offset-3">
                    <div class="card shadow-sm">
                        @if($stream->is_online)
                            <iframe width="640" height="350" src="{{ $stream->url }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <div style="
                                width: 640px;
                                height: 350px;
                                background: url('{{ $stream->preview }}') 50% 50% no-repeat;
                                background-size: cover;
                             "></div>
                        @endif
                        <div class="card-body">
                            @if($stream->is_online)
                                <span>Online</span>
                            @else
                                <span>Offline</span>
                            @endif

                            <h3>{{ $stream->title }}</h3>
                            <p class="card-text">{{ $stream->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $stream->created_at->format('d.m.Y H:i')  }}</small>
                                <small class="text-muted">Streamer: {{ $stream->creator->name }}</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
