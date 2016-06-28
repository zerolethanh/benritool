@foreach($weeks as $week)
    <tr>
        @foreach($week as $wd_day => $content_array)
            <td width="14.3%">

                {{-- day button--}}
                <?php
                if (strpos($wd_day, '.') > 0) $day = explode('.', $wd_day)[1];

                if (is_numeric($day)) {
                    if (isset($sundays) && in_array($day, $sundays)) {
                        echo "<button class='btn btn-info' href='#'><span style='color:red'>$day</span></button>";
                    } elseif (isset($saturdays) && in_array($day, $saturdays)) {
                        echo "<button class='btn btn-info' href='#'><span style='color:blue'>$day</span></button>";
                    } else {
                        echo "<button class='btn btn-info'>$day</button>";
                    }
                    $date = $year . "-" . $month . "-" . ($day >= 10 ? $day : "0$day");
                    echo <<<EOD
<button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#main_modal"
                                data-date="$date"
                                onclick="show_main_form()">
                            +
                        </button>
EOD;
                }

                ?>

                <br>

                <!--plus button-->
                @if(is_numeric($wd_day) && is_array($content_array))

                    {{--                            @if(isset($schedules[$date]))--}}
                    <?php
                    echo "<table class='table '>";
                    ?>

                    @foreach($content_array as $content)
                        <?php
                        $content_link = "/money/" . $content['id'];

                        echo '<tr><td>' . $content['use_time'] . '</td><td>';
                        ?>
                        <a href="javascript:void(0);"
                           onclick="scheduleLinkClicked('{{$content_link}}')" class="cal_link"
                           {{--data-shlink="{{$content_link}}"--}}
                           data-toggle="popover"
                           data-popover="true"
                           data-html="true"
                           data-contentloaded="true"
                           data-content="{{$content['read_receipt_data']}}"
                        >
                            {{str_limit($content['shop_name'],30)}}
                        </a>
                        <?php echo '</td></tr>' ?>
                    @endforeach

                    <?php echo '</table>' ?>

                    {{--@endif--}}

                @endif
            </td>
        @endforeach
    </tr>
@endforeach