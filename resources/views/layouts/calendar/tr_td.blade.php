<td @if(isset($options)) @foreach($options as $key=>$val) <?= $key . '=' . "$val" ?> @endforeach @endif >
    <?php
    echo $day ?? '';
    if (isset($data)) {
        if (is_array($data)) echo implode('', $data);
        else echo $data;
    }
    ?>
</td>{{PHP_EOL}}