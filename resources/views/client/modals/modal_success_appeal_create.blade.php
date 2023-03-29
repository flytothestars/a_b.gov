<!-- Modal -->
<div class="modal fade" id="createSuccessAppealModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 550px;">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" id="closeSuccessAppealCreateModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" style="display: block; padding: 0px 40px 30px;">
                <div><strong style="color: #6CA841; font-weight: bold; font-size: 30px;">@lang('messages.pages.Profile.successfully')</strong></div>
                <div class="mt-1" style="font-size: 15px;color: #000;">
                    @lang('messages.pages.Profile.dearClientYourAppealHasBeenSuccessfullyCreated', ['appealId' => session()->get('successModal')])
                </div>
                <div class="mt-2">
                    <img width="60" src="{{asset('images/done2.png')}}" alt="done">
                </div>
            </div>
        </div>
    </div>
</div>
