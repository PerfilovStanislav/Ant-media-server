<?php
/** @var App\Models\Stream[] $streams */
?>
@extends('layouts.app')

@section('content')
    <div class="">
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Stream list</h1>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                @include('layouts.message')

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($streams as $stream)
                        <div class="col">
                            <div class="card shadow-sm">
                                <div style="
                                    width: 100%;
                                    height: 350px;
                                    background: url('{{ $stream->preview }}') 50% 50% no-repeat;
                                    background-size: cover;
                                    ">
                                </div>

                                <div class="card-body">
                                    @if($stream->is_online)
                                        <span>Online</span>
                                    @else
                                        <span>Offline</span>
                                    @endif

                                    <p class="card-text">
                                        {{ $stream->title }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('stream.view', ['stream' => $stream]) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                        </div>
                                        <small class="text-muted">{{ $stream->created_at->format('d.m.Y H:i')  }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
