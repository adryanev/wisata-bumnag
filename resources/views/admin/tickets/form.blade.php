<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Name') !!}
            {!! Form::myInput('number', 'price', 'Price',[],$ticket?$ticket->price:0) !!}

            <div class="peers ai-c mB-15">
                {!! Form::radio('is_free', 0, true, ['id' => 'isPaid','onclick'=>'check()']) !!}
                &nbsp;
                {!! Form::label('isPaid', 'Is Paid', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                {!! Form::radio('is_free', 1, '', ['id' => 'isFree','onclick'=>'check()']) !!}
                &nbsp;
                {!! Form::label('isFree', 'Is Free', ['class' => 'peers peer-greed js-sb ai-c']) !!}
            </div>
            {!! Form::myTextArea('term_and_conditions','Term And Conditions') !!}

            <div>
                <p>Is Quantity Limited</p>
                <div class="peers ai-c mB-15">
                    {!! Form::radio('is_quantity_limited', 0, '', ['id' => 'isUnlimited','onclick'=>'checkQuantity()']) !!}
                    &nbsp;
                    {!! Form::label('isUnlimited', 'Is Unlimited', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                    {!! Form::radio('is_quantity_limited', 1, true, ['id' => 'isLimited','onclick'=>'checkQuantity()']) !!}
                    &nbsp;
                    {!! Form::label('isLimited', 'Is Limited', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                </div>
                {!! Form::myInput('number','quantity','Quantity',[],$ticket?$ticket->quantity:0) !!}

            </div>


            {!! Form::myTextArea('description', 'Description') !!}

            {!! Form::mySelect('ticketable_type', 'Ticketable Type', $ticketable_type, $ticket ? $ticket->ticketable_type : null , ['class' => 'form-control select2','onchange'=>'selected()','id'=>'ticketable_type']) !!}

            {!! Form::mySelect('ticketable_id', 'Ticketable Model', [''=>'select ticketable type first'], $ticket ? $ticket->ticketable_id : null , ['class' => 'form-control select2','id'=>'ticketable_id']) !!}
            <div>
                <p>Is Per Pax</p>
                <div class="peers ai-c mB-15">
                    {!! Form::radio('is_per_pax', 0, $ticket_setting ? ($ticket_setting->is_per_pax == 0)? true:'':true, ['id' => 'isNotPax','onclick'=>'checkPax()']) !!}
                    &nbsp;
                    {!! Form::label('isNotPax', 'Is Not Pax Constraint', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                    {!! Form::radio('is_per_pax', 1, $ticket_setting ? ($ticket_setting->is_per_pax == 1)? true:'':'', ['id' => 'isPax','onclick'=>'checkPax()']) !!}
                    &nbsp;
                    {!! Form::label('isPax', 'Is Pax Constraint ', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                </div>
                {!! Form::myInput('number', 'pax_constraint', 'Pax Constraint',[],$ticket_setting?$ticket_setting->pax_constraint:0) !!}
            </div>
            <div>
                <p>Is Per Day</p>
                <div class="peers ai-c mB-15">
                    {!! Form::radio('is_per_day', 0, $ticket_setting ? ($ticket_setting->is_per_day == 0)? true:'':true, ['id' => 'isNotDay','onclick'=>'checkDay()']) !!}
                    &nbsp;
                    {!! Form::label('isNotDay', 'Is Not Day Constraint', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                    {!! Form::radio('is_per_day', 1, $ticket_setting ? ($ticket_setting->is_per_day == 1)? true:'':'', ['id' => 'isDay','onclick'=>'checkDay()']) !!}
                    &nbsp;
                    {!! Form::label('isday', 'Is day Constraint ', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                </div>
                {!! Form::myInput('text', 'day_constraint', 'Day Constraint',['placeholder'=>'senin-rabu,kamis-jumat'],$ticket_setting?$ticket_setting->day_constraint:'') !!}
            </div>
            <div>
                <p>Is Per Age</p>
                <div class="peers ai-c mB-15">
                    {!! Form::radio('is_per_age', 0, $ticket_setting ? ($ticket_setting->is_per_age == 0)?true:'':true, ['id' => 'isNotAge','onclick'=>'checkAge()']) !!}
                    &nbsp;
                    {!! Form::label('isNotAge', 'Is Not Age Constraint', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                    {!! Form::radio('is_per_age', 1, $ticket_setting ? ($ticket_setting->is_per_day == 1)?true:'':'', ['id' => 'isAge','onclick'=>'checkAge()']) !!}
                    &nbsp;
                    {!! Form::label('isAge', 'Is Age Constraint ', ['class' => 'peers peer-greed js-sb ai-c']) !!}
                </div>
                {!! Form::myInput('number', 'age_constraint', 'Age Constraint',[],$ticket_setting?$ticket_setting->age_constraint:0) !!}
                {{-- {{ dd($ticket_setting->age_constraint) }} --}}
            </div>

            {{-- {{ dd($ticket_setting->is_per_pax ==1) }} --}}

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
@push('js')
<script type="text/javascript">
    var price = document.getElementById('price').value;
    var quantity = document.getElementById('quantity').value;
    var pax_constraint = document.getElementById('pax_constraint').value;
    var day_constraint = document.getElementById('day_constraint').value;
    var age_constraint = document.getElementById('age_constraint').value;

    $(document).ready(function() {
        check();
        checkQuantity()
        selected();
        checkPax();
        checkDay();
        checkAge();
    });
    window.addEventListener('load', function() {

    })

    function check() {
        //if free checked
        if (document.getElementById('isFree').checked) {
            price = document.getElementById('price').value;
            document.getElementById('price').disabled = true;
            document.getElementById('price').value = 0;
        }
        //if paid checked
        if (document.getElementById('isPaid').checked) {
            document.getElementById('price').disabled = false;
            document.getElementById('price').value = price;
        }
    }
    function checkQuantity() {
        //if Unlimited checked
        if (document.getElementById('isUnlimited').checked) {
            quantity = document.getElementById('quantity').value;
            document.getElementById('quantity').disabled = true;
            document.getElementById('quantity').value = 9007199254740991;
        }
        //if Limited checked
        if (document.getElementById('isLimited').checked) {
            document.getElementById('quantity').disabled = false;
            document.getElementById('quantity').value = quantity;
        }
    }

    function selected() {
        switch (document.getElementById('ticketable_type').value) {
            case 'App\\Models\\Destination':
                var destinations = {!!json_encode($destinations) !!};
                var ticketableId = <?php $ticket ? print(json_encode($ticket->ticketable_id)) : print(json_encode($ticket)) ?>;
                var ticket = {!! json_encode($ticket) !!};
                // console.log(destinations);
                $('#ticketable_id').html("");
                for (var key in destinations) {
                    var value = destinations[key];
                    var newOption = new Option('Destination ' + value, key, (ticket != null) ? (ticketableId == key) ? true : false : false, (ticket != null) ? (ticketableId == key) ? true : false : false);
                    $('#ticketable_id').append(newOption).trigger('change');
                }

                break;
            case 'App\\Models\\Package':
                var packages = {!!json_encode($packages) !!};
                var ticketableId = <?php $ticket ? print(json_encode($ticket->ticketable_id)) : print(json_encode($ticket)) ?>;
                var ticket = {!! json_encode($ticket) !!};
                $('#ticketable_id').html("");
                console.log(ticket);
                for (var key in packages) {
                    var value = packages[key];
                    var newOption = new Option('Package ' + value, key, (ticket != null) ? (ticketableId == key) ? true : false : false, (ticket != null) ? (ticketableId == key) ? true : false : false);
                    $('#ticketable_id').append(newOption).trigger('change');
                }
                break;
            case 'App\\Models\\Event':
                var events = {!!json_encode($events) !!};
                var ticketableId = <?php $ticket ? print(json_encode($ticket->ticketable_id)) : print(json_encode($ticket)) ?>;
                var ticket = {!! json_encode($ticket) !!};
                $('#ticketable_id').html("");
                // console.log(events);
                for (var key in events) {
                    var value = events[key];
                    var newOption = new Option('Event ' + value, key, (ticket != null) ? (ticketableId == key) ? true : false : false, (ticket != null) ? (ticketableId == key) ? true : false : false);
                    $('#ticketable_id').append(newOption).trigger('change');
                }
                break;
            default:
                console.log(document.getElementById('ticketable_type').value + ' Selected');

        }

    }

    function checkPax() {
        if (document.getElementById('isNotPax').checked) {
            pax_constraint = document.getElementById('pax_constraint').value;
            document.getElementById('pax_constraint').disabled = true;
            document.getElementById('pax_constraint').value = 0;
        }
        if (document.getElementById('isPax').checked) {
            document.getElementById('pax_constraint').disabled = false;
            document.getElementById('pax_constraint').value = pax_constraint;
        }
    }

    function checkDay() {
        if (document.getElementById('isNotDay').checked) {
            day_constraint = document.getElementById('day_constraint').value;
            document.getElementById('day_constraint').disabled = true;
            document.getElementById('day_constraint').value = '';
        }
        if (document.getElementById('isDay').checked) {
            document.getElementById('day_constraint').disabled = false;
            document.getElementById('day_constraint').value = day_constraint;
        }
    }

    function checkAge() {
        if (document.getElementById('isNotAge').checked) {
            age_constraint = document.getElementById('age_constraint').value;
            document.getElementById('age_constraint').disabled = true;
            document.getElementById('age_constraint').value = 0;
        }
        if (document.getElementById('isAge').checked) {
            document.getElementById('age_constraint').disabled = false;
            document.getElementById('age_constraint').value = age_constraint;
        }
    }


</script>
@endpush
