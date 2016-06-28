<div class="input-group">
    @if(isset($inputLabel))
        <label for="{{$inputId}}">{{$inputLabel or ''}}</label>
    @endif
    <input id="{{$inputId}}" class="form-control" value="{{$inputValue or ''}}"/>
    <div class="input-group-btn">
        <button data-copytarget="{{$inputId}}" class="btn btn-success" onclick="copy()">Copy</button>
    </div>
</div>