@extends('layouts.sone')
@section('pagecss')
    <link rel="stylesheet" href="{{ url('assets/vendors/css/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/css/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/dropzone/dropzone.css') }}">
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
    </style>
@endsection
@section('content')
    <div class="widget has-shadow">
        <div class="widget-body">
            <div class="row">
                <div class="col-sm-8">
                    <h2>FİRMALAR</h2>
                    <div class="carousel-wrap">
                        <div class="owl-carousel owl-theme">
                            @foreach ($firms as $firm)
                                <a class="{{$firm->id == request()->firm ? 'selected' : ''}} item link" href="{{ url('expense?firm='.$firm->id) }}"><img src="{{ url($firm->logo) }}"></a>
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
                <div class="row mt-5 minheight600">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" onclick="yeniSatir()"><i class="la la-plus"></i> Veri Ekle</button>
                        <h1></h1>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td>BORÇ TİPİ</td>
                                        <td>BORÇLU OLUNAN</td>
                                        <td>TARİH</td>
                                        <td>AÇIKLAMA</td>
                                        <td>MATRAH</td>
                                        <td>KDV</td>
                                        <td>KDV TUTARI</td>
                                        <td>RESMİ TUTAR</td>
                                        <td>GR TUTAR</td>
                                        <td>TOPLAM</td>
                                        <td>AY DÖNEMLİ</td>
                                        <td>ÖZEL DÖNEM</td>
                                        <td>BELGE</td>
                                        <td>İŞLEM</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="post">
                                        <tr class="trarama">
                                            @csrf
                                            <td>
                                                <select name="aratip" class="form-control tablearama">
                                                    <option value="" {{request()->aratip=="" ? 'selected' : ''}}>SEÇİN</option>
                                                    @foreach($expenses as $expense)
                                                        <option value="{{$expense->id}}" {{request()->aratip==$expense->id ? 'selected' : ''}}>{{$expense->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="araborcluolunan" class="form-control tablearama" value="{{request()->araborcluolunan}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="aratarih" class="form-control tablearama dateara" value="{{request()->aratarih}}" autocomplete="off"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="aradetay" class="form-control tablearama" value="{{request()->aradetay}}" autocomplete="off"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="number" name="aramatrah" class="form-control tablearama" value="{{request()->aramatrah}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td>
                                                <select name="arakdv" class="form-control tablearama">
                                                    <option value="" {{request()->arakdv=="" ? 'selected' : ''}}>SEÇİN</option>
                                                    <option value="0" {{request()->arakdv != '' && request()->arakdv==0 ? 'selected' : ''}}>% 0</option>
                                                    <option value="1" {{request()->arakdv==1 ? 'selected' : ''}}>% 1</option>
                                                    <option value="8" {{request()->arakdv==8 ? 'selected' : ''}}>% 8</option>
                                                    <option value="18" {{request()->arakdv==18 ? 'selected' : ''}}>% 18</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="arakdvtutar" class="form-control tablearama" value="{{request()->arakdv}}"><span class="spanclose"><i class="la la-close"></i></span>
                                            </td>                                            
                                            <td><input type="text" name="araresmitutar" class="form-control tablearama" value="{{request()->araresmitutar}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="aragrtutar" class="form-control tablearama" value="{{request()->aragrtutar}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="aratoplam" class="form-control tablearama" value="{{request()->aratoplam}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td>
                                                <select name="aramonth" class="form-control">
                                                    <option value="" {{request()->aramonth=="" ? 'selected' : ''}}>SEÇİN</option>
                                                    @foreach($monthperiods as $monthperiod)
                                                        <option value="{{$monthperiod->id}}" {{ request()->aramonth==$monthperiod->id ? 'selected' : ''}}>{{$monthperiod->m_name.' '.$monthperiod->y_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="araozel" class="form-control">
                                                    <option value="" {{request()->araozel=="" ? 'selected' : ''}}>SEÇİN</option>
                                                    @foreach($privateperiods as $privateperiod)
                                                        <option value="{{$privateperiod->id}}" {{ request()->araozel==$privateperiod->id ? 'selected' : ''}}>{{$privateperiod->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td></td>
                                            <td><button class="btn btn-success btn-sm"><i class="la la-search"></i></button>  <a href="{{url('incoming?firm='.request()->firm)}}" class="btn btn-danger btn-sm" onclick="temizle()"><i class="la la-close"></i></a></td>
                                        </tr>
                                    </form>
                                    <tr class="trarama hide yenisatir">
                                        <form action="{{url('expensedata')}}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="expense_firm_id" value="{{request()->firm}}">
                                            @csrf
                                        <td>
                                            <select name="tip" class="form-control tablearama">
                                                @foreach($expenses as $expense)
                                                    <option value="{{$expense->id}}">{{$expense->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="borcluolunan" class="form-control tablearama"><span class="spanclose"><i class="la la-close"></i></span></td>
                                        <td><input type="text" class="form-control tablearama date" name="tarih"></td>
                                        <td><input type="text" class="form-control tablearama" name="detaynot"></td>
                                        <td><input type="number" step="0.01" class="form-control tablearama hesap" name="matrah"></td>
                                        <td>
                                            <select name="kdv" class="form-control hesapla">
                                                <option value="0">% 0</option>
                                                <option value="1">% 1</option>
                                                <option value="8">% 8</option>
                                                <option value="18">% 18</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control tablearama hesapbakiyekdv" readonly></td>
                                        <td><input type="text" class="form-control tablearama hesapbakiye" name="resmitutar"></td>
                                        <td><input type="text" class="form-control tablearama hesapbakiye2" name="gresmitutar"></td>
                                        <td><input type="text" class="form-control tablearama hesapbakiye3" name="toplamtutar"></td>
                                        <td>
                                            <select name="monthperiod" class="form-control">
                                                @foreach($monthperiods as $monthperiod)
                                                    <option value="{{$monthperiod->id}}">{{$monthperiod->m_name.' '.$monthperiod->y_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="privateperiod" class="form-control">
                                                @foreach($privateperiods as $privateperiod)
                                                    <option value="{{$privateperiod->id}}">{{$privateperiod->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td></td>
                                        <td><button type="submit" class="btn btn-primary btn-sm"><i class="la la-save"></i></button></td>
                                        </form>
                                    </tr>
                                    @foreach ($expensedatas as $expensedata)
                                        <tr class="trarama" id="veri{{$expensedata->id}}" 
                                            {{-- @if($expensedata->type==1)
                                                style="background-color:#eaf451" 
                                            @elseif($expensedata->type==2)
                                                style="background-color:#a5f2a7"
                                            @elseif($expensedata->type==3)
                                                style="background-color:#85adfe"
                                            @elseif($expensedata->type==4)
                                                style="background-color:#fc6a89"
                                            @endif --}}
                                            >
                                            <form action="{{url('expensedatadata/'.$expensedata->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <td title="İşlem Tipi" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                    <select name="tip" class="form-control tablearama">
                                                        @foreach($expenses as $expense)
                                                            <option value="{{$expense->id}}" {{$expensedata->type==$expense->id ? 'selected' : ''}}>{{$expense->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control tablearama" name="borcluolunan" value="{{ $expensedata->kime }}" disabled></td>
                                                <td><input type="text" class="form-control tablearama date" name="tarih" value="{{ date('d-m-Y', strtotime(str_replace('-', '/', $expensedata->data_date))) }}" disabled></td>
                                                <td title="Açıklama" data-trigger="hover" data-content="{{$expensedata->detail}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" name="detaynot" value="{{ $expensedata->detail }}" disabled></td>
                                                <td><input type="number" step="0.01" class="form-control tablearama" name="matrah" value="{{ $expensedata->netprice }}" disabled></td>
                                                <td>
                                                    <select name="kdv" class="form-control" disabled>
                                                        <option value="0" {{ $expensedata->tax==0 ? 'selected' : ''}}>% 0</option>
                                                        <option value="1" {{ $expensedata->tax==1 ? 'selected' : ''}}>% 1</option>
                                                        <option value="8" {{ $expensedata->tax==8 ? 'selected' : ''}}>% 8</option>
                                                        <option value="18" {{ $expensedata->tax==18 ? 'selected' : ''}}>% 18</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control tablearama" readonly value="{{ number_format($expensedata->netprice*($expensedata->tax)/100,2,'.','') }}" disabled></td>
                                                <td><input type="text" class="form-control tablearama" name="resmitutar" value="{{ $expensedata->officialprice }}" disabled></td>
                                                <td><input type="text" class="form-control tablearama" name="gresmitutar" value="{{ $expensedata->nonofficialprice }}" disabled></td>
                                                <td><input type="text" class="form-control tablearama" name="toplamtutar" value="{{ $expensedata->totalprice }}" disabled></td>
                                                <td title="Ay Dönemi" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                    <select name="monthperiod" class="form-control popoverselect" disabled>
                                                        @foreach($monthperiods as $monthperiod)
                                                            <option value="{{$monthperiod->id}}" {{ $expensedata->month_period_id==$monthperiod->id ? 'selected' : ''}}>{{$monthperiod->m_name.' '.$monthperiod->y_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td title="Özel Dönem" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                    <select name="privateperiod" class="form-control popoverselect" disabled>
                                                        @foreach($privateperiods as $privateperiod)
                                                            <option value="{{$privateperiod->id}}" {{ $expensedata->private_period_id==$privateperiod->id ? 'selected' : ''}}>{{$privateperiod->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm openBtn" onclick="belgeYukleme({{$expensedata->id}})"><i class="fa fa-plus"></i></button>
                                                </td>
                                                <td width="100">
                                                    <span class="hide kaydetBtn"><button type="submit" class="btn btn-primary btn-sm"><i class="la la-save"></i></button> <button type="button" class="btn btn-danger btn-sm" onclick="satirCancel({{$expensedata->id}}, this)"><i class="la la-close"></i></button></span><span class="editBtn"><button type="button" class="btn btn-info btn-sm" onclick="satirEdit({{$expensedata->id}}, this)"><i class="la la-edit"></i></button> <a href="{{url('expensedata/delete')}}/{{$expensedata->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></span>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
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
    <script src="{{ url('assets/vendors/js/datepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('assets/vendors/dropzone/dropzone.js') }}"></script>
@endsection
@section('pagecustomjs')
    <script>
        let a1;
        let a2;
        let a3;
        let a4;
        let a5;
        let a6;
        let a7;
        let a8;
        let a9;
        let a10;
        let a11;
        $(document).ready(function() {
            $('.popaciklama').popover();
            $('.editableTD').editable({
                mode: 'inline',
                url: '{{ url("expensedata/ajax/save") }}',
            });
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
            $('.link').on('click', function(event){
                var $this = $(this);
                if($this.hasClass('clicked')){
                    $this.removeAttr('style').removeClass('clicked');
                }else{
                    $this.css('background','#7fc242').addClass('clicked');
                }
            });
        });
        $('.edit').click(function(e){
            e.stopPropagation();
            $(this).closest('tr').find('.editableTD').editable('toggle');
            // $('.editableTD').editable('toggle');
            // $('.edit').hide();
        });

        $(".spanclose").click(function(e){
            $(this).closest('td').find('.tablearama').val('');
        });
		$('.date').daterangepicker({
			singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Temizle',
                firstDay: 1,
                daysOfWeek: ["Pzt" ,"Salı", "Çarş", "Perş" ,"Cuma", "Ctesi", "Pazar"],
                monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık"]
            }
        });
        $('.dateara').daterangepicker({
			singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Temizle',
                firstDay: 1,
                daysOfWeek: ["Pzt" ,"Salı", "Çarş", "Perş" ,"Cuma", "Ctesi", "Pazar"],
                monthNames: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık"]
            }
        });
        $('.dateara').val('');
        $(".hesap").focusout(function() {
            var kdvsi = $(this).closest('tr').find(".hesapla").val();
            var gresmitutar = $(this).closest('tr').find(".hesapbakiye2").val();
            console.log(kdvsi);
            var tutar = $(this).val();
            var sadecekdv = 0;
            var toplam = 0;
            var toplamtutar = 0;
            if(kdvsi==0){
                sadecekdv = 0;
                toplam = tutar;
                console.log("asd");
            }else{
                toplam = tutar/(100+parseInt(kdvsi))*100;
                sadecekdv = tutar*(parseInt(kdvsi))/100;
            }
            console.log(gresmitutar);
            if(gresmitutar){
                toplamtutar = toplam + gresmitutar;
            }else{
                toplamtutar = toplam;
            }
            console.log(toplamtutar);
            $(this).closest('tr').find(".hesapbakiyekdv").val(parseFloat(sadecekdv).toFixed(2));
            $(this).closest('tr').find(".hesapbakiye").val(parseFloat(toplam).toFixed(2));
            $(this).closest('tr').find(".hesapbakiye3").val(parseFloat(toplamtutar).toFixed(2));
        });
        $(".hesapla").change(function(){
            var kdvsi = $(this).val();
            var gresmitutar = $(this).closest('tr').find(".hesapbakiye2").val();
            var tutar = 0;
            var toplamtutar = 0;
            var sadecekdv = 0;
            $(this).closest('tr').find(".hesap").each(function( i, ele ) {
                if($(ele).val() && $(ele).val()!=0){
                    tutar = $(ele).val();
                }
            });
            var toplam = 0;
            console.log(tutar);
            if(kdvsi==0){
                toplam = tutar;
                sadecekdv = 0;
            }else{
                sadecekdv = tutar*(parseInt(kdvsi))/100;
                toplam = tutar/(100+parseInt(kdvsi))*100;
            }
            console.log(gresmitutar);
            if(gresmitutar){
                toplamtutar = toplam + gresmitutar;
            }else{
                toplamtutar = toplam;
            }
            console.log(toplamtutar);
            $(this).closest('tr').find(".hesapbakiyekdv").val(parseFloat(sadecekdv).toFixed(2));
            $(this).closest('tr').find(".hesapbakiye").val(parseFloat(toplam).toFixed(2));
            $(this).closest('tr').find(".hesapbakiye3").val(parseFloat(toplamtutar).toFixed(2));
        });
        $(".hesapbakiye2").focusout(function() { 
            var resmitutar = $(this).closest('tr').find(".hesapbakiye").val();
            var tutar = parseFloat($(this).val());
            var sadecekdv = 0;
            var toplam = 0;
            var toplamtutar = 0;
            if(resmitutar){
            console.log(tutar + parseFloat(resmitutar));
                toplamtutar = tutar + parseFloat(resmitutar);
            }else{
                toplamtutar = tutar;
            }
            $(this).closest('tr').find(".hesapbakiye3").val(parseFloat(toplamtutar).toFixed(2));
        });
        $(".popoverselect").each(function(){
            var a = $(this).find('option:selected').text();
            console.log(a);
            $(this).closest('td').data('content', a);
            console.log($(this).closest('td').data('content'));
        });
        $("td").on( "mouseleave", function() {
            $('.popaciklama').popover('hide');
        });
        Dropzone.options.dropzone =
        {
            success: function(file, response) 
            {
                $.get("{{url('document/expensedata')}}/"+$("#typeidup").val()).done(function( data ) {
                    $("#belgeler>tbody>tr").remove();
                    console.log(data);
                    jQuery.each( data, function( i, val ) {
                        $("#belgeler>tbody").append('<tr id="resimler'+val.id+'"><td>'+val.filename+'</td><td><button class="btn btn-danger edit btn-sm" onclick="silmeResim('+val.id+')"><i class="la la-trash"></i></button></td></tr>');
                    });
                });
            },
            error: function(file, response)
            {
               return false;
            }
        };
        function safeSelect(id){
            window.location.href = "{{ url('safeaccount?firm='.request()->firm) }}&safe="+id;
        }
        function subClass(e){
            var idsi = $(e).val();
            $.get("{{url('ajax/mainclass')}}", {mainclassid: idsi, firmid: '{{request()->firm}}'}).done(function( data ) {
                $(e).closest('tr').find(".subclass option").remove();
                console.log(data);
                jQuery.each( data, function( i, val ) {
                    $(e).closest('tr').find(".subclass").append('<option value="'+i+'">'+val+'</option>');
                });
            });
        }
        function yeniSatir(){
            $(".yenisatir").removeClass('hide');
        }
        function satirEdit(id, e){
            a1 = $("#veri"+id+" input[name=tip]" ).val();
            a2 = $("#veri"+id+" input[name=borcluolunan]" ).val();
            a3 = $("#veri"+id+" input[name=tarih]" ).val();
            a4 = $("#veri"+id+" input[name=detaynot]" ).val();
            a5 = $("#veri"+id+" select[name=matrah]" ).val();
            a6 = $("#veri"+id+" select[name=kdv]" ).val();
            a7 = $("#veri"+id+" input[name=resmitutar]").val();
            a8 = $("#veri"+id+" input[name=gresmitutar]").val();
            a9 = $("#veri"+id+" input[name=toplamtutar]").val();
            a10 = $("#veri"+id+" select[name=monthperiod]" ).val();
            a11 = $("#veri"+id+" select[name=privateperiod]" ).val();
            $(e).closest('tr').find('input, select').prop("disabled", false);
            $('.popaciklama').popover('dispose');
            $(e).closest('tr').find('.popoverli').removeClass("popaciklama");
            $(e).closest('td').find('.kaydetBtn').removeClass('hide');
            $(e).closest('td').find('.editBtn').addClass('hide');
            $('.popaciklama').popover();
        }
        function satirCancel(id, e){
            console.log(a9);
            $("#veri"+id+" input[name=tip]" ).val(a1);
            $("#veri"+id+" input[name=borcluolunan]" ).val(a2);
            $("#veri"+id+" input[name=tarih]" ).val(a3);
            $("#veri"+id+" input[name=detaynot]" ).val(a4);
            $("#veri"+id+" select[name=matrah]" ).val(a5);
            $("#veri"+id+" select[name=kdv]" ).val(a6);
            $("#veri"+id+" input[name=resmitutar]").val(a7);
            $("#veri"+id+" input[name=gresmitutar]").val(a8);
            $("#veri"+id+" input[name=toplamtutar]").val(a9);
            $("#veri"+id+" select[name=monthperiod]" ).val(a10);
            $("#veri"+id+" select[name=privateperiod]" ).val(a11);
            $(e).closest('tr').find('input, select').prop("disabled", true);
            $('.popaciklama').popover('dispose');
            $(e).closest('tr').find('.popoverli').addClass("popaciklama");
            $(e).closest('td').find('.editBtn').removeClass('hide');
            $(e).closest('td').find('.kaydetBtn').addClass('hide');
            $('.popaciklama').popover();
        }
        function belgeYukleme(id){
            // $('.openBtn').on('click',function(){
                $("#typeup").val('expensedata');
                $("#typeidup").val(id);
                $.get("{{url('document/expense')}}/"+id).done(function( data ) {
                    $("#belgeler>tbody>tr").remove();
                    console.log(data);
                    jQuery.each( data, function( i, val ) {
                        $("#belgeler>tbody").append('<tr id="resimler'+val.id+'"><td>'+val.filename+'</td><td><button class="btn btn-danger edit btn-sm" onclick="silmeResim('+val.id+')"><i class="la la-trash"></i></button></td></tr>');
                    });
                });
                $('#exampleModal').modal({show:true});
            // });
        }
        function silmeResim(id){
            console.log("{{url('document/delete')}}/"+id);
            $.get("{{url('document/delete')}}/"+id).done(function(data){
                console.log(data);
                if(data.sonuc){
                    $("#belgeler #resimler"+id).remove();
                }
            });
        }
    </script>
@endsection