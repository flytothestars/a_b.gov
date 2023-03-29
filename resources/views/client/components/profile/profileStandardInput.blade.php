<label for="{{$fieldName}}" class="form-label font-bold form-label_line text-primary mb-2 pb-1">@lang($fieldText)</label>
<div class="position-relative">
    <input type="{{$fieldType}}" id="{{$fieldName}}"
           class="form-control input input_line "
           placeholder="@lang($fieldText)" autocomplete="nope" name="{{$fieldName}}" value="{{old($fieldName, $fieldValue)}}">
    @isset($fieldImg)
        <img onclick="hideOrShowInputValue('{{$fieldName}}')" class="input__icon input__icon_append" src="{{ asset('/images/closed-eye.svg') }}"
             data-id="{{$fieldName }}" />
    @endisset
</div>
{{--@error($fieldName)
<span class="invalid-feedback text-start d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
@enderror--}}
<span id="{{$fieldName}}_error" class="invalid-feedback text-start d-block form_item--hidden" role="alert"></span>
