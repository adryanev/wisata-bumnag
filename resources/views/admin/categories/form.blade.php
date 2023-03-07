<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}
            {!! Form::mySelect('category_parent', 'Destination Category', $categories, $categoryParent ? $categoryParent->id : null , ['class' => 'form-control select2']) !!}
        </div>
    </div>
</div>
