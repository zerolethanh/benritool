<!-- Modal -->
<div id="alertmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@yield('alertmodal-header')</h4>
            </div>
            <div class="modal-body">
                @yield('alertmodal-body')
                <p id="alertmodal-body"></p>
            </div>
            <div class="modal-footer">
                @yield('alertmodal-footer')
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            </div>
        </div>

    </div>
</div>