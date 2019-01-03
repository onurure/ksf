@extends('layouts.sone')

@section('pagecss')
    <link rel="stylesheet" href="{{ url('assets/css/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/datatables/select.bootstrap.min.css') }}">
    <style>
        #kullanicilar .selected, #ortaklar .selected, #firmalar .selected{background-color:cornflowerblue;color:#fff;}
        #firmalar .selected i{color:#fff;}
        #kullanicilar, #ortaklar{max-height: 300px;overflow-y: auto;}
    </style>
@endsection
@section('content')
<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">NET KEŞİF MUHASEBE ŞİRKETLER YÖNETİM MENÜSÜ</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>FİRMALAR LİSTESİ</h4>
            </div>
            <div class="widget-body">
                <a href="{{url('admin')}}" class="btn btn-primary btn-square mr-1 mb-2">Yeni Firma Ekle</a>
                <div class="table-responsive">
                    <table id="firmalar" class="table table-bordered mb-0">
                        <thead>
                            <tr><th>ADI</th><th>VERGİ DAİRESİ</th><th>VERGİ NO</th><th>TELEFONU</th><th></th></tr>
                        </thead>
                        <tbody>
                            @if(isset($firms))
                                @foreach($firms as $firm)
                                    @if(request()->firm == $firm->id)
                                        @php
                                           $selected = $firm
                                        @endphp
                                    @endif
                                    <tr class="{{ request()->firm == $firm->id ? 'selected' : ''}}">
                                        <td>{{ $firm->name}}</td>
                                        <td>{{ $firm->tax}}</td>
                                        <td>{{ $firm->taxno}}</td>
                                        <td>{{ $firm->telephone}}</td>
                                        <td class="td-actions">
                                            <a href="{{url('admin')}}?firm={{$firm->id}}"><i class="la la-edit edit"></i></a>
                                            <a href="{{url('admin/delete')}}/{{$firm->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')"><i class="la la-close delete"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data" id="firmaForm">
    <div class="row">
        <div class="col-xl-12">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>ŞİRKET BİLGİLERİ</h4>
                </div>
                <div class="widget-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">ADI</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="name" value="{{ isset($selected) ? $selected->name : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">VERGİ DAİRESİ</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="tax" value="{{ isset($selected) ? $selected->tax : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">VERGİ NO</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="taxno" value="{{ isset($selected) ? $selected->taxno : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">ADRESİ</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="address" value="{{ isset($selected) ? $selected->address : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">TELEFON</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="telephone" value="{{ isset($selected) ? $selected->telephone : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">LOGO</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" name="logo">
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" name="firmid" value="{{ isset($selected) ? $selected->id : '' }}">
                        </div>
                        <div class="col-lg-4">
                            @if(isset($selected)&&$selected->logo!='')
                                <img src="{{ $selected->logo }}" class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row flex-row">
        <div class="col-xl-6">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>KULLANICILAR LİSTESİ</h4>
                </div>
                <div class="widget-body">
                    <table id="kullanicilar" class="table table-bordered mb-0">
                        <tbody>
                            @if(isset($users))
                                @foreach($users as $user)
                                    <tr data-uid="{{$user->id}}">
                                        <td><span class="text-primary">{{$user->name}}</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <hr>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-square mr-1 mb-2" id="tumunuSec">Tümünü Ekle</button>
                        <button type="button" class="btn btn-success btn-square mr-1 mb-2" id="secimiSec">Seçimi Ekle</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>ORTAKLAR LİSTESİ</h4>
                </div>
                <div class="widget-body">
                    <table id="ortaklar" class="table table-bordered mb-0">
                        <tbody>
                            @if(isset($partners))
                                @foreach($partners as $partner)
                                    <tr>
                                        <td><input type="hidden" name="partners[]" value="{{$partner->id}}" class="oran"><span class="text-primary">{{$partner->name}}</span></td>
                                        <td class="oran"><input type="integer" class="form-control" name="percentage[]" value="{{$partner->percentage}}"></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <hr>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success btn-square mr-1 mb-2" id="secimiKaldir">Seçimi Kaldır</button>
                        <button type="button" class="btn btn-primary btn-square mr-1 mb-2" id="tumunuKaldir">Tümünü Kaldır</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-block btn-square" onclick="percCheck()">Kaydet</button>                 
