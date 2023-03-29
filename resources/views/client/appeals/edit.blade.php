@extends('client.layouts.app')

@section('content')

    <div class="appeals-create">
        @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.appeals.editRequest'])
        <h1>@lang('messages.pages.appeals.editRequest')</h1>

        <form action="{{route('appeals.update',['appeals_code'=>$appeal->id])}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="appeals-create__form">

                <label for="category_id">
                    <p>@lang('messages.pages.appeals.category') </p>
                    <select name="category_id" class="input input_line w-100" id="category_id">
                        @foreach($categories as $category)

                            <option value="{{$category->id}}" {{  $category->id == $appeal->category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </label>


                <textarea class="textarea w-100" name="content" id="content" cols="30" rows="20">{{$appeal->content}}</textarea>

            </div>


            <div class="btn-actions">
                <label for="chooseFile" class="ms-0">

                    <input type="file"  name = "file[]" multiple id="chooseFile" hidden>
                    <label class="btn secondary w-100" id="chooseFileButton"  for="chooseFile"><i
                            class="fa fa-paperclip"></i> @lang('messages.action.attachDocument')
                    </label>
                </label>
                <a class="btn secondary text-red" type="button" href='{{route('appeals.index')}}'><i class="fa fa-times"></i>@lang('messages.action.cancel')  </a>
                <button type="submit" name="saveAsDraft" value="saveAsDraft" class="btn secondary btn-grey"><i class="fa fa-save"></i> @lang('messages.action.saveAsDraft') </button>
                <button type="submit" class="btn primary me-0 text-white">@lang('messages.action.send')  </button>
            </div>

        </form>

        <div class="appeals-create__fileInfo">
            <p>@lang('messages.pages.Profile.maxFileSize5MBAndFileFormatPdfZipPngJpeg') </p>
        </div>
        <div class="appeals-create__thumbs" id="appealsFilesInputContent">
        </div>
        <div class="appeals-create__file" id="appealsFilesInputContentDoc">

        </div>


    </div>

@endsection
@section('js')
    <script>
        $(function () {
            $('#chooseFileButton').on('click', function () {
                $('.MultiFile-wrap #chooseFile').click();
            })
            $('#chooseFile').MultiFile({
                max_size: 100,
                accept: 'jpg|png|zip|docx',
                onFileAppend: function (element, value, master_element) {
                    let file = [...element.files].filter((el) => {
                        return el.name === value
                    })[0]

                    if (file.type === 'image/jpeg' || file.type === 'image/png') {
                        $('#appealsFilesInputContent').append('<div class="thumbs-img" >  <img name="img[]" src="' + URL.createObjectURL(file)
                            + '"/></div> ')
                    } else if (file.type === 'application/msword' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        $('#appealsFilesInputContentDoc').append('' +
                            '<a href="' + URL.createObjectURL(file) + '" class="file">' +
                            '<div class="file__icon">' +
                            '<img src="/images/appeals/word-icon.png" alt="Wordpad">' +
                            '</div> <div class="file__title">' + file.name + '</div> ' +
                            '<div class="file__download">' +
                            '<img src="/images/appeals/download-icon.svg" ' +
                            'alt="Download icon"></div> </a>')
                    } else if (file.type === 'application/zip' || file.type === 'application/x-zip-compressed') {
                        $('#appealsFilesInputContentDoc').append('' +
                            '<a href="' + URL.createObjectURL(file) + '" class="file">' +
                            '<div class="file__icon">' +
                            '<img src="/images/appeals/zip-icon.png" alt="Wordpad">' +
                            '</div> <div class="file__title">' + file.name + '</div> ' +
                            '<div class="file__download">' +
                            '<img src="/images/appeals/download-icon.svg" ' +
                            'alt="Download icon"></div> </a>')
                    }
                },

            });
        });
    </script>
@stop
