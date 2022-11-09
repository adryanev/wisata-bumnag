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

            {!! Form::myInput('number','quantity','Quantity') !!}

            {!! Form::myTextArea('description', 'Description') !!}

            {!! Form::mySelect('ticketable_type', 'ticket Destination', $ticketable_type, $ticket->ticketable ? $ticket->ticketable_type : null , ['class' => 'form-control select2','onchange'=>'selected()','id'=>'ticketable_type']) !!}

            {!! Form::myFile('ticket_photo','ticket Photo') !!}

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
<script type="text/javascript">
    var price = document.getElementById('price').value;

    window.addEventListener('load', function() {
        check();
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

</script>
