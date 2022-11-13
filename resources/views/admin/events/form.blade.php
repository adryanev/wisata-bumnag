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
            {{-- {{ dd($event) }} --}}
            {!! Form::myInput('date','start_date','Start Date',['id'=>'start_date']) !!}
            {!! Form::myInput('date','end_date','End Date',['id'=>'end_date']) !!}

            {!! Form::myTextArea('term_and_condition', 'Term and Condition') !!}

            {!! Form::myInput('text','instagram','Instagram') !!}

            {!! Form::myInput('url','website','Website') !!}

            {!! Form::myInput('number','capacity','Capacity') !!}


            {!! Form::myFile('event_photo','Event Photo') !!}



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
<script>
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10) month = '0' + month.toString();
        if (day < 10) day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;

        // alert(maxDate);
        $('#start_date').attr('min', maxDate);
        $('#end_date').attr('min', maxDate);
    });

</script>
