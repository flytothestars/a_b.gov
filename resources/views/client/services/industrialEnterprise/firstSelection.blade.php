<hr class="text-black my-4 "/>
<div class="font-bold font-xl mt-3">
    @lang('messages.pages.industrialEnterprise.firstSection.header')
</div>
<hr class="text-black my-4 "/>
<div class="mt-4 row">
    <div class="col-lg">
        <div class="font-bold font-xl mt-3">
        @lang('messages.pages.industrialEnterprise.firstSection.title')
        </div>
        <div class="font-md mt-3 pt-1">
            <div class="font-bold">@lang('messages.pages.industrialEnterprise.firstSection.miniTitle')</div>
            <br>
            <ul class="mb-0">
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.one')</li>
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.two')</li>
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.three')</li>
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.four')</li>
            </ul>
            <br>
            <p>@lang('messages.pages.industrialEnterprise.secondSection.description.two')</p>
            <ol>
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.five')</li>
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.six')</li>
                <li>@lang('messages.pages.industrialEnterprise.firstSection.description.seven')</li>
            </ol>
            <p>@lang('messages.pages.industrialEnterprise.contactNumber')</p> 
        </div>
        <div class="btn primary mt-5 text-white font-bold btn-wrapper"
            onclick="location.href='{{ route('services.form', ['service_groups_id' => \App\Repositories\Enums\ServiceGroupEnum::SmallIndustrialPark]) }}'">
            @lang('messages.pages.industrialEnterprise.btnRequest')
        </div>
    </div>
    <div class="col">
        <img class="w-100" width="500" height="450" src="{{asset('/images/industrialEnterprise/first.png')}}" alt="">
    </div>
</div>
