<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Full Name') !!}

            {!! Form::myInput('email', 'email', 'Email') !!}

            {!! Form::myInput('text', 'nik', 'Nomor Induk Keluarga') !!}

            {!! Form::myInput('password', 'password', 'Password') !!}

            {!! Form::myInput('password', 'password_confirmation', 'Password again') !!}

            {!! Form::myInput('text', 'phone_number', 'Phone Number') !!}

            {!! Form::mySelect('role', 'Role', $roles, $userRole ? $userRole->id : null , ['class' => 'form-control select2']) !!}

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
