<div data-controller="inline_editor">
    <input data-inline_editor-target="field" data-action="change->inline_editor#change"
           name="{{$name}}"
           value="{{$value}}"
           type="{{$type}}"
           data-update_url="{{$update_url}}"
           class="form-control" style="{{$style}}">
</div>
