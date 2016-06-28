@extends('templates.alertmodal')

@section('alertmodal-header')
    DELETE SCHEDULE
@endsection

@section('alertmodal-footer')
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-danger" onclick="deleteSchedule(true)">YES,DELETE IT!</button>
@endsection
