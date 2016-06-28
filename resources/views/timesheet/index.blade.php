@extends('layouts.app.contents-fluid')

@section('heading','TimeSheets')
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
                <br>
                {{'Worked : '.$month_worked.' hours'}}
            </td>
            {{--<td style="text-align: center">{{$year."/".$month}}</td>--}}
            {{--<td colspan="3"></td>--}}
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
                                    data-target="#newtimesheetModal"
                                    data-date="{{ $date }}"
                                    onclick="showtimesheetForm()">
                                +
                            </button>
                            <?php
                            if (isset($workedhours[$date])) {
                                echo 'worked : ' . $workedhours[$date] . ' h';
                            }
                            ?>

                            @if(isset($timesheets[$date]))
                                <?php
                                $date_timesheets = $timesheets[$date];
                                echo "<table class='table '>";
                                ?>
                                @foreach($date_timesheets as $ts)
                                    <?php
                                    $timesheet_link = "/timesheet/" . $ts['id'];

                                    echo '<tr><td>' . str_limit($ts['start'], 5, '') . "<br>" . str_limit($ts['end'], 5, '') . '</td><td>';
                                    ?>
                                    <a href="javascript:void(0);"
                                       onclick="timesheetLinkClicked('{{$timesheet_link}}')" class="timesheet_link"
                                       data-shlink="{{$timesheet_link}}"
                                       data-toggle="popover"
                                       data-popover="true"
                                       data-html="true"
                                       data-contentloaded="true"

                                       data-content="{{$ts['linkcontent']}}"
                                    >
                                        {{str_limit($ts['timesheet'],30)}}
                                    </a>
                                    <?php echo '</td></tr>' ?>
                                @endforeach

                                <?php echo '</table>' ?>

                            @endif

                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach

    </table>

    {{--</div>--}}

            <!-- Modal -->
    <div class="modal " id="newtimesheetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{url('/timesheet')}}" id="timesheetform" method="post" name="timesheetform">
                        {{csrf_field()}}

                        <input type="hidden" name="_method" value="POST">

                        <div class="form-group">
                            <label for="timesheet" class="control-label">Timesheet Title:</label>
                            <input type="text" class="form-control" id="timesheet" name="timesheet">
                        </div>

                        <div class="form-group">
                            <table>
                                <tr>

                                    <td><label for="start" class="control-label">Start:</label></td>
                                    <td><input type="date" name="date" id="date"></td>
                                    <td><input type="time" id="start" name="start"></td>
                                </tr>
                                <tr>
                                    <td><label for="end" class="control-label">End:</label></td>
                                    <td></td>
                                    <td><input type="time" id="end" name="end"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description:</label>
                            <textarea id="description" class="form-control" rows="6" name="description"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <span></span>
                        <button type="button" class="btn btn-warning" id="deletebutton"
                                onclick="deletetimesheet()"
                        >
                            Delete
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>


    @include('timesheet.index.deleteButton')

@endsection

@section('scripts')
    @parent
    @include('timesheet.index.scripts')

@endsection