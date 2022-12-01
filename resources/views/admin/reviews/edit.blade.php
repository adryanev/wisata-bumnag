@extends('admin.default')

@section('page-header')
Review <small><i class="c-white-500 ti-brush"></i></small>
{{-- <img src="{{ $latestMedia }}" alt="Review {{ $review->name }} image" height="100" width="100"> --}}
@stop

@section('content')
{!! Form::model($review, [
'route' => [ ADMIN . '.reviews.update', $review->id ],
'method' => 'put',
'files' => true
])
!!}

@include('admin.reviews.form',[])


<button type="submit" class="btn btn-primary " onclick="undisable()"><i class="c-white-500 ti-save"></i>&nbsp;Submit</button>

{!! Form::close() !!}

@if($media != null)

<div class="col-sm-8 bgc-white mT-20">
    <h5 class="p-15">Review {{ $review->title }} Photos</h5>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <th>Photo</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php $number = 1 ?>
                @foreach ($media as $medias)
                <tr>
                    <td>
                        <img class="img-fluid" src="{{ $medias->original_url }}" alt="Review {{ $review->title }} image" height="500px" width="250px">

                    </td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item p-5">
                                {{-- <a class="btn btn-primary" href="{{ route('admin.medias.show',$medias) }}"><i class="c-white-500 ti-eye"></i></a> --}}

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{ $number }}">
                                    <i class="c-white-500 ti-eye"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $number }}" tabindex="-1" aria-labelledby="modal{{ $number }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal{{ $number }}Label">Media {{ $review->title }} </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="img-responsive" src="{{ $medias->original_url }}" alt="Media {{ $review->title }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="list-inline-item">
                                {!! Form::open([ 'class'=>'delete',
                                'url' => route(ADMIN . '.medias.destroy', $medias),
                                'method' => 'DELETE',
                                ])
                                !!}
                                <button class="btn btn-danger" title="Delete"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}

                            </li>
                        </ul>
                    </td>
                </tr>
                <?php $number++ ?>
                @endforeach


            </tbody>
        </table>
    </div>
</div>

@endif

<script>
    function undisable() {
        var reviewable_type = document.getElementById('reviewable_type');
        var reviewable_id = document.getElementById('reviewable_id');
        var user_id = document.getElementById('user_id')

        $(reviewable_type).prop("disabled", false);
        $(reviewable_id).prop("disabled", false);
        $(user_id).prop("disabled", false);
    }

</script>

@stop
