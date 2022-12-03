<div class="row mB-40 mT-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">

            {!! Form::myInput('password', 'old_password', 'Old Password') !!}

            {!! Form::myInput('password', 'password', 'Password') !!}

            {!! Form::myInput('password', 'password_confirmation', 'Password again') !!}



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
