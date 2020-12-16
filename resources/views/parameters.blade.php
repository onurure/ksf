@extends('layouts.sone')
@section('pagecss')
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-editable.css') }}">
    <style>
        .editable-buttons{margin-top: 6px;}
        .btn-primary i,.btn-danger i{margin-right: 0px !important}
        .tableheight{max-height: 250px;overflow-y: scroll;}
        .colorpicker-inline.colorpicker-visible{
            display: block;
        }
    </style>
@endsection
@section('content') 
    <div class="row">
        <div class="col-xl-4">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>Müşteri Listesi</h4>
                </div>
                <div class="widget-body">
                    <form action="" method="post" enctype="multipart/form-data" id="kategoriekleform" class="form-inline">
                        <div class="form-group">
                            <label for="urunadi">Müşteri Adı:</label>
                            <input type="text" class="form-control" id="name" name="customer_name">
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="customer" value="1">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </form>
                    <hr>
                    <div class="table-responsive tableheight visible-scroll">
                        <table class="tableedit table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2">Müşteriler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($customers))
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td class="editableTD" data-name="customer" data-type="text" data-pk="{{$customer->id}}">{{$customer->name}}</td>
                                            <td><a href="{{url('customer/delete')}}/{{$customer->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>Gider Sınıfları</h4>
                </div>
                <div class="widget-body">
                    <form action="" method="post" enctype="multipart/form-data" id="kategoriekleform" class="form-inline">
                        <div class="form-group">
                            <label for="urunadi">Gider Adı:</label>
                            <input type="text" class="form-control" id="name" name="expense_name">
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="expense" value="1">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </form>
                    <hr>
                    <div class="table-responsive tableheight">
                        <table class="tableedit table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2">Giderler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($expenses))
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td class="editableTD" data-name="expense" data-type="text" data-pk="{{$expense->id}}">{{$expense->name}}</td>
                                            <td><a href="{{url('param/delete/expense')}}/{{$expense->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>Özel Dönemler</h4>
                </div>
                <div class="widget-body">
                    <form action="" method="post" enctype="multipart/form-data" id="kategoriekleform" class="form-inline">
                        <div class="form-group">
                            <label for="urunadi">Özel Dönem:</label>
                            <input type="text" class="form-control" id="name" name="private_period_name">
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="private_period" value="1">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </form>
                    <hr>
                    <div class="table-responsive tableheight">
                        <table class="tableedit table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2">Özel Dönem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($privateperiods))
                                    @foreach($privateperiods as $privateperiod)
                                        <tr>
                                            <td class="editableTD" data-name="private_peroid" data-type="text" data-pk="{{$privateperiod->id}}">{{$privateperiod->name}}</td>
                                            <td><a href="{{url('param/delete/privateperiod')}}/{{$privateperiod->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></td>
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
    <div class="row">
        <div class="col-xl-6">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>Kalem Ana Sınıfı</h4>
                </div>
                <div class="widget-body">
                    <div class="table-responsive tableheight">
                        <table class="tableedit table mb-0">
                            <thead>
                                <tr>
                                    <th>Ana Sınıf</th>
                                    <th>Renk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($mainclasses))
                                    @foreach($mainclasses as $mainclass)
                                        <tr>
                                            <td>{{$mainclass->name}}</td>
                                            {{-- <td>
                                                <div id="cp2" class="input-group colorpicker-component">
                                                    <input type="text" value="#00AABB" class="form-control" />
                                                    <span class="input-group-addon"><i></i></span>
                                                </div>
                                            </td> --}}
                                            <td class="editableTDColor" data-name="mainclass" data-type="text" data-pk="{{$mainclass->id}}"><span class="spanClass">{{$mainclass->color}}</span></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                    <h4>Ay Dönemleri</h4>
                </div>
                <div class="widget-body">
                    <form action="" method="post" enctype="multipart/form-data" id="kategoriekleform" class="form-inline">
                        <label for="urunadi">Ay: </label>
                        <input type="text" class="form-control" id="name" name="ay">
                        <label for="urunadi"> Yıl: </label>
                        <input type="text" class="form-control" id="name" name="yil">
                        {{ csrf_field() }}
                        <input type="hidden" name="month_period" value="1">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </form>
                    <hr>
                    <div class="table-responsive tableheight">
                        <table class="tableedit table mb-0">
                            <thead>
                                <tr>
                                    <th>Ay</th>
                                    <th>Yıl</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($monthperiods))
                                    @foreach($monthperiods as $monthperiod)
                                        <tr>
                                            <td class="editableTD" data-name="m_name" data-type="text" data-pk="{{$monthperiod->id}}">{{$monthperiod->m_name}}</td>
                                            <td class="editableTD" data-name="y_name" data-type="text" data-pk="{{$monthperiod->id}}">{{$monthperiod->y_name}}</td>
                                            <td><a href="{{url('param/delete/monthperiod')}}/{{$monthperiod->id}}" onclick="return confirm('Silme işlemi geri alnımaz. Yine de silmek istiyor musunuz?')" class="btn btn-danger btn-sm"><i class="la la-trash delete"></i></a></td>
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
@endsection
@section('pagejs')  
    <script src="{{ url('assets/js/bootstrap-editable.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-colorpicker.min.js') }}"></script>
@endsection
@section('pagecustomjs')
<script>
    $(document).ready(function() {
        $('.tableedit tbody tr td.editableTD, .tableedit tbody tr td.editableTDColor').editable({
            mode: 'inline',
            url: '{{ url("parameter/save") }}',
        });
        $('.tableedit tbody tr td.editableTDColor').on('shown', function(e, editable) {
            $('.editable-input').colorpicker({
                container: true,
                inline: true
            });
        });
    });
    (function(a){a(".basic-scroll").niceScroll({railpadding:{top:0,right:-2,left:0,bottom:0},scrollspeed:60,zindex:1,autohidemode:"leave",cursorwidth:"4px",cursorcolor:"rgba(52, 40, 104, 0.2)",cursorborder:"rgba(52, 40, 104, 0.2)"});a(".visible-scroll").niceScroll({railpadding:{top:0,right:-2,left:0,bottom:0},scrollspeed:60,zindex:1,autohidemode:false,cursorwidth:"4px",cursorcolor:"rgba(52, 40, 104, 0.2)",cursorborder:"rgba(52, 40, 104, 0.2)"});a(".horizontal-scroll").niceScroll({railpadding:{top:0,right:-10,left:0,bottom:-10},scrollspeed:60,zindex:1,autohidemode:false,horizrailenabled:true,railvalign:"bottom",cursorwidth:"4px",cursorcolor:"rgba(52, 40, 104, 0.2)",cursorborder:"rgba(52, 40, 104, 0.2)"});a(".grab-scroll").niceScroll({railpadding:{top:0,right:-10,left:0,bottom:-10},scrollspeed:60,zindex:1,emulatetouch:true,grabcursorenabled:true,autohidemode:false,horizrailenabled:true,railvalign:"bottom",cursorwidth:"4px",cursorcolor:"rgba(52, 40, 104, 0.2)",cursorborder:"rgba(52, 40, 104, 0.2)"})})(jQuery);
</script>
@endsection