<div class="block-header align-items-center d-flex">
    <div class="header flex-grow-0 ">@lang($blockName)</div>
    <div class="block-header__line px-4 flex-grow-1">
        <hr>
    </div>
    @if($showAllUrl)
        <div class="block-header__show-all flex-grow-0 "><a href="{{$showAllUrl}}">@lang('messages.action.showAll')</a></div>
    @endif
</div>
