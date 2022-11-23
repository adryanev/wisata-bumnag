@extends('admin.default')

@section('page-header')
Destination {{ $destination->name }}<small><i class="c-white-500 ti-brush"></i></small>
<img src="{{ $latestMedia }}" alt="Destination {{ $destination->name }} image" height="100" width="100">
@stop

@section('content')
{!! Form::model($destination, [
'route' => [ ADMIN . '.destinations.update', $destination->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.destinations.form',['destination'=>$destination,'categories'=>$categories,'destinationCategory'=>$destinationCategory])


<button type="submit" class="btn btn-primary "><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}
{{-- @if($media != null)

<div class="col-sm-8 bgc-white mT-20">
    <h5 class="p-15">Destiantion {{ $destination->name }} Photos</h5>
<hr>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <th>Photo</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($media as $medias)
            <tr>
                <td>
                    <img class="img-fluid" src="{{ $medias->original_url }}" alt="Destination {{ $destination->name }} image">
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <button class="btn btn-primary"><i class="c-white-500 ti-eye"></i></button>
                        </li>
                        <li class="list-inline-item">
                            <button class="row btn btn-danger"><i class="c-white-500 ti-close" onclick="removeMedia({{ $medias->id }})"></i></button>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
</div>

@endif

<script>
    function removeMedia(media) {
        console.log(media);
    }

</script> --}}
@stop
