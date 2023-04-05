<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}
            {!! Form::myInput('number', 'price', 'Price') !!}
            {!! Form::myTextArea('description', 'Description') !!}
            {!! Form::myInput('number', 'quantity', 'Quantity') !!}
            {!! Form::mySelect('amenity_package', 'Amenity Package', $packages, $amenityPackage ? $amenityPackage->id : null , ['class' => 'form-control select2']) !!}
        </div>
    </div>
</div>
