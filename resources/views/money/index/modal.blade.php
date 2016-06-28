<!-- Modal -->
<div class="modal " id="main_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <form action="{{url('/cal')}}" id="main_form" method="post" name="main_form">
                    {{csrf_field()}}

                    <input type="hidden" name="_method" value="POST">

                    {{--<div class="form-group">--}}
                    {{--<label for="schedule" class="control-label">Schedule Title:</label>--}}
                    {{--<input type="text" class="form-control" id="schedule" name="schedule">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<table>--}}
                    {{--<tr>--}}

                    {{--<td><label for="start" class="control-label">Start:</label></td>--}}
                    {{--<td><input type="date" name="date" id="date"></td>--}}
                    {{--<td><input type="time" id="start" name="start"></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td><label for="end" class="control-label">End:</label></td>--}}
                    {{--<td></td>--}}
                    {{--<td><input type="time" id="end" name="end"></td>--}}
                    {{--</tr>--}}
                    {{--</table>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="description" class="control-label">Description:</label>--}}
                    {{--<textarea id="description" class="form-control" rows="6" name="description"></textarea>--}}
                    {{--</div>--}}
                    <button type="submit" name="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <span></span>
                    <button type="button" class="btn btn-warning" id="deletebutton"
                            onclick="main_modal_delete_button_click()">
                        Delete
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>