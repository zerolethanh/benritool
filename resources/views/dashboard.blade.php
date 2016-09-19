@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tool List</div>

                    <div class="panel-body center-block">
{{--                        @include('templates.toolicon',['ahref'=>'/money','imgsrc'=>'/images/money.png','caption'=>'Money'])--}}

{{--                        @include('templates.toolicon',['ahref'=>'/wallet','imgsrc'=>'/images/wallet.jpg','caption'=>'Wallet'])--}}

{{--                        @include('templates.toolicon',['ahref'=>'/timesheet','imgsrc'=>'/images/timesheet.jpg','caption'=>'TimeSheets'])--}}

{{--                        @include('templates.toolicon',['ahref'=>'/cal','imgsrc'=>'/images/schedule.png','caption'=>'Schedule'])--}}

                        @include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/images/lockandkey.png','caption'=>'Create Password'])

{{--                        @include('templates.toolicon',['ahref'=>'/addr','imgsrc'=>'/images/address.png','caption'=>'Find Address'])--}}
                        @include('templates.toolicon',['ahref'=>'/uuid','imgsrc'=>'/images/uuid.png','caption'=>'UUIDs'])
                        {{--                        @include('templates.toolicon',['ahref'=>'/checkemail','imgsrc'=>'/images/checkemail','caption'=>'Check Email'])--}}

                        {{--                        @include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/images/gpw','caption'=>'Create Password'])--}}
                        {{--                        @include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/images/gpw','caption'=>'Create Password'])--}}
                        {{--@include('templates.toolicon',['ahref'=>'/gpw','imgsrc'=>'/images/gpw','caption'=>'Create Password'])--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
