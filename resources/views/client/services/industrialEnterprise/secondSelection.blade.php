<hr class="text-black my-4 "/>
<div class="font-bold font-xl mt-3">
    @lang('messages.pages.industrialEnterprise.secondSection.header')
</div>
<hr class="text-black my-4 "/>
<div class="font-bold">@lang('messages.pages.industrialEnterprise.secondSection.miniTitle')</div>
<p class="font-md">@lang('messages.pages.industrialEnterprise.secondSection.description.one')</p>
<div class="mt-4 row">
<div class="col">
        <div class="font-bold font-xl mt-3">
        @lang('messages.pages.industrialEnterprise.secondSection.title')
        </div>
        <div class="font-md mt-3 pt-1">
            
            <p align="justify">@lang('messages.pages.industrialEnterprise.secondSection.description.two')</p>
            <ul class="mb-0">
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.three')</li>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.four')</li>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.five')</li>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.six')</li>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.seven')</li>
                <ul class="mb-0">    
                    <li>@lang('messages.pages.industrialEnterprise.secondSection.description.eight')</li>
                    <li>@lang('messages.pages.industrialEnterprise.secondSection.description.nine')</li>
                    <li>@lang('messages.pages.industrialEnterprise.secondSection.description.ten')</li>
                    <li>@lang('messages.pages.industrialEnterprise.secondSection.description.eleven')</li>
                    <li>@lang('messages.pages.industrialEnterprise.secondSection.description.twelve')</li>
                </ul>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.thirteen')</li>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.fourteen')</li>
                <li>@lang('messages.pages.industrialEnterprise.secondSection.description.fifteen')</li>
            </ul>
            <p>@lang('messages.pages.industrialEnterprise.contactNumber')</p>
        </div>

        <div class="btn primary mt-5 text-white font-bold btn-wrapper"
            onclick="location.href='{{ route('services.form', ['service_groups_id' => \App\Repositories\Enums\ServiceGroupEnum::IndustrialZone]) }}'">
            @lang('messages.pages.industrialEnterprise.btnRequest')
        </div>
    </div>    
<div class="col">
        <img class="w-100" width="500" height="500" src="{{asset('/images/industrialEnterprise/second.png')}}" alt="">
    </div>
    
</div>
