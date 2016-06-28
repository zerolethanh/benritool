@extends('layouts.app.contents-fluid')

@section('heading','Money')
@section('css')
    <style>
        .popover {
            max-width: 100%;
            width: 500px;
        }

    </style>
@endsection

@section('body')

    <table class="table table-bordered ">

        @include('money.index.weekdays_row')
        @include('money.index.day_contents_rows')

    </table>

    @include('money.index.modal')
    @include('money.index.deleteButton')

@endsection

@section('scripts')
    @parent
    @include('money.index.scripts')

@endsection