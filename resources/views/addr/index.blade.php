@extends('layouts.app.contents')

@section('title',"Find Address")
@section('heading',"Find Address")

@section('body')
    <div class="input-group">

        <input type="text" id="addrnumber"
               placeholder="Address Number: Ex. 2300064 or 230-0064"
               class="form-control">

        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" id="findType">
                I need Address
                {{--<span class="caret"></span>--}}
            </button>
            <ul class="dropdown-menu">
                <li><a href="#" onclick="changeFindType()">I need Address</a></li>
                <li><a href="#" onclick="changeFindType()">I need Nearest Station</a></li>
            </ul>

            {{--<button class="btn btn-success">Find</button>--}}
        </div>
    </div>

    <br>
    <div class="input-group">

        {{--<input type="text" class="form-control" id="result">--}}

        <textarea class="form-control" name="result" id="result" cols="30" rows="10" placeholder="Result"></textarea>
        <div class="input-group-btn">
            <button class="btn btn-default" id="copybtn" data-copytarget="result" onclick="copy()">
                Copy
            </button>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        var addrField = id("addrnumber");

        addrField.addEventListener('input', startSearch);
        function startSearch() {
            var val = addrField.value.replace(/\-/i, '');

            if (val.length == 7) {

                if (id("findType").innerHTML.indexOf('Station') > -1) {

                    $.ajax({
                                type: "GET",
                                url: 'http://geoapi.heartrails.com/api/json?method=getStations&postal=' + val,
                                dataType: 'jsonp',
                                success: function (data) {
                                    if (data.error != undefined) {
                                        id('result').value = data.error;
                                        return;
                                    }
                                    var stations = data.response.station;//array of station
                                    if (stations) {
                                        var res = "";
                                        var need = ["name", "kana", "line", "next", "prev"];
                                        for (var i = 0; i < stations.length; i++) {
                                            for (var key in stations[i]) {
                                                if (need.indexOf(key) > -1)
                                                    res += key + ":\t" + stations[i][key] + "\n";
                                            }
                                            res += "\n"
                                        }
                                        id('result').value = res;
                                    }
                                }
                            }
                    );

                } else {

                    $.get('https://api.zipaddress.net/?zipcode=' + val,
                            function (data) {

                                if (data.message) {
                                    id('result').value = data.message;
                                    return;
                                }
                                var dict = data.data;
                                if (dict) {
                                    var res = "";
                                    for (var key in dict) {
                                        res += key + ":\t" + dict[key] + "\n";
                                    }

                                    id('result').value = res;
                                }
                            });
                }
            }
        }

        function changeFindType() {
            replaceButtonText('findType', event.srcElement.text);
            startSearch();
        }


    </script>
    {{--<script type="text/javascript" src="http://geoapi.heartrails.com/api/geoapi.js"></script>--}}

@endsection
