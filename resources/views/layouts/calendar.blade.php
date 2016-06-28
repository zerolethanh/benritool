@extends('layouts.app.contents-fluid')

{{--@section('heading','Calendar')--}}
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
        <tr>
            <td colspan="7" style="text-align: center;color: white;background-color: #0d5183">
                <button class="btn btn-default" onclick="location.href='{{$prevmonth}}'"><<</button>
                &nbsp;&nbsp;&nbsp;
                {{$year."/".$month}}
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-default" onclick="location.href='{{$nextmonth}}'">>></button>
            </td>

        </tr>
        <tr>
            @foreach($weekdays as $wd)
                <th style="text-align: center;background-color: antiquewhite">{!! $wd !!}</th>
            @endforeach
        </tr>

        @foreach($weeks as $week)
            <tr>
                @foreach($week as $day)
                    <td width="14.3%">
                        @if($day)
                            <?php
                            if (in_array($day, $sundays)) {
                                echo "<button class='btn btn-info' href='#'><span style='color:red'>$day</span></button>";
                            } elseif (in_array($day, $saturdays)) {
                                echo "<button class='btn btn-info' href='#'><span style='color:blue'>$day</span></button>";
                            } else {
                                echo "<button class='btn btn-info'>$day</button>";
                            }
                            ?>

                            {{--{{$day}}--}}

                            <?php $date = $year . "-" . $month . "-" . ($day >= 10 ? $day : "0$day"); ?>
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                    id="addButton"
                                    data-target="#addFormModal"
                                    data-date="{{ $date }}"
                                    onclick="{{$addButtonClick or 'addButtonClick()'}}"> +
                            </button>
                            <br>
                            @if(isset($month_tasks[$date]))
                                <?php
                                $tasks = $month_tasks[$date];
                                ?>

                                <table class="table">
                                    @each('layouts.calendar.taskbody',$tasks,'task')
                                    {{--@foreach($tasks as $task)--}}
                                    {{--@include('layouts.calendar.taskbody',['task'=>$task])--}}

                                    {{--@endforeach--}}
                                </table>

                            @endif

                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach

    </table>

    <!-- Modal -->
    <div class="modal " id="addFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    @yield('addFormModalBody')
                </div>

            </div>
        </div>
    </div>

@endsection