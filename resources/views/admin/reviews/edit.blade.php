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
