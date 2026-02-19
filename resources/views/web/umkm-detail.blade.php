@extends('web.layouts.app')

@section('title',$umkm->nama_usaha)

@section('content')

<style>
.detail-wrap{
  max-width:1000px;
  margin:0 auto;
  padding:48px 20px 80px;
}

.detail-img{
  width:100%;
  max-height:420px;
  object-fit:cover;
  border-radius:20px;
  box-shadow:0 18px 40px rgba(0,0,0,.12);
}

.detail-box{
  margin-top:32px;
}

.detail-box h1{
  margin:0;
  font-size:28px;
  font-weight:900;
}

.meta{
  margin:8px 0 24px;
  color:#64748b;
  font-size:14px;
}

.desc{
  font-size:15px;
  line-height:1.8;
}
</style>

<div class="detail-wrap">

  <img src="{{ $umkm->foto_url }}" class="detail-img" alt="{{ $umkm->nama_usaha }}">

  <div class="detail-box">
    <h1>{{ $umkm->nama_usaha }}</h1>

    <div class="meta">
      Kategori: <strong>{{ $umkm->kategori }}</strong> •
      Pelaku: <strong>{{ $umkm->pelaku }}</strong>
    </div>

    <div class="desc">
      {!! nl2br(e($umkm->deskripsi)) !!}
    </div>
  </div>

</div>

@endsection
