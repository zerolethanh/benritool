{{-- year/month row--}}
<tr>

    <td colspan="7" style="text-align: center;color: white;background-color: #0d5183">
        <button class="btn btn-default" onclick="location.href='{{$prev_month}}'"><<</button>
        &nbsp;&nbsp;&nbsp;
        {{$year.' / '.$month}}
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-default" onclick="location.href='{{$next_month}}'">>></button>
    </td>

</tr>

{{-- weekdays row--}}
<tr>
    @foreach($weekdays as $wd)
        <th style="text-align: center;background-color: antiquewhite">{!! $wd !!}</th>
    @endforeach
</tr>
