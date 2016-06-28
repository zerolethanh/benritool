<button class="{{$options['class'] or ''}}"
        id="{{$options['id'] or 'days_rows_add_button'}}"
        name="{{$options['name'] or 'days_rows_add_button'}}"
        value="{{$options['value'] or ''}}"
        onclick="{{$options['onclick'] or 'days_rows_add_button_onclick()'}}">
    {{$options['text'] or '+'}}
</button>