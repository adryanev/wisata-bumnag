<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}

            {!! Form::myTextArea('description', 'Description') !!}

            {!! Form::myTextArea('address', 'Address') !!}

            {!! Form::myInput('text','phone_number','Phone Number') !!}

            {!! Form::myInput('email','email','Email') !!}

            {!! Form::myInput('number','latitude','Latitude',['step'=>'0.000001'])!!}
            {!! Form::myInput('number','longitude','Longitude',['step'=>'0.000001']) !!}

            {{-- input latitude dan lognitude nanti pake map --}}

            {!! Form::myInput('time','opening_hours','Opening Hours',['step'=>'2']) !!}
            {!! Form::myInput('time','closing_hours','Closing Hours',['step'=>'2']) !!}

            {!! Form::myInput('text','instagram','Instagram') !!}

            {!! Form::myInput('url','website','Website') !!}

            {!! Form::myInput('number','capasity','Capasity') !!}

            {!! Form::myInput('text','working_day','Working Day',['placeholder'=>'senin-rabu,kamis-jumat']) !!}

            {!! Form::myFile('destination_photo','Destination Photo') !!}

            {!! Form::mySelect('destination_category', 'Destination Category', $categories, $destinationCategory ? $destinationCategory->id : null , ['class' => 'form-control select2']) !!}


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
