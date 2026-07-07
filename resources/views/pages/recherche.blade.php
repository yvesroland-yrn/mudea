@extends('layouts.app')

@section('title', $query !== '' ? 'Recherche: ' . $query . ' - MUDEA' : 'Recherche - MUDEA')

@push('styles')
<style>
    
.search-page {
  max-width: 1180px;
  margin: 0 auto;
  padding: 54px 20px 80px;
}
.search-hero {
  background: linear-gradient(135deg, #0f4c3a 0%, #1b5e20 48%, #1565c0 100%);
  color: #fff;
  border-radius: 24px;
  padding: 34px 30px;
  box-shadow: 0 18px 50px rgba(0,0,0,.14);
}
.search-hero h1 {
  margin: 0 0 10px;
  font-size: clamp(1.6rem, 3vw, 2.4rem);
}
.search-hero p {
  margin: 0;
  opacity: .92;
  max-width: 760px;
  line-height: 1.7;
}
.search-summary {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 14px;
  margin: 22px 0 30px;
}
.summary-card {
  background: #fff;
  border: 1px solid #e3ebea;
  border-radius: 18px;
  padding: 18px 20px;
  box-shadow: 0 10px 25px rgba(18, 56, 42, .06);
}
.summary-card strong {
  display: block;
  font-size: 1.5rem;
  color: #0f4c3a;
}
.summary-card span {
  color: #5e7268;
  font-size: .92rem;
}
.search-section {
  margin-top: 28px;
}
.search-section h2 {
  margin: 0 0 14px;
  font-size: 1.1rem;
  color: #16372c;
}
.result-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 16px;
}
.result-card {
  background: #fff;
  border: 1px solid #e4ece8;
  border-radius: 20px;
  padding: 18px 18px 16px;
  box-shadow: 0 12px 28px rgba(18, 56, 42, .06);
  text-decoration: none;
  color: inherit;
  transition: transform .18s ease, box-shadow .18s ease;
}
.result-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 16px 34px rgba(18, 56, 42, .1);
}
.result-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
  color: #5e7268;
  font-size: .8rem;
  text-transform: uppercase;
  letter-spacing: .06em;
}
.result-badge {
  background: #e8f5e9;
  color: #1b5e20;
  border-radius: 999px;
  padding: 4px 9px;
  font-weight: 700;
}
.result-card h3 {
  margin: 0 0 8px;
  color: #17382d;
  font-size: 1.02rem;
}
.result-card p {
  margin: 0;
  color: #5e7268;
  line-height: 1.6;
}
.empty-state {
  background: #fff;
  border: 1px dashed #bfd1c8;
  border-radius: 20px;
  padding: 28px;
  color: #5e7268;
}
@media (max-width: 900px) {
  .search-summary,
  .result-grid {
    grid-template-columns: 1fr;
  }
  .search-page {
    padding: 30px 16px 60px;
  }
  .search-hero {
    padding: 26px 20px;
  }
}
</style>
@endpush

@section('content')
<div class="search-page">
  <div class="search-hero">
    <h1>Recherche sur MUDEA</h1>
    <p>
      @if($query !== '')
        Resultats pour <strong>{{ $query }}</strong>.
      @else
        Saisissez un mot-clé pour rechercher dans les projets, les actualites et les pages du site.
      @endif
    </p>
  </div>

  <div class="search-summary">
    <div class="summary-card">
      <strong>{{ $projects->count() }}</strong>
      <span>Projet(s) trouve(s)</span>
    </div>
    <div class="summary-card">
      <strong>{{ $actualites->count() }}</strong>
      <span>Actualite(s) trouve(e)s</span>
    </div>
    <div class="summary-card">
      <strong>{{ $pages->count() }}</strong>
      <span>Page(s) trouve(e)s</span>
    </div>
  </div>

  <div class="search-section">
    <h2>Projets</h2>
    @if($projects->isEmpty())
      <div class="empty-state">Aucun projet ne correspond a votre recherche.</div>
    @else
      <div class="result-grid">
        @foreach($projects as $result)
          <a href="{{ $result['url'] }}" class="result-card">
            <div class="result-meta">
              <span class="result-badge">{{ $result['badge'] }}</span>
              <span>{{ $result['type'] }}</span>
            </div>
            <h3>{{ $result['title'] }}</h3>
            <p>{{ $result['excerpt'] }}</p>
          </a>
        @endforeach
      </div>
    @endif
  </div>

  <div class="search-section">
    <h2>Actualites</h2>
    @if($actualites->isEmpty())
      <div class="empty-state">Aucune actualite ne correspond a votre recherche.</div>
    @else
      <div class="result-grid">
        @foreach($actualites as $result)
          <a href="{{ $result['url'] }}" class="result-card">
            <div class="result-meta">
              <span class="result-badge">{{ $result['badge'] }}</span>
              <span>{{ $result['type'] }}</span>
            </div>
            <h3>{{ $result['title'] }}</h3>
            <p>{{ $result['excerpt'] }}</p>
          </a>
        @endforeach
      </div>
    @endif
  </div>

  <div class="search-section">
    <h2>Pages</h2>
    @if($pages->isEmpty())
      <div class="empty-state">Aucune page ne correspond a votre recherche.</div>
    @else
      <div class="result-grid">
        @foreach($pages as $result)
          <a href="{{ $result['url'] }}" class="result-card">
            <div class="result-meta">
              <span class="result-badge">{{ $result['badge'] }}</span>
              <span>Page</span>
            </div>
            <h3>{{ $result['title'] }}</h3>
            <p>{{ $result['excerpt'] }}</p>
          </a>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endsection
