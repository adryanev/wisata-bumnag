<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Full Name') !!}

            {!! Form::myInput('email', 'email', 'Email') !!}

            {!! Form::myInput('text', 'nik', 'Nomor Induk Keluarga') !!}

            {!! Form::myInput('text', 'phone_number', 'Phone Number') !!}

            {!! Form::myFile('avatar','Photo Profile') !!}

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
