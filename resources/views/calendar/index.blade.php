@extends('layouts.app.contents-fluid')

@section('heading','Calendar')
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
                <button class="btn btn-default" onclick="location.href='{{$prev_month}}'"><<</button>
                {{--&nbsp;&nbsp;&nbsp;--}}
                {{$year."/".$month}}
                {{--&nbsp;&nbsp;&nbsp;--}}
                <button class="btn btn-default" onclick="location.href='{{$next_month}}'">>></button>
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
                                    data-target="#newScheduleModal"
                                    data-date="{{ $date }}"
                                    onclick="showScheduleForm()">
                                +
                            </button>
                            <br>
                            @if(isset($schedules[$date]))
                                <?php
                                $date_schedules = $schedules[$date];
                                echo "<table class='table '>";
                                ?>

                                @foreach($date_schedules as $sh)
                                    <?php
                                    $schedule_link = "/cal/" . $sh['id'];

                                    echo '<tr><td>' . str_limit($sh['start'], 5, '') . "<br>" . str_limit($sh['end'], 5, '') . '</td><td>';
                                    ?>
                                    <a href="javascript:void(0);"
                                       onclick="scheduleLinkClicked('{{$schedule_link}}')" class="cal_link"
                                       data-shlink="{{$schedule_link}}"
                                       data-toggle="popover"
                                       data-popover="true"
                                       data-html="true"
                                       data-contentloaded="true"
                                       data-content="{{$sh['linkcontent']}}"
                                    >
                                        {{str_limit($sh['schedule'],30)}}
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



    <!-- Modal -->
    <div class="modal " id="newScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <form action="{{url('/cal')}}" id="scheduleform" method="post" name="scheduleform">
                        {{csrf_field()}}

                        <input type="hidden" name="_method" value="POST">

                        <div class="form-group">
                            <label for="schedule" class="control-label">Schedule Title:</label>
                            <input type="text" class="form-control" id="schedule" name="schedule">
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
                                onclick="deleteSchedule()"
                        >
                            Delete
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>


    @include('calendar.index.deleteButton')

@endsection

@section('scripts')
    @parent
    @include('calendar.index.scripts')

@endsection