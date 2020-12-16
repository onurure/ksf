@extends('layouts.sone')
@section('pagecss')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('assets/vendors/css/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/css/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .editable-buttons{margin-top: 6px;}
        .btn-primary i,.btn-danger i,.btn-info i,.btn-success i{margin-right: 0px !important}
        #kasalar .selected{background-color:cornflowerblue;color:#fff;}
        .owl-prev span, .owl-next span {
            color: #FFF;
        }
        .owl-prev span:hover, 
        .owl-next span:hover {
            color: #8199A3;
        }
        .owl-prev, .owl-next {
            position: absolute;
            top: 0;
            height: 96%;
        }
        .owl-prev {
            left: -17px;
        }
        .owl-next {
            right: -17px;
        }
        .fa-chevron-right:before{color: black}
        .fa-chevron-left:before{color: black}
        .owl-theme .owl-nav [class*=owl-]{
            margin: 0 !important;
        }
        a.item{border:3px solid #fff;}
        a.selected{border:3px solid red;}
        .tableheight{max-height: 250px;overflow-y: scroll;}
        .trarama td{padding:0px !important;position: relative;text-align: center;}
        .trarama .form-control{padding:.75rem 0.45rem .75rem 0.45rem;border:none !important;}
        .spanclose{
            position: absolute;
            right: -2px;
            top: -3px;
            bottom: 0;
            height: 16px;
            margin: auto;
            font-size: 14px;
            cursor: pointer;
            color: #ccc;
        }
        .minheight600{min-height: 600px;}
        .custom {
        background-color: #eadcbc;
        }

        /* Background Tint */
        .custom::before {
        background-color: #f7f2e5;
        }

        /* Knob Tint */
        .custom::after {
        background: #fff3a6;
        }

        /* Checked background tint */
        .custom:checked {
        background-color: #ffca3f; /* fallback */
        background-image: linear-gradient(
            -180deg,
            #ffca3f 0%, /* top */
            #feca40 100% /* bottom */
        );
        }
        .form-control:disabled{
            background: transparent !important;
        }
        .owl-stage{
            display: flex;
            align-items: center;
            text-align: center;
        }
        select.form-control:not([size]):not([multiple]){
            height: auto !important;background: transparent !important;
        }
        .owl-carousel .owl-item img{max-height: 150px !important;}

        .select2-container, .select2-search__field,.selection {
        width: 100% !important;
        }

        .select2-results__option {
        padding-right: 20px;
        vertical-align: middle;
        }
        .select2-results__option:before {
        content: "";
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        border: 2px solid #e9e9e9;
        border-radius: 4px;
        background-color: #fff;
        margin-right: 20px;
        vertical-align: middle;
        }
        .select2-results__option[role=group]:before {
        content: "";
        display: inline-block;
        position: relative;
        height: 0px;
        width: 0px;
        border: 2px solid #e9e9e9;
        border-radius: 4px;
        background-color: #fff;
        margin-right: 0px;
        vertical-align: middle;
        }
        .select2-results__option[aria-selected=true]:before {
        font-family:fontAwesome;
        content: "\f00c";
        color: #fff;
        background-color: #f77750;
        border: 0;
        display: inline-block;
        padding-left: 3px;
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #fff;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #eaeaeb;
            color: #272727;
        }
        .select2-container--default .select2-selection--multiple {
            margin-bottom: 10px;
        }
        .select2-container--default .select2-selection--single {
            margin-bottom: 10px;
        }
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-radius: 4px;
        }
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--single {
            border-radius: 4px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #f77750;
            border-width: 2px;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #f77750;
            border-width: 2px;
        }
        .select2-container--default .select2-selection--multiple {
            border-width: 2px;
        }
        .select2-container--default .select2-selection--single {
            border-width: 2px;
        }
        .select2-container--open .select2-dropdown--below {
            
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);

        }
        .select2-selection .select2-selection--multiple:after {
            content: 'hhghgh';
        }
        /* select with icons badges single*/
        .select-icon .select2-selection__placeholder .badge {
            display: none;
        }
        .select-icon .placeholder {
            display: none;
        }
        .select-icon .select2-results__option:before,
        .select-icon .select2-results__option[aria-selected=true]:before {
            display: none !important;
            /* content: "" !important; */
        }
        .select-icon  .select2-search--dropdown {
            display: none;
        }
        .daterangepicker .table-condensed tr>td, .daterangepicker .table-condensed tr>th{padding:0px !important;}
        .select2-container .select2-selection--single{min-height: 36px;height: auto !important;line-height: 36px;}
    </style>
