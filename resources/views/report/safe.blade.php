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
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-radius: 4px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #f77750;
            border-width: 2px;
        }
        .select2-container--default .select2-selection--multiple {
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
    </style>
@endsection
@section('content')
    <div class="widget has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-sm-12">
                    <a class="btn btn-primary" href="{{url('report')}}">Kasa Raporu</a>
                    <a class="btn btn-secondary" href="{{url('incomereport')}}">Gelir-Alacak Raporu</a>
                    <a class="btn btn-secondary" href="{{url('expensereport')}}">Borç Raporu</a>
                    <a class="btn btn-secondary" href="{{url('summaryreport')}}">Gelir-Gider Özeti</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-8">
                    <h2>FİRMALAR</h2>
                    <div class="carousel-wrap">
                        <div class="owl-carousel owl-theme">
                            @foreach ($firms as $firm)
                                <a class="{{$firm->id == request()->firm ? 'selected' : ''}} item link" href="{{ url('report?firm='.$firm->id) }}"><img src="{{ url($firm->logo) }}"></a>
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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Kasalar:</label>
                            <select class="js-select2 form-control" multiple="multiple" name="safes[]">
                                @foreach($safes as $safe)
                                    <option value="{{$safe->id}}" data-badge="" {{ isset(request()->safes) && in_array($safe->id,request()->safes) ? 'selected' : '' }}>{{$safe->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Projeler:</label>
                            <select class="js-select2 form-control" multiple="multiple" name="projects[]">
                                @foreach($projects as $project)
                                    <option value="{{$project}}" data-badge="" {{ isset(request()->projects) && in_array($projects,request()->projects) ? 'selected' : '' }}>{{$project}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Kalem Ana Sınıfı:</label>
                            <select class="js-select2 form-control" multiple="multiple" id="kalemanasinifi" name="mainclasses[]">
                                @foreach($mainclasses as $mainclass)
                                    <option value="{{$mainclass->id}}" data-badge="" {{ isset(request()->mainclasses) && in_array($mainclass->id,request()->mainclasses) ? 'selected' : '' }}>{{$mainclass->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Kalem Alt Sınıfı:</label>
                            <select class="js-select2 form-control" multiple="multiple" id="kalemaltsinifi" name="subclasses[]">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Tarih:</label>
                            <input type="text" name="aratarih" class="form-control tablearama dateara" value="{{request()->aratarih}}">
                        </div>
                        <div class="form-group"><br>
                            <button class="btn btn-primary btn-block" type="button" onclick="ara()">ARA</button>
                        </div>
                    </div>
                                                
                </div>
            </form>
            @else
            Lütfen firma seçin
            @endif
            
                <div class="row mt-5 minheight600">
                    <div class="col-sm-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="reporttable">
                                <thead>
                                    <tr>
                                        <td>KASA ADI</td>
                                        <td>TARİH</td>
                                        <td>BANKA AÇ.</td>
                                        <td>DETAY AÇ.</td>
                                        <td>PROJE</td>
                                        <td>GİREN</td>
                                        <td>ÇIKAN</td>
                                        <td>BAKİYE</td>
                                        <td>KDV</td>
                                        <td>KALEM ANA SINIFI</td>
                                        <td>KALEM ALT SINIFI</td>
                                        <td>AY DÖNEMİ</td>
                                        <td>ÖZEL DÖNEM</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        
                    </div>
                </div>

        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Belge Yükleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('document/add/')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                    @csrf
                    <input type="hidden" id="typeup" name="type">
                    <input type="hidden" id="typeidup" name="typeid">
                </form>
                <hr>
                <div class="documents tableheight">
                    <table id="belgeler" class="table table-bordered mb-0">
                        <thead>
                            <tr><th>DOSYA ADI</th><th width="200">İŞLEMLER</th></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
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
@endsection 
@section('pagecustomjs')
    <script>

        function ara(){
            
            var formdata = $("#reportform").serializeArray();

            var tabledata = $('#reporttable').DataTable();
            tabledata.destroy();
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
                "processing": true,
                "serverSide": true,
                "searching": false,
                "sorting": false,
                "paging": false,
                "ordering": false,
                "ajax":{
                    url :"{{url('report')}}", // json datasource
                    type: "post",
                    dataType: "json",
                    data: function(d) {
                        var o = {};
                        $.each(formdata, function() {
                            if (o[this.name]) {
                                if (!o[this.name].push) {
                                    o[this.name] = [o[this.name]];
                                }
                                o[this.name].push(this.value || '');
                            } else {
                                o[this.name] = this.value || '';
                            }
                        });
                        return o;
                            console.log(modifiedArray);
                    }
                }
            } );
        }

    $(function(){

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
        
    </script>
@endsection