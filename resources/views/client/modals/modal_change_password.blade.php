<!-- Modal -->
<div class="modal fade" id="changePasswordSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" id="closePasswordSuccessModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" style="display: block; padding: 0px 0px 30px;">
                <div><strong style="color: #6CA841; font-weight: bold; font-size: 30px;">@lang('messages.pages.Profile.successfully')</strong></div>
                <div class="mt-1" style="font-size: 20px;color: #000;">@lang('messages.pages.Profile.yourPasswordHasBeenChanged')</div>
                <div class="mt-2">
                    <img src="{{asset('images/done2.png')}}" alt="done">
                </div>
            </div>
        </div>
    </div>
</div>