@endsection
@section('content')
    <div class="widget has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-sm-12">
                    <a class="btn btn-secondary" href="{{url('report')}}">Kasa Raporu</a>
                    <a class="btn btn-secondary" href="{{url('incomereport')}}">Gelir-Alacak Raporu</a>
                    <a class="btn btn-secondary" href="{{url('expensereport')}}">Borç Raporu</a>
                    <a class="btn btn-primary" href="{{url('summaryreport')}}">Gelir-Gider Özeti</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-8">
                    <h2>FİRMALAR</h2>
                    <div class="carousel-wrap">
                        <div class="owl-carousel owl-theme">
                            @foreach ($firms as $firm)
                                <a class="{{$firm->id == request()->firm ? 'selected' : ''}} item link" href="{{ url('summaryreport?firm='.$firm->id) }}"><img src="{{ url($firm->logo) }}"></a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    @if($firmselect)
                        <p>Adı: {{$firmselect->name}}</p>
                        <p>Vergi Dairesi: {{$firmselect->tax}}</p>
                        <p>Vergi No: {{$firmselect->taxno}}</p>
                        <p>Adres: {{$firmselect->address}}</p>
                        <p>Tel: {{$firmselect->telephone}}</p>
                    @endif
                </div>
            </div>
            <hr>
            @if($firmselect)
            <form action="" method="post" id="reportform">
                @csrf
                <input type="hidden" value="{{request()->firm}}" name="firm">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Raporlar:</label>
                            <select class="js-select1 form-control" name="rapor" onchange="reportipi()" id="raportipi">
                                <option value="1" {{isset(request()->rapor)&&request()->rapor==1 ? 'selected' : ''}}>Dönem ve Müşteri Bazlı Kar Raporu</option>
                                <option value="2" {{isset(request()->rapor)&&request()->rapor==2 ? 'selected' : ''}}>Dönem Bazlı ve Alacak Detaylı Kar Raporu</option>
                                <option value="3" {{isset(request()->rapor)&&request()->rapor==3 ? 'selected' : ''}}>Dönem ve Personel Bazlı Maaş Raporu</option>
                                <option value="4" {{isset(request()->rapor)&&request()->rapor==4 ? 'selected' : ''}}>Dönem Bazlı Kar Raporu</option>
                                <option value="5" {{isset(request()->rapor)&&request()->rapor==5 ? 'selected' : ''}}>Dönem Bazlı Gider Raporu</option>
                                <option value="6" {{isset(request()->rapor)&&request()->rapor==6 ? 'selected' : ''}}>Müşteri Bazlı Gelir Raporu</option>
                                <option value="7" {{isset(request()->rapor)&&request()->rapor==7 ? 'selected' : ''}}>Dönem ve Ortak Bazlı Kar Payı Raporu</option>
                            </select>
                        </div>
                        <div class="form-group raportipi1 raportip">
                            <label for="email">Müşteriler:</label>
                            <select class="js-select2 form-control" multiple="multiple" id="" name="customers[]">
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" data-badge="" {{ isset(request()->customers) && in_array($customer->id,request()->customers) ? 'selected' : '' }}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group raportipi3 raportip hide">
                            <label for="email">Personel:</label>
                            <select class="js-select2 form-control" multiple="multiple" id="" name="personels[]">
                                @foreach($personel as $p)
                                    <option value="{{$p->id}}" data-badge="" {{ isset(request()->personels) && in_array($p->id,request()->personels) ? 'selected' : '' }}>{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Ay Dönemleri:</label>
                            <select class="js-select2 form-control" multiple="multiple" id="" name="monthperiods[]">
                                @foreach($monthperiods as $monthperiod)
                                    <option value="{{$monthperiod->id}}" data-badge="" {{ isset(request()->monthperiods) && in_array($monthperiod->id,request()->monthperiods) ? 'selected' : '' }}>{{$monthperiod->m_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Özel Dönemler:</label>
                            <select class="js-select2 form-control" multiple="multiple" id="" name="privateperiods[]">
                                @foreach($privateperiods as $privateperiod)
                                    <option value="{{$privateperiod->id}}" data-badge="" {{ isset(request()->privateperiods) && in_array($privateperiod->id,request()->privateperiods) ? 'selected' : '' }}>{{$privateperiod->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Tarih:</label>
                            <input type="text" name="aratarih" class="form-control tablearama dateara right" value="{{request()->aratarih}}">
                        </div>
                        <div class="form-group"><br>
                            <button class="btn btn-primary btn-block" type="submit">ARA</button>
                        </div>
                    </div>
                                                
                </div>
            </form>
            @else
            Lütfen firma seçin
            @endif
            
            <div class="row mt-5 minheight600">
                <div class="col-sm-12">
                    @if(request()->rapor == 1)
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="reporttable">
                            <thead>
                                <tr>
                                    <td rowspan="2">DÖNEM ADI</td>
                                    <td rowspan="2">MÜŞTERİ ADI</td>
                                    <td colspan="3">GELİRLER VE ALACAKLAR</td>
                                    <td colspan="2">GİDERLER VE BORÇLAR</td>
                                    <td colspan="2">DÖNEM KARI</td>
                                </tr>
                                <tr>
                                    <td>TAMAMLANMIŞ İŞ</td>
                                    <td>FATURA KESİLMESİ</td>
                                    <td>TAHSİLAT GİRİŞİ</td>
                                    <td>GİDERLER</td>
                                    <td>BORÇLAR</td>
                                    <td>KASA KARI</td>
                                    <td>GELİRLER BORÇLAR D KAR</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="display: none;"></td>
                                    <td colspan="2" align="right">GENEL TOPLAM</td>
                                    <td class="a1gt"></td>
                                    <td class="a2gt"></td>
                                    <td class="a3gt"></td>
                                    <td class="a4gt"></td>
                                    <td class="a5gt"></td>
                                    <td class="a6gt"></td>
                                    <td class="a7gt"></td>
                                </tr>
                                @php
                                    $mpi1 = 0;
                                @endphp
                                @if(isset($datas))
                                    @foreach($datas as $data)
                                        @if($mpi1==0||$mpi1!=$data->month_period_id)
                                            <tr>
                                                <td style="display: none;"></td>
                                                <td colspan="2" align="right">ARA TOPLAM</td>
                                                <td class="a1t{{$data->month_period_id}}"></td>
                                                <td class="a2t{{$data->month_period_id}}"></td>
                                                <td class="a3t{{$data->month_period_id}}"></td>
                                                <td class="a4t{{$data->month_period_id}}" data-t="{{isset($giderarray[$data->month_period_id]) ? $giderarray[$data->month_period_id] : 0}}">{{ isset($giderarray[$data->month_period_id]) ? number_format($giderarray[$data->month_period_id]/100,2,',','.') : 0 }}</td>
                                                <td class="a5t{{$data->month_period_id}}" data-t="{{isset($borcarray[$data->month_period_id]) ? $borcarray[$data->month_period_id] : 0}}">{{ isset($borcarray[$data->month_period_id]) ? number_format($borcarray[$data->month_period_id]/100,2,',','.') : 0 }}</td>
                                                <td class="a6t{{$data->month_period_id}}" data-t="{{$gelirarray[$data->month_period_id]-$giderarray[$data->month_period_id]}}">{{ number_format(($gelirarray[$data->month_period_id]-$giderarray[$data->month_period_id])/100,2,',','.') }}</td>
                                                <td class="a7t{{$data->month_period_id}}"></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>{{ $data->m_name }} {{ $data->y_name }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td class="a1-{{$data->month_period_id}}" data-t="{{$data->total1}}">{{ number_format($data->total1/100,2,',','.') }}</td>
                                            <td class="a2-{{$data->month_period_id}}" data-t="{{$data->total2}}">{{ number_format($data->total2/100,2,',','.') }}</td>
                                            <td class="a3-{{$data->month_period_id}}" data-t="{{$data->total3}}">{{ number_format($data->total3/100,2,',','.') }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @php 
                                            $mpi1 = $data->month_period_id
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @elseif(request()->rapor == 2)
                    @elseif(request()->rapor == 3)
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="reporttable">
                            <thead>
                                <tr>
                                    <td rowspan="2">DÖNEM ADI</td>
                                    <td rowspan="2">PERSONEL ADI</td>
                                    <td colspan="3">MAAŞI</td>
                                    <td rowspan="2">TOPLAM</td>
                                </tr>
                                <tr>
                                    <td>RESMİ</td>
                                    <td>G.R</td>
                                    <td>PRİM</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" align="right">GENEL TOPLAM</td>
                                    <td class="rgt"></td>
                                    <td class="grgt"></td>
                                    <td class="pgt"></td>
                                    <td class="tgt"></td>
                                </tr>
                                @php
                                    $mpi = 0;
                                @endphp
                                @if(isset($datas))
                                    @foreach($datas as $data)
                                        @if($mpi==0||$mpi!=$data->month_period_id)
                                            <tr>
                                                <td colspan="2" align="right">ARA TOPLAM</td>
                                                <td class="rat{{$data->month_period_id}}"></td>
                                                <td class="grat{{$data->month_period_id}}"></td>
                                                <td class="pat{{$data->month_period_id}}"></td>
                                                <td class="tat{{$data->month_period_id}}"></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>{{ $data->m_name }} {{ $data->y_name }}</td>
                                            <td>{{ $data->name }} {{ $data->lastname }}</td>
                                            <td class="r{{$data->month_period_id}}" data-t="{{$data->total1}}">{{ number_format($data->total1/100,2,',','.') }}</td>
                                            <td class="gr{{$data->month_period_id}}" data-t="{{$data->total2}}">{{ number_format($data->total2/100,2,',','.') }}</td>
                                            <td class="p{{$data->month_period_id}}" data-t="{{$data->total3}}">{{ number_format($data->total3/100,2,',','.') }}</td>
                                            <td class="t{{$data->month_period_id}}" data-t="{{$data->total1+$data->total2+$data->total3}}">{{ number_format(($data->total1+$data->total2+$data->total3)/100,2,',','.') }}</td>
                                        </tr>
                                        @php 
                                            $mpi = $data->month_period_id
                                        @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pagejs')
    <script src="{{ url('assets/js/bootstrap-editable.js') }}"></script>
    <script src="{{ url('assets/vendors/js/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/datepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ url('assets/vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ url('assets/vendors/js/mask/jquery.mask.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/mask/account.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
@endsection 
@section('pagecustomjs')
    <script>

        function ara(){
            
            tabledata = $('#reporttable').DataTable( {
            dom: 'Br',
            buttons: [
                'excel', 'pdf',
                {
                    extend: 'print',
                    text: 'Yazdır'
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Turkish.json"
            },
                "searching": false,
                "sorting": false,
                "paging": false,
                "ordering": false,
            } );
        }
        function toplama(){
            var gtoplamr = 0, gtoplamgr = 0, gtoplamp = 0, gtoplamt = 0;
            @if(isset(request()->monthperiods))
                @foreach(request()->monthperiods as $mp)
                    var aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                    $(".r{{$mp}}").each(function(){
                        aytoplamr = aytoplamr + $( this ).data( "t" );
                    });
                    $(".gr{{$mp}}").each(function(){
                        aytoplamgr = aytoplamgr + $( this ).data( "t" );
                    });
                    $(".p{{$mp}}").each(function(){
                        aytoplamp = aytoplamp + $( this ).data( "t" );
                    });
                    $(".t{{$mp}}").each(function(){
                        aytoplamt = aytoplamt + $( this ).data( "t" );
                    });
                    $(".rat{{$mp}}").text(numeral(aytoplamr/100).format('0.0,00'));
                    $(".grat{{$mp}}").text(numeral(aytoplamgr/100).format('0.0,00'));
                    $(".pat{{$mp}}").text(numeral(aytoplamp/100).format('0.0,00'));
                    $(".tat{{$mp}}").text(numeral(aytoplamt/100).format('0.0,00'));
                    gtoplamr = aytoplamr+gtoplamr;
                    gtoplamgr = aytoplamgr+gtoplamgr;
                    gtoplamp = aytoplamp+gtoplamp;
                    gtoplamt = aytoplamt+gtoplamt;
                    aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                @endforeach
            @else
                @foreach($monthperiods as $mp)
                var aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                    $(".r{{$mp->id}}").each(function(){
                        aytoplamr = aytoplamr + $( this ).data( "t" );
                    });
                    $(".gr{{$mp->id}}").each(function(){
                        aytoplamgr = aytoplamgr + $( this ).data( "t" );
                    });
                    $(".p{{$mp->id}}").each(function(){
                        aytoplamp = aytoplamp + $( this ).data( "t" );
                    });
                    $(".t{{$mp->id}}").each(function(){
                        aytoplamt = aytoplamt + $( this ).data( "t" );
                    });
                    $(".rat{{$mp->id}}").text(numeral(aytoplamr/100).format('0.0,00'));
                    $(".grat{{$mp->id}}").text(numeral(aytoplamgr/100).format('0.0,00'));
                    $(".pat{{$mp->id}}").text(numeral(aytoplamp/100).format('0.0,00'));
                    $(".tat{{$mp->id}}").text(numeral(aytoplamt/100).format('0.0,00'));
                    gtoplamr = aytoplamr+gtoplamr;
                    gtoplamgr = aytoplamgr+gtoplamgr;
                    gtoplamp = aytoplamp+gtoplamp;
                    gtoplamt = aytoplamt+gtoplamt;
                    aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                @endforeach
            @endif
            $(".rgt").text(numeral(gtoplamr/100).format('0.0,00'));
            $(".grgt").text(numeral(gtoplamgr/100).format('0.0,00'));
            $(".pgt").text(numeral(gtoplamp/100).format('0.0,00'));
            $(".tgt").text(numeral(gtoplamt/100).format('0.0,00'));
            console.log("r "+aytoplamr);
            console.log("gr "+aytoplamgr);
            console.log("p "+aytoplamp);
            console.log("t "+aytoplamt);
        }
    $(function(){
        @if(request()->rapor==1)
            toplama1();
        @elseif(request()->rapor==2)
        @elseif(request()->rapor==3)
            toplama();
        @endif
        ara();
        $('.owl-carousel').owlCarousel({
                margin: 10,
                nav: true,
                dots: false,
                navText: ['<span class="fas fa-chevron-left fa-2x"></span>','<span class="fas fa-chevron-right fa-2x"></span>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        $('.dateara').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY',
                applyLabel: 'Tamam',
                cancelLabel: 'Temizle',
                firstDay: 0,
                daysOfWeek: ["Pzt" ,"Salı", "Çarş", "Perş" ,"Cuma", "Ctesi", "Pazar"],
                monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık"]
            }
        });
    });

    $(".js-select2").select2({
            width: '100%',
			closeOnSelect : false,
			placeholder : "Seçin",
			allowHtml: true,
			allowClear: true,
			tags: true
        });
        $(".js-select1").select2({
            width: '100%',
			closeOnSelect : true,
			placeholder : "Seçin",
			allowHtml: true,
			allowClear: true,
			tags: true
        });
        $('#kalemanasinifi').on('select2:close', function (e) {
            var data, optgr, selectopt;
            console.log($('#kalemanasinifi').val());
            data = $('#kalemanasinifi').val();
            $.get( "{{url('ajax/mainclasses')}}", { 'mainclassids[]': data }, function( res ) {
                console.log(res );

                $.each(res, function(index, element){
                    if(index == 1){
                        optgr = 'Gelir';
                    }else if(index == 2){
                        optgr = 'Gider';
                    }else if(index == 3){
                        optgr = 'Gider Personel';
                    }else if(index == 6){
                        optgr = 'Kar Payı';
                    }else if(index == 7){
                        optgr = 'Kasalar Arası';
                    }
                    selectopt = '<optgroup label="'+optgr+'">';
                    $.each(element, function(i, el){
                        selectopt += '<option value="'+i+'">'+el+'</option>';
                    });
                    selectopt += '</optgroup>';
                    console.log(selectopt);
                    $("#kalemaltsinifi").append(selectopt);
                });
            });
        });
        function reportipi(){
            var tipi = $("#raportipi").val();
            console.log(tipi);
            $(".raportip").addClass('hide');
            $(".raportipi"+tipi).removeClass('hide');
        }
        function toplama1(){
            var a1t = 0, a2t = 0, a3t = 0; a4t = 0; a5t = 0; a6t = 0; a7t = 0;
            @if(isset(request()->monthperiods))
                @foreach(request()->monthperiods as $mp)
                    var aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                    $(".a1-{{$mp}}").each(function(){
                        aytoplamr = aytoplamr + $( this ).data( "t" );
                    });
                    $(".a2-{{$mp}}").each(function(){
                        aytoplamgr = aytoplamgr + $( this ).data( "t" );
                    });
                    $(".a3-{{$mp}}").each(function(){
                        aytoplamp = aytoplamp + $( this ).data( "t" );
                    });
                    $(".a1t{{$mp}}").text(formatMyMoney(aytoplamr/100));
                    $(".a2t{{$mp}}").text(formatMyMoney(aytoplamgr/100));
                    $(".a3t{{$mp}}").text(formatMyMoney(aytoplamp/100));
                    a1t = aytoplamr+a1t;
                    a2t = aytoplamgr+a2t;
                    a3t = aytoplamp+a3t;
                    a4t = a4t + $(".a4t{{$mp}}").data('t');
                    a5t = a5t + $(".a5t{{$mp}}").data('t');
                    a6t = a6t + $(".a6t{{$mp}}").data('t');
                    var tt = aytoplamr+aytoplamgr+aytoplamp-$(".a4t{{$mp}}").data('t')-$(".a5t{{$mp}}").data('t');
                    console.log(tt);
                    a7t = a7t + tt;
                    $(".a7t{{$mp}}").text(formatMyMoney(tt/100));
                    aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                @endforeach
            @else
                @foreach($monthperiods as $mp)
                var aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                    $(".a1-{{$mp}}").each(function(){
                        aytoplamr = aytoplamr + $( this ).data( "t" );
                    });
                    $(".a2-{{$mp}}").each(function(){
                        aytoplamgr = aytoplamgr + $( this ).data( "t" );
                    });
                    $(".a3-{{$mp}}").each(function(){
                        aytoplamp = aytoplamp + $( this ).data( "t" );
                    });
                    $(".a1t{{$mp}}").text(formatMyMoney(aytoplamr/100));
                    $(".a2t{{$mp}}").text(formatMyMoney(aytoplamgr/100));
                    $(".a3t{{$mp}}").text(formatMyMoney(aytoplamp/100));
                    a1t = aytoplamr+a1t;
                    a2t = aytoplamgr+a2t;
                    a3t = aytoplamp+a3t;

                    a4t = a4t + $(".a4t{{$mp}}").data('t');
                    a5t = a5t + $(".a5t{{$mp}}").data('t');
                    a6t = a6t + $(".a6t{{$mp}}").data('t');
                    var tt = aytoplamr+aytoplamgr+aytoplamp-$(".a4t{{$mp}}").data('t')-$(".a5t{{$mp}}").data('t');
                    console.log(tt);
                    a7t = a7t + tt;
                    $(".a7t{{$mp}}").text(formatMyMoney(tt/100));
                    aytoplamr = 0, aytoplamgr = 0, aytoplamp = 0, aytoplamt = 0;
                @endforeach
            @endif
            $(".a1gt").text(formatMyMoney(a1t/100));
            $(".a2gt").text(formatMyMoney(a2t/100));
            $(".a3gt").text(formatMyMoney(a3t/100));
            $(".a4gt").text(formatMyMoney(a4t/100));
            $(".a5gt").text(formatMyMoney(a5t/100));
            $(".a6gt").text(formatMyMoney(a6t/100));
            $(".a7gt").text(formatMyMoney(a7t/100));
        }
        function formatMyMoney(price) {
  
        var currency_symbol = "₺"

        var formattedOutput = new Intl.NumberFormat('tr-TR', {
            style: 'currency',
            currency: 'TRY',
            minimumFractionDigits: 2,
            });

        return formattedOutput.format(price).replace(currency_symbol, '')
        }

    </script>
@endsection