</form>
@endsection
@section('pagejs')  
    <script src="{{ url('assets/vendors/js/datatables/datatables.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datatables/buttons.print.min.js') }}"></script>
@endsection
@section('pagecustomjs')
<script>
    (function ($) {
        'use strict';
        $(function () {
            $('#kullanicilar tbody').on('click', 'tr', function (){
                $('#kullanicilar tbody tr').removeClass('selected');
                $(this).toggleClass('selected');
            });
            $('#ortaklar tbody').on('click', 'tr', function (){
                $('#ortaklar tbody tr').removeClass('selected');
                $(this).toggleClass('selected');
            });
            $('#tumunuSec').click(function(){
                $("#kullanicilar>tbody>tr").each(function() {
                    var yenitr = '<tr>'+$(this).html()+'<td class="oran"><input type="hidden" value="'+$(this).data('uid')+'" name="partners[]"><input type="integer" name="percentage[]" class="form-control" value=""></td></tr>';
                    $("#ortaklar > tbody").append(yenitr);
                    $(this).remove();
                });
            });
            $('#secimiSec').click(function(){
                var yenitr = '<tr>'+$('#kullanicilar tbody tr.selected').html()+'<td class="oran"><input type="hidden" value="'+$('#kullanicilar tbody tr.selected').data('uid')+'" name="partners[]"><input type="integer" name="percentage[]" class="form-control" value=""></td></tr>';
                $("#ortaklar > tbody").append(yenitr);
                $('#kullanicilar tbody tr.selected').remove();
                // var tabloveri = tablo.rows('.selected').data();
                // $.map(tablo.rows('.selected').data(), function (item) {
                //     var yenitr = '<tr><td><input type="hidden" class="form-control" name="partners[]" value="'+item[0]+'">'+item[1]+'</td><td><input type="integer" name="percentage[]" class="form-control" value=""></td></tr>';
                //     $("#ortaklar > tbody").append(yenitr);
                // });
                // console.log(tabloveri);
                // var yenitr = '<tr><td><input type="hidden" class="form-control" name="partners[]" value="'+tabloveri[0]+'">'+tabloveri[1]+'</td><td><input type="integer" name="percentage[]" class="form-control" value=""></td></tr>';
                // $("#ortaklar > tbody").append(yenitr);
            });
            $('#tumunuKaldir').click(function(){
                $("#ortaklar>tbody .oran").remove();
                $("#ortaklar>tbody>tr").each(function() {
                    var yenitr = '<tr>'+$(this).html()+'</tr>';
                    $("#kullanicilar > tbody").append(yenitr);
                    $(this).remove();
                });
            });
            $('#secimiKaldir').click(function(){
                $('#ortaklar tbody tr.selected .oran').remove();
                var yenitr = '<tr>'+$('#ortaklar tbody tr.selected').html()+'</tr>';
                $("#kullanicilar > tbody").append(yenitr);
                $('#ortaklar tbody tr.selected').remove();
                $('#kullanicilar > tbody').html()
                // var tabloveri = tablo.rows('.selected').data();
                // $.map(tablo.rows('.selected').data(), function (item) {
                //     var yenitr = '<tr><td><input type="hidden" class="form-control" name="partners[]" value="'+item[0]+'">'+item[1]+'</td><td><input type="integer" name="percentage[]" class="form-control" value=""></td></tr>';
                //     $("#ortaklar > tbody").append(yenitr);
                // });
                // console.log(tabloveri);
                // var yenitr = '<tr><td><input type="hidden" class="form-control" name="partners[]" value="'+tabloveri[0]+'">'+tabloveri[1]+'</td><td><input type="integer" name="percentage[]" class="form-control" value=""></td></tr>';
                // $("#ortaklar > tbody").append(yenitr);
            });
        });
    })(jQuery);
    function firmSelect(id){
        window.location.href = "{{ url('admin?firm=') }}"+id;
    }
    function percCheck(){
        var toplam = 0;
        $('input[name^=percentage]').each(function() {
            toplam = toplam + parseInt($(this).val());
            console.log($(this));
        });
        console.log(toplam);
        if(toplam != 100){
            var confirm = window.confirm('Ortakların oranlarının toplamı 100 değil. Yine de kayıt etmek istiyor musunuz?');
            if (confirm) {
                $("#firmaForm").submit();
            } else {
                return false;
            }
        }else{
            $("#firmaForm").submit();
        }
    }
</script>
@endsection