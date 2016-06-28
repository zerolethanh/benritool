<script>

    function id($id) {
        return document.getElementById($id);
    }

    function copy() {

        var resultField = id(event.target.dataset.copytarget);

        try {
            resultField.select();
            document.execCommand('copy');
//            alert(resultField.value + '\n copied');

        } catch (e) {
            console.log(e);
        }

    }

    function replaceButtonText(buttonId, text) {
        var button = document.getElementById(buttonId);
        if (button) {
            if (button.childNodes[0]) {
                button.childNodes[0].nodeValue = text;
            }
            else if (button.value) {
                button.value = text;
            }
            else //if (button.innerHTML)
            {
                button.innerHTML = text;
            }
        }

    }
    function l(obj) {
        console.log(obj);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
