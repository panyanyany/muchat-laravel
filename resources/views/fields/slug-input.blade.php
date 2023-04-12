@component($typeForm, get_defined_vars())
    <div data-controller="slug_input"
         data-input-mask="{{$mask ?? ''}}"
         style="display: flex;max-width: 600px;"
    >
        <input {{ $attributes }} data-slug_input-target="value">
        <button class="form-control" type="button" style="max-width: 55px;font-size: smaller;" data-action="click->slug_input#generate">
            生成
        </button>
    </div>

    @empty(!$datalist)
        <datalist id="datalist-{{$name}}">
            @foreach($datalist as $item)
                <option value="{{ $item }}">
            @endforeach
        </datalist>
    @endempty
@endcomponent
