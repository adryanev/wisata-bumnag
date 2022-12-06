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

            {!! Form::myInput('time','opening_hours','Opening Hours',['step'=>'2']) !!}
            {!! Form::myInput('time','closing_hours','Closing Hours',['step'=>'2']) !!}

            {{-- {!! Form::myInput('text','instagram','Instagram') !!} --}}

            <div class='form-group'>
                {!! Form::label('instagram','Instagram') !!}
                <br>
                <small>Untuk Isi Tidak Perlu Menambahkan @ pada inputan</small>
                {!! Form::input('text', 'instagram', null, array_merge(["class" => "form-control"])) !!}
            </div>

            {!! Form::myInput('url','website','Website') !!}

            {!! Form::myInput('number','capacity','Capacity') !!}

            {{-- {!! Form::myInput('text','working_day','Working Day',['placeholder'=>'senin-rabu,kamis-jumat']) !!} --}}
            <div class='form-group'>
                {!! Form::label('working_day','Working Day') !!}
                <br>
                <small>Untuk isi Setiap Hari Silahkan isi Senin-Minggu</small>
                {!! Form::input('text', 'working_day', null, array_merge(["class" => "form-control"], ["placeholder"=>"senin-rabu,kamis-jumat"])) !!}
            </div>

            {!! Form::myFile('destination_photo[]','Destination Photo',['multiple'=>true]) !!}

            {!! Form::mySelect('destination_category', 'Destination Category', $categories, $destinationCategory ? $destinationCategory->id : null , ['class' => 'form-control select2']) !!}


        </div>
    </div>
</div>

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
<script src="{{ asset('js/map.js') }}"></script>
@endpush
