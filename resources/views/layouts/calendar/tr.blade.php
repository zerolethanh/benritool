<tr>
    @foreach($w as $d)
        @include('layouts.calendar.tr_td',['day'=>$d])
    @endforeach
</tr>