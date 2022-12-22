<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Rank</th>
                        <th>Destination</th>
                    </tr>
                    @for($i = 0; $i < 10; $i++) <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{!! Form::select('rank[]', $destinations, isset($recommendations[$i])? $recommendations[$i]->destination_id : null, ['class'=>'form-control select2','placeholder' => 'Pick Destination']); !!}</td>
                        </tr>
                        @endfor
                </table>
            </div>
        </div>
    </div>

</div>
