<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}

            <div class='form-group'>
                {!! Form::label('price_include','Price Include') !!}
                <br>
                <small>Untuk Isi Price Include Setiap Item Diberikan tanda ~ sebagai pemisah</small>
                {!! Form::textarea('price_include', null, array_merge(["class" => "form-control", "rows"=> 3,"placeholder"=>'~item 1 ~item 2'])) !!}
            </div>

            {{-- {!! Form::myTextArea('price_include','Price Include') !!} --}}

            <div class='form-group'>
                {!! Form::label('price_exclude','Price Exclude') !!}
                <br>
                <small>Untuk Isi Price Exclude Setiap Item Diberikan tanda ~ sebagai pemisah</small>
                {!! Form::textarea('price_exclude', null, array_merge(["class" => "form-control", "rows"=> 3,"placeholder"=>'~item 1 ~item 2'])) !!}
            </div>

            {{-- {!! Form::myTextArea('price_exclude','Price Exclude') !!} --}}

            <div class='form-group'>
                {!! Form::label('activities','Activities') !!}
                <br>
                <small>Untuk Isi Activities Setiap Item Diberikan tanda ~ sebagai pemisah</small>
                {!! Form::textarea('activities', null, array_merge(["class" => "form-control", "rows"=> 3,"placeholder"=>'~activity 1 ~activity 2'])) !!}
            </div>

            {{-- {!! Form::myTextArea('activities','Activities') !!} --}}

            <div class='form-group'>
                {!! Form::label('destination','Destinations') !!}
                <br>
                <small>Untuk Isi Destinations Setiap Item Diberikan tanda ~ sebagai pemisah</small>
                {!! Form::textarea('destination', null, array_merge(["class" => "form-control", "rows"=> 3,"placeholder"=>'~destination 1 ~destination 2'])) !!}
            </div>

            {{-- {!! Form::myTextArea('destination','Destination') !!} --}}

            {!! Form::mySelect('package_category', 'Package Category', $categories, $packageCategory ? $packageCategory->first()->id : null , ['class' => 'form-control select2']) !!}

            {!! Form::myFile('package_photo','Package Photo') !!}

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
