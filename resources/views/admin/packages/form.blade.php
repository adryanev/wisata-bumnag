<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}

            {!! Form::myTextArea('price_include','Price Include') !!}

            {!! Form::myTextArea('price_exclude','Price Exclude') !!}

            {!! Form::myTextArea('activities','Activities') !!}

            {!! Form::myTextArea('destination','Destination') !!}

            {!! Form::mySelect('package_category', 'Package Category', $categories, $packageCategory ? $packageCategory->first()->id : null , ['class' => 'form-control select2']) !!}

            {!! Form::myFile('package_photo','package Photo') !!}

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
