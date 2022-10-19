<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}

            {!! Form::myTextArea('description', 'Description') !!}

            {!! Form::myTextArea('address', 'Address') !!}

            {!! Form::myInput('text','phone_number','Phone Number') !!}

            {!! Form::myInput('email','email','Email') !!}

            {!! Form::myInput('number','latitude','Latitude')!!}
            {!! Form::myInput('number','longitude','Longitude') !!}
            {{-- input latitude dan lognitude nanti pake map --}}

            {!! Form::myInput('time','opening_hours','Opening Hours') !!}

            {!! Form::myInput('time','closing_hours','Closing Hours') !!}

            {!! Form::myInput('text','instagram','Instagram') !!}

            {!! Form::myInput('url','website','Website') !!}

            {!! Form::myInput('number','capasity','Capasity') !!}
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
