@extends('layouts.sone')

@section('pagecss')
    <link rel="stylesheet" href="{{ url('assets/css/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/datatables/select.bootstrap.min.css') }}">
    <style>
        #kullanicilar .selected, #ortaklar .selected, #firmalar .selected, #yfirmalar .selected, #yetkisinifi .selected{background-color:cornflowerblue;color:#fff;}
        #firmalar .selected i{color:#fff;}
        #kullanicilar, #ortaklar{max-height: 300px;overflow-y: auto;}
    </style>
@endsection
@section('content')
<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">NET KEŞİF MUHASEBE KULLANICILAR YÖNETİM MENÜSÜ</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>KULLANICILAR LİSTESİ</h4>
            </div>
            <div class="widget-body">
                <a href="{{url('admin/users')}}" class="btn btn-primary btn-square mr-1 mb-2">Yeni Kullanıcı Ekle</a>
                <div class="table-responsive">
                    <table id="kullanicilar" class="table table-bordered mb-0">
                        <thead>
                            <tr><th>ADI</th><th>SOYADI</th><th>KULLANICI ADI</th><th>TC NO</th><th>TELEFON</th><th>NETKEŞİF EPOSTA</th><th>KİŞİSEL EPOSTA</th><th>DURUMU</th></tr>
                        </thead>
                        <tbody>
                            @if(isset($users))
                                @foreach($users as $user)
                                    @if(request()->user == $user->id)
                                        @php
                                           $selected = $user
                                        @endphp
                                    @endif
                                    <tr onclick="userSelect({{$user->id}})" class="{{ request()->user == $user->id ? 'selected' : ''}}">
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->lastname}}</td>
                                        <td>{{ $user->username}}</td>
                                        <td>{{ $user->tcno}}</td>
                                        <td>{{ $user->phone}}</td>
                                        <td>{{ $user->netkesif_email}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->status == 1 ? 'Aktif' : 'Pasif' }}</td>
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
                    <h4>KULLANICI BİLGİLERİ</h4>
                </div>
                <div class="widget-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">ADI</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="name" value="{{ isset($selected) ? $selected->name : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">SOYADI</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="lastname" value="{{ isset($selected) ? $selected->lastname : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">KULLANICI ADI</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="username" value="{{ isset($selected) ? $selected->username : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">TC NO</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" name="tcno" value="{{ isset($selected) ? $selected->tcno : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">TELEFON</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" name="phone" value="{{ isset($selected) ? $selected->phone : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">NETKEŞİF EPOSTA</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="netkesif_email" value="{{ isset($selected) ? $selected->netkesif_email : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">KİŞİSEL EPOSTA</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="email" value="{{ isset($selected) ? $selected->email : '' }}">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">RESİM</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-3 form-control-label">DURUMU</label>
                                <div class="col-lg-9">
                                    <select name="status" class="form-control">
                                        <option value="1" {{ isset($selected)&&$selected->status==1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ isset($selected)&&$selected->status==0 ? 'selected' : '' }}>Pasif</option>
                                    </select>
                                </div>
                            </div>
                            @csrf
                            <input type="hidden" name="userid" value="{{ isset($selected) ? $selected->id : '' }}">
                        </div>
                        <div class="col-lg-2">
                            @if(isset($selected)&&$selected->photo!='')
                                <img src="{{ url($selected->photo) }}" class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>YETKİ İŞLEMLERİ</h3>
    <div class="row flex-row">
        <div class="col-xl-3">
            <div class="widget has-shadow">
                <div class="widget-body">
                    <table id="firmalar" class="table table-bordered mb-0">
                        <thead>
                            <tr><th>ŞİRKETLER LİSTESİ</th></tr>
                        </thead>
                        <tbody>
                            @if(isset($firms))
                                @foreach($firms as $firm)
                                    <tr data-fid="{{$firm->id}}">
                                        <td><span class="text-primary">{{$firm->name}}</span></td>
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
        <div class="col-xl-3">
            <div class="widget has-shadow">
                <div class="widget-body">
                    <table id="yfirmalar" class="table table-bordered mb-0">
                        <thead><tr><th>YETKİ OLAN ŞİRKETLER</th></tr></thead>
                        <tbody>
                            @if(isset($yfirms))
                                @foreach($yfirms as $yfirm)
                                    @php
                                        $selectedfirms[] = $yfirm->id
                                    @endphp
                                    <tr data-fid="{{$yfirm->id}}">
                                        <td><input type="hidden" name="yfirms[]" value="{{$yfirm->id}}" id="ys{{$yfirm->id}}"><span class="text-primary">{{$yfirm->name}}</span></td>
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
        <div class="col-xl-2">
            <div class="widget has-shadow">
                <div class="widget-body">
                    <table id="yetkisinifi" class="table table-bordered mb-0">
                        <thead><tr><th>YETKİ SINIFI</th></tr></thead>
                        <tbody>
                            @if(isset($yfirms))
                                @foreach ($yfirms as $yfirm)
                                    <tr onclick="yetkiSinifi(1, {{$yfirm->id}})" class="fclass fid{{$yfirm->id}} fy1 hide {{ $yfirm->authority_type==1 ? 'selected' : ''}}">
                                        <td><input type="hidden" value="{{$yfirm->authority_type}}" name="fid{{$yfirm->id}}" id="fid{{$yfirm->id}}"><span class="text-primary">TAM YETKİ</span></td>
                                    </tr>
                                    <tr onclick="yetkiSinifi(2,{{$yfirm->id}})" class="fclass fid{{$yfirm->id}} fy2 hide {{ $yfirm->authority_type==2 ? 'selected' : ''}}">
                                        <td><span class="text-primary">KISMI YETKİ</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="widget has-shadow">
                <div class="widget-body">
                    <table id="kasalar" class="table table-bordered mb-0">
                        <thead><tr><th>KASALAR</th><th>GÖR.</th><th>DÜZ.</th></tr></thead>
                        <tbody>
                            @if(isset($safes))
                                @foreach($safes as $safe)
                                    @if(isset($yfirms) && in_array($safe->firm_id,$selectedfirms))
                                        <tr class="fs{{$safe->firm_id}}">
                                            <td><span class="text-primary">{{$safe->name}}</span></td>
                                            <td><input type="checkbox" name="gor{{$safe->firm_id}}[]" value="{{$safe->id}}" {{in_array($safe->id,explode(',',$yfirm->account_authority)) ? 'checked' : ''}}></td>
                                            <td><input type="checkbox" name="duz{{$safe->firm_id}}[]" value="{{$safe->id}}" {{in_array($safe->id,explode(',',$yfirm->account_authority_edit)) ? 'checked' : ''}}></td>
                                        </tr>
                                    @else
                                        <tr class="fs{{$safe->firm_id}}">
                                            <td><span class="text-primary">{{$safe->name}}</span></td>
                                            <td><input type="checkbox" name="gor{{$safe->firm_id}}[]" value="{{$safe->id}}"></td>
                                            <td><input type="checkbox" name="duz{{$safe->firm_id}}[]" value="{{$safe->id}}"></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-square">Kaydet</button>                 
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
        $(function(){
            $("#kasalar > tbody > tr").addClass('hide');
            @if(isset($yfirms))
                $('#yfirmalar tbody tr:first-child').toggleClass('selected');
                $('#kasalar').removeClass('hide');
                $('.f'+$('#yfirmalar tbody tr:first-child').data('fid')).removeClass('hide');
                $(".fclass").addClass('hide');
                if($('#fid'+$('#yfirmalar tbody tr:first-child').data('fid')).val()){
                    console.log("aaa"+$('#fid'+$('#yfirmalar tbody tr:first-child').data('fid')).val());
                    if($('#fid'+$('#yfirmalar tbody tr:first-child').data('fid')).val()==2){

                    }
                    yetkiSinifi($('#fid'+$('#yfirmalar tbody tr:first-child').data('fid')).val(), $('#yfirmalar tbody tr:first-child').data('fid'));
                    $(".fid"+$('#yfirmalar tbody tr:first-child').data('fid')).removeClass('hide');
                }else{
                    var yetkis = '<tr onclick="yetkiSinifi(1,'+$('#yfirmalar tbody tr:first-child').data('fid')+')" class="fclass fid'+$('#yfirmalar tbody tr:first-child').data('fid')+' fy1"><td><input type="hidden" value="0" name="fid'+$('#yfirmalar tbody tr:first-child').data('fid')+'" id="fid'+$('#yfirmalar tbody tr:first-child').data('fid')+'"><span class="text-primary">TAM YETKİ</span></td></tr><tr onclick="yetkiSinifi(2,'+$('#yfirmalar tbody tr:first-child').data('fid')+')" class="fclass fid'+$('#yfirmalar tbody tr:first-child').data('fid')+' fy2"><td><span class="text-primary">KISMI YETKİ</span></td></tr>';
                    $('#yetkisinifi').append(yetkis);
                }
            @endif
            $('#firmalar tbody').on('click', 'tr', function (){
                $('#firmalar tbody tr').removeClass('selected');
                $(this).toggleClass('selected');
            });
            $('#kasalar tbody').on('click', 'tr', function (){
                $('#kasalar tbody tr').removeClass('selected');
                $(this).toggleClass('selected');
            });
            // $('#yetkisinifi tbody').on('click', 'tr', function (){
            //     $('#yetkisinifi tbody tr').removeClass('selected');
            //     $(this).toggleClass('selected');
            // });
            $('#yfirmalar tbody').on('click', 'tr', function (){
                $('#yfirmalar tbody tr').removeClass('selected');
                $(this).toggleClass('selected');
                $("#kasalar > tbody > tr").addClass('hide');
                $('#kasalar').removeClass('hide');
                $('.f'+$(this).data('fid')).removeClass('hide');
                $(".fclass").addClass('hide');
                if($('#fid'+$(this).data('fid')).val()){
                    console.log($('#fid'+$(this).data('fid')).val());
                    if($('#fid'+$(this).data('fid')).val()==2){
                    }
                    yetkiSinifi($('#fid'+$(this).data('fid')).val(), $(this).data('fid'));
                    $(".fid"+$(this).data('fid')).removeClass('hide');
                }else{
                    var yetkis = '<tr onclick="yetkiSinifi(1,'+$(this).data('fid')+')" class="fclass fid'+$(this).data('fid')+' fy1"><td><input type="hidden" value="0" name="fid'+$(this).data('fid')+'" id="fid'+$(this).data('fid')+'"><span class="text-primary">TAM YETKİ</span></td></tr><tr onclick="yetkiSinifi(2,'+$(this).data('fid')+')" class="fclass fid'+$(this).data('fid')+' fy2"><td><span class="text-primary">KISMI YETKİ</span></td></tr>';
                    $('#yetkisinifi').append(yetkis);
                }
            });
            $('#tumunuSec').click(function(){
                $("#firmalar>tbody>tr").each(function() {
                    console.log($(this).html());
                    var yenitr = '<tr data-fid="'+$(this).data('fid')+'">'+$(this).html()+'<input type="hidden" value="'+$(this).data('fid')+'" name="yfirms[]"></tr>';
                    $("#yfirmalar > tbody").append(yenitr);
                    $(this).remove();
                });
            });
            $('#secimiSec').click(function(){
                var yenitr = '<tr data-fid="'+$('#firmalar tbody tr.selected').data('fid')+'">'+$('#firmalar tbody tr.selected').html()+'<input type="hidden" value="'+$('#firmalar tbody tr.selected').data('fid')+'" name="yfirms[]"></tr>';
                $("#yfirmalar > tbody").append(yenitr);
                $('#firmalar tbody tr.selected').remove();
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
                $("#yfirmalar>tbody>tr").each(function() {
                    $("#ys"+$(this).data('fid')).remove();
                    var yenitr = '<tr data-fid="'+$(this).data('fid')+'">'+$(this).html()+'</tr>';
                    $("#firmalar > tbody").append(yenitr);
                    $("#kasalar > tbody > tr").addClass('hide');
                    $("#yetkisinifi > tbody > tr").addClass('hide');
                    $(this).remove();
                });
            });
            $('#secimiKaldir').click(function(){
                $("#ys"+$('#yfirmalar tbody tr.selected').data('fid')).remove();
                var yenitr = '<tr data-fid="'+$('#yfirmalar tbody tr.selected').data('fid')+'">'+$('#yfirmalar tbody tr.selected').html()+'</tr>';
                $("#firmalar > tbody").append(yenitr);
                $('#yfirmalar tbody tr.selected').remove();
                $("#yetkisinifi > tbody > tr").addClass('hide');
                $('#firmalar > tbody').html()
                $("#kasalar > tbody > tr").addClass('hide');
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
    function userSelect(id){
        window.location.href = "{{ url('admin/users?user=') }}"+id;
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
    function yetkiSinifi(type, fid){
        console.log(type,fid);
        $(".fy1").removeClass('selected');
        $(".fy2").removeClass('selected');
        if(type==1){
            $('#kasalar>tbody').addClass('hide');
            $('.fid'+fid).removeClass('selected');
            $('.fid'+fid+'.fy1').addClass('selected');
        }else if(type==2){
            $('#kasalar>tbody').removeClass('hide');
            $('.fs'+fid).removeClass('hide');
            $('.fid'+fid).removeClass('selected');
            $('.fid'+fid+'.fy2').addClass('selected');
        }
        $(".fy"+type).addClass('selected');
        $('#fid'+fid).val(type);
    }
</script>
@endsection