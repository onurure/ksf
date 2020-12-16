@extends('layouts.sone')
@section('content')
    <div class="widget has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-12">
                    Şifre Değiştirme
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <form action="{{url('sifre')}}" method="post" enctype="multipart/form-data" id="kategoriekleform">
                        <div class="form-group">
                            <label for="urunadi">Şifre:</label>
                            <input type="text" class="form-control" id="name" name="sifre">
                        </div>
                        <div class="form-group">
                            <label for="urunadi">Şifre Tekrar:</label>
                            <input type="text" class="form-control" id="name" name="sifreT">
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection