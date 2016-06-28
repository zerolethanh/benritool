@extends('layouts.app-container-fluid')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            <a href="javascript:history.back()">BenriTool > </a>
            @yield('heading')
        </div>

        <div class="panel-body">
            @yield('body')
        </div>

    </div>

@endsection

