<button class="{{$options['class'] or ''}}"
        id="{{$options['id'] or 'tr_td_add_button'}}"
        name="{{$options['name'] or 'tr_td_add_button'}}"
        value="{{$options['value'] or ''}}"
        onclick="{{$options['onclick'] or 'tr_td_add_button_onclick()'}}">
    {{$options['text'] or '+'}}
</button>