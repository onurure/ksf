<table class="table table-bordered mb-0">
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
    <tbody>
        @foreach($datas as $ss)
            <tr class="trarama" id="veri{{$ss->id}}"
                @foreach($mainclasses as $mainclass)
                    @if($ss->main_class_id==$mainclass->id)
                        style="background:{{$mainclass->color}}"
                    @endif
                @endforeach
            >
                <td>{{$ss->safe_account->name}}</td>
                <td><input type="text" class="form-control tablearama date" disabled name="tarih" value="{{date('d-m-Y', strtotime(str_replace('-', '/', $ss->data_date)))}}"></td>
                <td title="Banka Açıklama" data-trigger="hover" data-content="{{$ss->banknote}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" disabled name="bankanot" value="{{$ss->banknote}}"></td>
                <td title="Detay Açıklama" data-trigger="hover" data-content="{{$ss->detailnote}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" disabled name="detaynot" value="{{$ss->detailnote}}"></td>
                <td title="Proje" data-trigger="hover" data-content="{{$ss->project}}" class="popoverli popaciklama"><input type="text" class="form-control tablearama" disabled name="proje" value="{{$ss->project}}"></td>
                <td><input type="text" class="form-control tablearama hesap" disabled name="giren" value="{{ $ss->incoming>0 ? number_format($ss->incoming/100, 2, ",", ".") : '' }}"></td>
                <td><input type="text" class="form-control tablearama hesap" disabled name="cikan" value="{{ $ss->outgoing>0 ? number_format($ss->outgoing/100, 2, ",", ".") : '' }}"></td>
                <td><input type="text" class="form-control tablearama hesapbakiye" value="{{$ss->incoming!=0||$ss->incoming!='' ? number_format($ss->incoming/(100+$ss->tax),2,'.','') : number_format($ss->outgoing/(100+$ss->tax),2,'.','')}}" disabled readonly></td>
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
            </tr>
        @endforeach
    </tbody>
</table>