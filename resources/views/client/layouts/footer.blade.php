<footer class="footer">
    <div class="container">
        <div class="footer__brand text-center">
            <img src="{{asset('images/light-logo.svg')}}">
        </div>
        <!-- <div class="footer__navigation text-center">
            <a href="{{route('about')}}" class="footer__link">@lang('messages.links.about')</a>
            <a href="{{route('news_list')}}" class="footer__link">@lang('messages.links.news_list')</a>
            <a href="{{route('services')}}" class="footer__link">@lang('messages.links.services')</a>
        </div> -->
        <hr class="footer__line"/>
        <div class="row fs-6 d-block d-md-flex pt-2">         
            <div class="fs-6">@lang('messages.general.footerCopyright')</div><br>
            <div class="fs-6" data-bs-toggle="modal" data-bs-target="#exampleModalFooter">@lang('messages.general.userAccess')</div>
        </div>
    </div>
</footer>

<div class="modal fade" id="exampleModalFooter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">@lang('messages.general.userAccess')</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-block">
            @lang('messages.general.userAccessText')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Я принимаю условия соглашения</button>
            </div>
          </div>
        </div>
      </div>