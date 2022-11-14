<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::mySelect('reviewable_type', 'reviewable Type', $reviewable_type, $review ? $review->reviewable_type : null , ['class' => 'form-control select2','onchange'=>'selected()','id'=>'reviewable_type']) !!}

            {!! Form::mySelect('reviewable_id', 'reviewable Model', [''=>'select reviewable type first'], $review ? $review->reviewable_id : null , ['class' => 'form-control select2','id'=>'reviewable_id']) !!}

            {!! Form::myInput('number','rating','Rating') !!}
            {!! Form::myInput('text','title','Title') !!}
            {!! Form::myTextArea('description','Description') !!}

            {!! Form::mySelect('user_id', 'User', $users, $reviewUser ? $reviewUser->id : null , ['class' => 'form-control select2']) !!}

            {!! Form::myFile('review_photo','Review Photo') !!}


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
    $(document).ready(function() {
        selected();
    });

    function selected() {

        switch (document.getElementById('reviewable_type').value) {
            case 'App\\Models\\Destination':
                var destinations = {!!json_encode($destinations) !!};
                var reviewableId = <?php $review ? print(json_encode($review->reviewable_id)) : print(json_encode($review)) ?> ;
                var review = {!!json_encode($review) !!};
                // console.log(destinations);
                $('#reviewable_id').html("");
                for (var key in destinations) {
                    var value = destinations[key];
                    var newOption = new Option('Destination ' + value, key, (review != null) ? (reviewableId == key) ? true : false : false, (review != null) ? (reviewableId == key) ? true : false : false);
                    $('#reviewable_id').append(newOption).trigger('change');
                }

                break;
            case 'App\\Models\\Souvenir':
                var souvenirs = {!!json_encode($souvenirs) !!};
                var reviewableId = <?php $review ? print(json_encode($review->reviewable_id)) : print(json_encode($review)) ?> ;
                var review = {!!json_encode($review) !!};
                $('#reviewable_id').html("");
                console.log(review);
                for (var key in souvenirs) {
                    var value = souvenirs[key];
                    var newOption = new Option('Souvenir ' + value, key, (review != null) ? (reviewableId == key) ? true : false : false, (review != null) ? (reviewableId == key) ? true : false : false);
                    $('#reviewable_id').append(newOption).trigger('change');
                }
                break;
            case 'App\\Models\\Ticket':
                var tickets = {!!json_encode($tickets) !!};
                var reviewableId = <?php $review ? print(json_encode($review->reviewable_id)) : print(json_encode($review)) ?> ;
                var review = {!!json_encode($review) !!};
                $('#reviewable_id').html("");
                // console.log(tickets);
                for (var key in tickets) {
                    var value = tickets[key];
                    var newOption = new Option('ticket ' + value, key, (review != null) ? (reviewableId == key) ? true : false : false, (review != null) ? (reviewableId == key) ? true : false : false);
                    $('#reviewable_id').append(newOption).trigger('change');
                }
                break;
            case 'App\\Models\\Ticket':
                var tickets = {!!json_encode($tickets) !!};
                var reviewableId = <?php $review ? print(json_encode($review->reviewable_id)) : print(json_encode($review)) ?> ;
                var review = {!!json_encode($review) !!};
                $('#reviewable_id').html("");
                // console.log(tickets);
                for (var key in tickets) {
                    var value = tickets[key];
                    var newOption = new Option('Ticket ' + value, key, (review != null) ? (reviewableId == key) ? true : false : false, (review != null) ? (reviewableId == key) ? true : false : false);
                    $('#reviewable_id').append(newOption).trigger('change');
                }
                break;
            case 'App\\Models\\Package':
                var packages = {!!json_encode($packages) !!};
                var reviewableId = <?php $review ? print(json_encode($review->reviewable_id)) : print(json_encode($review)) ?> ;
                var review = {!!json_encode($review) !!};
                $('#reviewable_id').html("");
                // console.log(packages);
                for (var key in packages) {
                    var value = packages[key];
                    var newOption = new Option('Package ' + value, key, (review != null) ? (reviewableId == key) ? true : false : false, (review != null) ? (reviewableId == key) ? true : false : false);
                    $('#reviewable_id').append(newOption).trigger('change');
                }
                break;

            default:
                console.log(document.getElementById('reviewable_type').value + ' Selected');

        }

    }

</script>
