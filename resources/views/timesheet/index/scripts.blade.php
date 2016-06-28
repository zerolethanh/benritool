<script>
    var fields = ['timesheet', 'date', 'start', 'end', 'description'];
    $('#timesheetform').submit(function (event) {
        event.preventDefault();

        //check form data valid
        var errs = check($(this).serializeArray());
        if (errs.length > 0) {
            alert(errs.join(' , ') + ' fields must not blank');
            return;
        }

        //post data & create new timesheet & close form
        var formdata = $(this).serializeArray();

        $('input[type="submit"]').prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            method: this.elements._method.value,
            data: formdata
        }).always(function (res) {
            console.log(res);
            location.reload(true);
            $("#newtimesheetModal").modal('hide');
        });

    });

    function check(data) {
        var needs = ['timesheet', 'date', 'start', 'end',];
        var errs = [];
        data.forEach(function (obj, idx, arr) {
            if ((needs.indexOf(obj.name) > -1) && obj.value.trim() == '') {
                errs.push(obj.name);
            }
        });
        return errs;
    }

    function showtimesheetForm(data) {
        var _form = id('timesheetform');
        if (!data) { // + button action
            _form.reset();
            settimesheetFormDate(event.target.dataset.date);
            _form.elements.submit.innerHTML = 'Create';//submit button text
            _form.elements._method.value = 'POST';//submit method
            console.log(_form.elements._method.value);

            if (!$("#deletebutton").hasClass("hidden")) {
                $("#deletebutton").addClass("hidden");
            }

        } else {// timesheet link clicked
            var inputs = _form.elements;
            for (var key in data) {
                if (inputs[key]) {
                    inputs[key].value = data[key];

                }
            }
            inputs['submit'].innerHTML = 'UPDATE';//submit button text
            _form.action = '/timesheet/' + data.id;//submit link
            _form.elements._method.value = 'PUT';//submit method

            if ($("#deletebutton").hasClass("hidden")) {
                $("#deletebutton").removeClass("hidden");
            }
            $("#newtimesheetModal").modal('show');

        }
    }

    function settimesheetFormDate(selected_date) {
        //set date field
        id('date').value = selected_date;

        //set start and end field
        var now = new Date();
//            console.log(('0' + (now.getHours() + 1) + ':00').slice(-5));
        id('start').value = ('0' + (now.getHours() + 1) + ':00').slice(-5);//1h ago
        id('end').value = ('0' + (now.getHours() + 2) + ':00').slice(-5);//2h ago
    }


    function timesheetLinkClicked($timesheet_link) {
        var _a = event.target;
//            console.log(_a);
        $.get($timesheet_link)
                .always(function (res) {
                    console.log(res);
                    if ($(_a).is(':hover')) {
                        $(_a).popover('hide');
                    }
                    showtimesheetForm(res);
                });
    }
    function gettimesheet($timesheet_link, $callback) {
        $.get($timesheet_link)
                .always($callback);
    }

    $('.timesheet_link').popover({
//            trigger: 'hover',
        placement: 'auto right'
    });


    $('.timesheet_link').hover(
            function () {
                var _a = this;

                if (this.dataset.contentloaded) {
                    setTimeout(function () {
                        if ($(_a).is(':hover')) {
                            $(_a).popover('show');
                        }
                    }, 100)
                } else {
                    $(this).popover('show');
                    var timesheetlink = this.dataset.shlink;

                    gettimesheet(timesheetlink, function ($res) {

                        var needs = ['timesheet', 'date', 'start', 'end', 'description'];

                        var showText = "<table class='table'>";
                        for (var need in $res) {
                            showText += '<tr>';
                            if (needs.indexOf(need) > -1) {
                                showText += '<td width="20%">' + need +
                                        '</td><td width="70%" style="color: royalblue">' + $res[need] + "</td>";
                            }
                            showText += '</tr>'
                        }
                        showText += '</table>';

                        _a.dataset.content = showText;
                        _a.dataset.contentloaded = true;

                        if ($(_a).is(':hover')) {
                            $(_a).popover('show');
                        }

                    });
                }
            },
            function () {
                $(this).popover('hide');

            }
    );

    function deletetimesheet($yes) {
        var _form = id('timesheetform');
        l(_form.action);
        if (!$yes) {
            $('#newtimesheetModal').modal('hide');
            id('alertmodal-body').innerHTML = 'ARE YOU SURE DELETE:<br>' +
                    '(' + _form.start.value + '~' + _form.end.value + ') ' +
                    _form.timesheet.value;
            $('#alertmodal').modal('show');
        } else {
            $.ajax(
                    {
                        method: 'DELETE',
                        url: _form.action,
                    }
            ).always(function (res) {

                location.reload(true);
                $("#alertmodal").modal('hide');
            });
        }

    }

    $('#newtimesheetModal').on('shown.bs.modal', function () {
        id('timesheet').focus();
    })

</script>