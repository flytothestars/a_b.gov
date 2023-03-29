<label for="{{$fieldName}}" class="form-label font-bold form-label_line text-primary mb-2 pb-1">
    {{$fieldText}}
</label>
<div class="position-relative">

    <textarea class="form-control textarea"
              id="{{$fieldName}}"
              name="{{$fieldName}}"
              rows="8"
    >{{$fieldValue}}</textarea>
</div>
@error($fieldName)
<span class="invalid-feedback text-start d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
