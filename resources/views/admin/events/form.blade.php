<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}

            {!! Form::myTextArea('description', 'Description') !!}


            {!! Form::myInput('text','phone_number','Phone Number') !!}

            {!! Form::myInput('email','email','Email') !!}

            <div class="form-group">
                {!! Form::myInput('text','address', 'Address',['id'=>'address-input','class'=>'form-control map-input']) !!}
                {!! Form::myInput('hidden','latitude','',['id'=>'address-latitude','step'=>'0.000001'])!!}
                {!! Form::myInput('hidden','longitude','',['id'=>'address-longitude','step'=>'0.000001']) !!}

            </div>
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>

            {{-- input latitude dan lognitude nanti pake map --}}
            {{-- {{ dd($event) }} --}}
            {!! Form::myInput('date','start_date','Start Date',['id'=>'start_date']) !!}
            {!! Form::myInput('date','end_date','End Date',['id'=>'end_date']) !!}

            {!! Form::myTextArea('term_and_condition', 'Term and Condition') !!}

            {{-- {!! Form::myInput('text','instagram','Instagram') !!} --}}
            <div class='form-group'>
                {!! Form::label('instagram','Instagram') !!}
                <br>
                <small>Untuk Isi Tidak Perlu Menambahkan @ pada inputan</small>
                {!! Form::input('text', 'instagram', null, array_merge(["class" => "form-control"])) !!}
            </div>


            {!! Form::myInput('url','website','Website') !!}

            {!! Form::myInput('number','capacity','Capacity') !!}


            {!! Form::myFile('event_photo[]','Event Photo',['multiple'=>true]) !!}



        </div>
    </div>
    @if (isset($item) && $item->avatar)
    <div class="col-sm-4">
        <div class="bgc-white p-20 bd">
            <img src="{{ $item->avatar }}" alt="">
        </div>
    </div>
    @endif
</div>
@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
<script src="{{ asset('js/map.js') }}"></script>
<script>
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10) month = '0' + month.toString();
        if (day < 10) day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;

        // alert(maxDate);
        $('#start_date').attr('min', maxDate);
        $('#end_date').attr('min', maxDate);
    });

</script>

@endpush
