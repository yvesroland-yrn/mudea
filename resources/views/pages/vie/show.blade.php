@extends('layouts.app')

@section('title', $vie->titre . ' - Vie & Coutumes - MUDEA')

@section('content')
<style>
.container-vie { max-width:900px;margin:32px auto;padding:0 18px; }
.vie-hero { background: #f7faf7;padding:18px;border-radius:10px;border:1px solid #eee;margin-bottom:18px; }
.vie-title { font-size:1.6rem;font-weight:800;color:#163a16;margin-bottom:8px; }
.vie-meta { color:#6b6b6b;font-size:0.95rem;margin-bottom:12px; }
.vie-media img{ width:100%;height:360px;object-fit:cover;border-radius:8px;margin-bottom:14px; }
.vie-content { font-size:1rem;line-height:1.8;color:#222; }
</style>

<div class="container-vie">
    <div class="vie-hero">
        <div class="vie-title">{{ $vie->titre }}</div>
        <div class="vie-meta">{{ $vie->categorie ? $vie->categorie . ' • ' : '' }}{{ $vie->date_publication ? $vie->date_publication->format('d M Y') : $vie->created_at->format('d M Y') }}</div>
    </div>

    @if($vie->media)
        <div class="vie-media"><img src="{{ asset($vie->media) }}" alt="{{ $vie->titre }}"></div>
    @endif

    <div class="vie-content">{!! nl2br(e($vie->description)) !!}</div>
</div>

@endsection
