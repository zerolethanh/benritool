@extends('layouts.app.contents')
@section('title','Generate Password')
@section('heading')
    @parent
    Generate Password
@endsection
@section('body')
    <div class="form-group">

        <div class="input-group">
            <input id="pw" class="form-control" value="{{$random_pw}}"/>
            <div class="input-group-btn">
                <button data-copytarget="pw" class="btn btn-success" onclick="copy()">Copy</button>
            </div>
        </div>

        <input disabled class="btn disabled" id="pwlen"
               value="password length: {{strlen($random_pw)}} "/><br>
        {{--<button data-copytarget="#pw" class="btn btn-success">Copy</button>--}}
        {{--<input type="text" id="CopyOk" disabled style="border: none;">--}}
        <label for="len">Password Length: </label>
        <input type="number" name="len" id="len" value="20">

        <br>
        <input type="checkbox" name="l" id="l" checked> abcdefghjkmnpqrstuvwxyz
        <br>
        <input type="checkbox" name="u" id="u" checked> ABCDEFGHJKMNPQRSTUVWXYZ
        <br>

        <input type="checkbox" name="d" id="d" checked> 0123456789
        <br>

        <input type="checkbox" name="s" id="s" checked> !@#$%&*?
        <br>

        <input type="checkbox" name="add_dashes" id="add_dashes"> add dashes

        <br>
        <button class="btn btn-danger" onclick="query()">Regenerate
        </button>
    </div>
@endsection

@section('scripts')
    <script>
        function query() {
            var text = "?";

            text += "&len=" + document.getElementById("len").value;
            if (document.getElementById("l").checked == true) text += "&l=1";
            if (document.getElementById("u").checked == true) text += "&u=1";
            if (document.getElementById("d").checked == true) text += "&d=1";
            if (document.getElementById("s").checked == true) text += "&s=1";
            if (document.getElementById("add_dashes").checked == true) text += "&add_dashes=1";

            //get json
            text += "&json=1";

            $.get('/gpw' + text, function (res) {
                console.log(res);
                var pw = res.random_pw;
                id('pw').value = pw;
                id('pwlen').value = "passwords length: " + pw.length;
            });
        }

    </script>

@endsection
