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
                                <a class="{{$firm->id == request()->firm ? 'selected' : ''}} item link" href="{{ url('safeaccount?firm='.$firm->id) }}"><img src="{{ url($firm->logo) }}"></a>
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
            <div class="row">
                <div class="col-12 mt-5">
                    @if($firmselect)
                        <h2>KASALAR</h2>
                        <form action="{{url('safeaccount/new')}}" method="post" enctype="multipart/form-data" id="kategoriekleform" class="form-inline">
                            <div class="form-group">
                                <label for="urunadi">Kasa Adı:</label>
                                <input type="text" class="form-control" id="name" name="safe_name">
                            </div>
                            {{ csrf_field() }}
                            <input type="hidden" name="firm" value="{{ request()->firm}}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        </form>
                        <hr>
                        <div class="table-responsive tableheight visible-scroll">
                            <table id="kasalar" class="table table-bordered mb-0">
                                <thead>
                                    <tr><th>KASA ADI</th><th>BAKİYE</th><th width="200"></th></tr>
                                </thead>
                                <tbody>
                                    @foreach($firmselect->safe_accounts as $safe)
                                        <tr onclick="safeSelect({{$safe->id}}, this)" class="{{ request()->safe == $safe->id ? 'selected' : ''}}">
                                            <td class="editableTD" data-name="safe_name" data-type="text" data-pk="{{$safe->id}}">{{$safe->name}}</td>
                                            <td>{{ number_format($safe->total/100, 2, ',', '.') }}</td>
                                            <td><button class="btn btn-info edit btn-sm"><i class="la la-edit"></i></button> <a href="{{url('safe/delete')}}/{{$safe->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h2>Lütfen firma seçin</h2>
                    @endif
                </div>
            </div>
            <hr>
            @if($safeselect)
                <div class="row mt-5 minheight600">
                    <div class="col-sm-12">
                        @if($hatalitoplam != 0)
                            <div class="alert alert-danger" role="alert">
                                Birbirini götüren hareketlerde toplam hatası var.
                            </div>
                        @endif
                        <button type="button" class="btn btn-primary" onclick="yeniSatir()"><i class="la la-plus"></i> Veri Ekle</button>
                        <form action="{{url('safe/approve')}}" class=" pull-right" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{json_encode($safeselect)}}" name="secilmisler">
                            <button type="submit" class="btn btn-primary"><i class="la la-check-circle"></i> Tümünü Onayla</button>
                        </form>
                        <h1></h1>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
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
                                        <td>BELGE</td>
                                        <td>ONAY</td>
                                        <td>İŞLEMLER</td>
                                    </tr>
                                    <form action="" method="get">
                                        <input type="hidden" name="firm" value="{{request()->firm}}">
                                        <input type="hidden" name="safe" value="{{request()->safe}}">
                                        <tr class="trarama" style="background: #fff;">
                                            <td>
                                                <input type="text" name="aratarih" class="form-control tablearama dateara" value="{{request()->aratarih}}">
                                                <span class="spanclose"><i class="la la-close"></i></span>
                                            </td>
                                            <td><input type="text" name="arabanka" class="form-control tablearama" value="{{request()->arabanka}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="aradetay" class="form-control tablearama" value="{{request()->aradetay}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="araproje" class="form-control tablearama" value="{{request()->araproje}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="number" name="aragiren" class="form-control tablearama" value="{{request()->aragiren}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="number" name="aracikan" class="form-control tablearama" value="{{request()->aracikan}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td style="background: #ccc"><!--<input type="text" name="tarih" class="form-control tablearama"><span class="spanclose"><i class="la la-close"></i></span>--></td>
                                            <td>
                                                <select name="arakdv" class="form-control tablearama">
                                                    <option value="" {{request()->arakdv=="" ? 'selected' : ''}}>SEÇİN</option>
                                                    <option value="0" {{request()->arakdv != '' && request()->arakdv==0 ? 'selected' : ''}}>% 0</option>
                                                    <option value="1" {{request()->arakdv==1 ? 'selected' : ''}}>% 1</option>
                                                    <option value="8" {{request()->arakdv==8 ? 'selected' : ''}}>% 8</option>
                                                    <option value="18" {{request()->arakdv==18 ? 'selected' : ''}}>% 18</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="aramain" class="form-control mainclassid" onchange="subClass(this)">
                                                    <option value="" {{request()->aramain=='' ? 'selected' : ''}}>SEÇİN</option>
                                                    @foreach($mainclasses as $mainclass)
                                                        <option value="{{$mainclass->id}}" {{request()->aramain==$mainclass->id ? 'selected' : ''}}>{{$mainclass->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="arasub" class="form-control subclass">
                                                    <option value="" {{request()->arasub=='' ? 'selected' : ''}}>SEÇİN</option>
                                                </select>    
                                            </td>
                                            <td><input type="text" name="aramonth" class="form-control tablearama" value="{{request()->aramonth}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td><input type="text" name="araozel" class="form-control tablearama" value="{{request()->araozel}}"><span class="spanclose"><i class="la la-close"></i></span></td>
                                            <td style="background: #ccc"></td>
                                            <td>
                                                <select name="araapprove" class="form-control tablearama">
                                                    <option value="" {{request()->araapprove=="" ? 'selected' : ''}}>HEPSİ</option>
                                                    <option value="1" {{request()->araapprove==1 ? 'selected' : ''}}>ONAYLI</option>
                                                    <option value="2" {{request()->araapprove==2 ? 'selected' : ''}}>ONAYSIZ</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-success btn-sm"><i class="la la-search"></i></button> <a href="{{url('safeaccount?firm='.request()->firm.'&safe='.request()->safe)}}" class="btn btn-danger btn-sm" onclick="temizle()"><i class="la la-close"></i></a></td>
                                        </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    <tr class="trarama hide yenisatir">
                                        <form action="{{url('safedata')}}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="safe_account_id" value="{{request()->safe}}">
                                            @csrf
                                        <td><input type="text" class="form-control tablearama date" name="tarih"></td>
                                        <td><input type="text" class="form-control tablearama" name="bankanot"></td>
                                        <td><input type="text" class="form-control tablearama" name="detaynot"></td>
                                        <td><input type="text" class="form-control tablearama" name="proje"></td>
                                        <td><input type="text" class="form-control tablearama hesap hesapmask" name="giren"></td>
                                        <td><input type="text" class="form-control tablearama hesap hesapmask" name="cikan"></td>
                                        <td><input type="text" class="form-control tablearama hesapbakiye" readonly></td>
                                        <td>
                                            <select name="kdv" class="form-control hesapla">
                                                <option value="0">% 0</option>
                                                <option value="1">% 1</option>
                                                <option value="8">% 8</option>
                                                <option value="18">% 18</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mainclass" class="form-control mainclassid" onchange="subClass(this)">
                                                @foreach($mainclasses as $mainclass)
                                                    <option value="{{$mainclass->id}}">{{$mainclass->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="subclass" class="form-control subclass">
                                                @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
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
                                        <td>
                                            <input type="checkbox" class="uiswitch custom" name="approve">
                                        </td>
                                        <td><button type="submit" class="btn btn-primary btn-sm"><i class="la la-save"></i></button></td>
                                        </form>
                                    </tr>
                                    @foreach($safeselect as $ss)
                                        <tr class="trarama" id="veri{{$ss->id}}"
                                            @foreach($mainclasses as $mainclass)
                                                @if($ss->main_class_id==$mainclass->id)
                                                    style="background:{{$mainclass->color}}"
                                                @endif
                                            @endforeach
                                        >
                                            <form action="{{url('safedata/'.$ss->id)}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="safe_account_id" value="{{request()->safe}}">
                                            @csrf
                                            <td><input type="text" class="form-control tablearama date" disabled name="tarih" value="{{date('d-m-Y', strtotime(str_replace('-', '/', $ss->data_date)))}}"></td>
                                            <td title="Banka Açıklama" data-trigger="hover" data-content="{{$ss->banknote}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" disabled name="bankanot" value="{{$ss->banknote}}"></td>
                                            <td title="Detay Açıklama" data-trigger="hover" data-content="{{$ss->detailnote}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" disabled name="detaynot" value="{{$ss->detailnote}}"></td>
                                            <td title="Proje" data-trigger="hover" data-content="{{$ss->project}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" disabled name="proje" value="{{$ss->project}}"></td>
                                            <td><input type="text" class="form-control tablearama hesap" disabled name="giren" value="{{ $ss->incoming>0 ? number_format($ss->incoming/100, 2, ",", ".") : '' }}"></td>
                                            <td><input type="text" class="form-control tablearama hesap" disabled name="cikan" value="{{ $ss->outgoing>0 ? number_format($ss->outgoing/100, 2, ",", ".") : '' }}"></td>
                                            <td><input type="text" class="form-control tablearama hesapbakiye" value="{{$ss->incoming!=0||$ss->incoming!='' ? number_format($ss->incoming/(100+$ss->tax),2,',','.') : number_format($ss->outgoing/(100+$ss->tax),2,',','.')}}" disabled readonly></td>
                                            <td>
                                                <select name="kdv" class="form-control hesapla" disabled>
                                                    <option value="0" {{$ss->tax==0 ? 'selected' : ''}}>% 0</option>
                                                    <option value="1" {{$ss->tax==1 ? 'selected' : ''}}>% 1</option>
                                                    <option value="8" {{$ss->tax==8 ? 'selected' : ''}}>% 8</option>
                                                    <option value="18" {{$ss->tax==18 ? 'selected' : ''}}>% 18</option>
                                                </select>
                                            </td>
                                            <td title="Kalem Ana Sınıfı" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                <select name="mainclass" class="form-control popoverselect" onchange="subClass(this)" disabled>
                                                    @foreach($mainclasses as $mainclass)
                                                        <option value="{{$mainclass->id}}" {{$ss->main_class_id==$mainclass->id ? 'selected' : ''}}>{{$mainclass->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td title="Kalem Alt Sınıfı" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                <select name="subclass" class="form-control subclass popoverselect" disabled>
                                                    @if($ss->main_class_id==1)
                                                        @foreach($customers as $customer)
                                                            <option value="{{$customer->id}}" {{$ss->sub_class_id==$customer->id ? 'selected' : ''}}>{{$customer->name}}</option>
                                                        @endforeach
                                                    @elseif($ss->main_class_id==2)
                                                        @foreach($expense as $customer)
                                                            <option value="{{$customer->id}}" {{$ss->sub_class_id==$customer->id ? 'selected' : ''}}>{{$customer->name}}</option>
                                                        @endforeach
                                                    @elseif($ss->main_class_id==3||$ss->main_class_id==4||$ss->main_class_id==5)
                                                        @foreach($personel as $customer)
                                                            <option value="{{$customer->id}}" {{$ss->sub_class_id==$customer->id ? 'selected' : ''}}>{{$customer->name}}</option>
                                                        @endforeach
                                                    @elseif($ss->main_class_id==6)
                                                        @foreach($ortaklar as $customer)
                                                            <option value="{{$customer->id}}" {{$ss->sub_class_id==$customer->id ? 'selected' : ''}}>{{$customer->name}}</option>
                                                        @endforeach
                                                    @elseif($ss->main_class_id==7)
                                                        @foreach($safeaccounts as $customer)
                                                            <option value="{{$customer->id}}" {{$ss->sub_class_id==$customer->id ? 'selected' : ''}}>{{$customer->name}}</option>
                                                        @endforeach
                                                    @else

                                                    @endif
                                                </select>
                                            </td>
                                            <td title="Ay Dönemi" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                <select name="monthperiod" class="form-control popoverselect" disabled>
                                                    @foreach($monthperiods as $monthperiod)
                                                        <option value="{{$monthperiod->id}}" {{$ss->month_period_id==$monthperiod->id ? 'selected' : ''}}>{{$monthperiod->m_name.' '.$monthperiod->y_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td title="Özel Dönem" data-trigger="hover" data-content="" class="popoverli popaciklama">
                                                <select name="privateperiod" class="form-control popoverselect" disabled>
                                                    @foreach($privateperiods as $privateperiod)
                                                        <option value="{{$privateperiod->id}}" {{$ss->private_period_id==$privateperiod->id ? 'selected' : ''}}>{{$privateperiod->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm openBtn" onclick="belgeYukleme({{$ss->id}})"><i class="fa fa-plus"></i></button>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="uiswitch custom" name="approve" disabled {{ $ss->approve==1 ? 'checked' : ''}}>
                                            </td>
                                            <td><span class="hide kaydetBtn"><button type="submit" class="btn btn-primary btn-sm"><i class="la la-save"></i></button> <button type="button" class="btn btn-danger btn-sm" onclick="satirCancel({{$ss->id}}, this)"><i class="la la-close"></i></button></span><span class="editBtn"><button type="button" class="btn btn-info btn-sm" onclick="satirEdit({{$ss->id}}, this)"><i class="la la-edit"></i></button> <a href="{{url('safedata/delete')}}/{{$ss->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></span></td>
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
    <script src="{{ url('assets/vendors/js/mask/jquery.mask.min.js') }}"></script>
    <script src="{{ url('assets/vendors/js/mask/account.js') }}"></script>
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
            $('.hesapmask').mask('000.000.000.000.000,00', {reverse: true});
            $(".hesapbakiye").mask('000.000.000.000.000,00', {reverse: true});
            $('.popaciklama').popover();
            $('.editableTD').editable({
                mode: 'inline',
                url: '{{ url("safe/ajax/save") }}',
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
            var tutar = $(this).val().replace(/\./g,'').replace(',','');
            console.log(tutar);
            if(tutar){
                var toplam = 0;
                if(kdvsi==0){
                    toplam = tutar;
                    console.log("asd");
                }else{
                    toplam = tutar/(100+parseInt(kdvsi))*100;
                }
                toplam = toplam/100;
                // $(this).closest('tr').find(".hesapbakiye").val(parseFloat(toplam).toFixed(2));
                $(this).closest('tr').find(".hesapbakiye").val(accounting.formatMoney(toplam, "", 2, ".", ","));
            }
        });
        $(".hesapla").change(function(){
            var kdvsi = $(this).val();
            var tutar = 0;
            $(this).closest('tr').find(".hesap").each(function( i, ele ) {
                if($(ele).val() && $(ele).val()!=0){
                    tutar = $(ele).val().replace(/\./g,'').replace(',','');
                }
            });
            var toplam = 0;
            console.log(tutar);
            if(kdvsi==0){
                toplam = tutar;
            }else{
                toplam = tutar/(100+parseInt(kdvsi))*100;
            }
            toplam = toplam/100;
            // $(".hesapbakiye").mask('000.000.000.000.000,00', {reverse: true});
            console.log(accounting.formatMoney(toplam, "", 2, ".", ","));
            $(this).closest('tr').find(".hesapbakiye").val(accounting.formatMoney(toplam, "", 2, ".", ","));
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
                $.get("{{url('document/safe')}}/"+$("#typeidup").val()).done(function( data ) {
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
        function safeSelect(id, e){
            $(e).find('.editableTD').editable('hide');
            console.log($(e).find('.editableTD'));
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
            a1 = $("#veri"+id+" input[name=tarih]" ).val();
            a2 = $("#veri"+id+" input[name=bankanot]" ).val();
            a3 = $("#veri"+id+" input[name=detaynot]" ).val();
            a4 = $("#veri"+id+" input[name=proje]" ).val();
            a5 = $("#veri"+id+" input[name=giren]" ).val();
            a6 = $("#veri"+id+" input[name=cikan]" ).val();
            a7 = $("#veri"+id+" select[name=kdv]" ).val();
            a8 = $("#veri"+id+" select[name=mainclass]" ).val();
            a9 = $("#veri"+id+" select[name=subclass]" ).val();
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
            $("#veri"+id+" input[name=tarih]" ).val(a1);
            $("#veri"+id+" input[name=bankanot]" ).val(a2);
            $("#veri"+id+" input[name=detaynot]" ).val(a3);
            $("#veri"+id+" input[name=proje]" ).val(a4);
            $("#veri"+id+" input[name=giren]" ).val(a5);
            $("#veri"+id+" input[name=cikan]" ).val(a6);
            $("#veri"+id+" select[name=kdv]" ).val(a7);
            $("#veri"+id+" select[name=mainclass]" ).val(a8);


            $.get("{{url('ajax/mainclass')}}", {mainclassid: a8, firmid: '{{request()->firm}}'}).done(function( data ) {
                $(e).closest('tr').find(".subclass option").remove();
                console.log(data);
                jQuery.each( data, function( i, val ) {
                    $(e).closest('tr').find(".subclass").append('<option value="'+i+'">'+val+'</option>');
                });

                $("#veri"+id+" select[name=subclass]" ).val(a9);
            });
            // subClass("#veri"+id+" select[name=mainclass]").done(function(){
            //     $("#veri"+id+" select[name=subclass]" ).val(a9);
            // })
            
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
                $("#typeup").val('safe');
                $("#typeidup").val(id);
                $.get("{{url('document/safe')}}/"+id).done(function( data ) {
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