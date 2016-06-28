@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tool List</div>

                    <div class="panel-body center-block">
                        @include('templates.toolicon',['ahref'=>'/money','imgsrc'=>'/imgs/money','caption'=>'Money'])

                        @include('templates.toolicon',['ahref'=>'/wallet','imgsrc'=>'/imgs/wallet','caption'=>'Wallet'])

                        @include('templates.toolicon',['ahref'=>'/timesheet','imgsrc'=>'/imgs/timesheet','caption'=>'TimeSheets'])

                        @include('templates.toolicon',['ahref'=>'/cal','imgsrc'=>'/imgs/schedule','caption'=>'Schedule'])

                        @include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/imgs/gpw','caption'=>'Create Password'])

                        @include('templates.toolicon',['ahref'=>'/addr','imgsrc'=>'/imgs/addr','caption'=>'Find Address'])
                        @include('templates.toolicon',['ahref'=>'/uuid','imgsrc'=>'/imgs/uuid','caption'=>'UUIDs'])
                        {{--                        @include('templates.toolicon',['ahref'=>'/checkemail','imgsrc'=>'/imgs/checkemail','caption'=>'Check Email'])--}}

                        {{--                        @include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/imgs/gpw','caption'=>'Create Password'])--}}
                        {{--                        @include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/imgs/gpw','caption'=>'Create Password'])--}}
                        {{--@include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/imgs/gpw','caption'=>'Create Password'])--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
