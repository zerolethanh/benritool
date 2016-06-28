@extends('layouts.app.contents')

@section('heading','UUIDs')

@section('body')
    {{--    <pre>{{ $uuids }}</pre>--}}
    @for($i=0;$i<count($uuids);$i++)
        @include('templates.copyableInput',['inputId'=>"uuid-$i","inputValue"=>$uuids[$i]])
    @endfor
@endsection
