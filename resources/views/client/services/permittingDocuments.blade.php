@extends('client.layouts.app')

@section('content')
    <div class="pt-4">
        <div class="container">
            @include('client.components.breadcrumb', ['currentLocationName'=>'messages.pages.permittingDocuments.permittingDocuments'])
            <div class="row pb-3">
                <!-- <div class="block-header col-lg-4 col-12 align-items-center ">
                    <div class="header">@lang('messages.pages.permittingDocuments.permittingDocuments')
                    </div>
                </div>
                <form class="pt-2 col-lg-8 col-12">
                    <div class="position-relative">
                        <input class="form-control input input_lg input_icon-prepend opacity-primary me-2" type="search"
                               placeholder="@lang('messages.general.search')"
                               aria-label="Поиск">
                        <i class="fas fa-search font-md input__icon text-primary input__icon_lg"></i>
                    </div>

                </form> -->
            </div>
            <div class="service-banner dark-slate-blue mt-4 w-100" id="serviceBanner1">
                <div class="col-lg-6 service-banner__info col-12">
                    <div class="service-banner__title">
                    @lang('messages.pages.permittingDocuments.permittingDocuments')
                    </div>
                    <div class="service-banner__text mt-3 ">
                    @lang('messages.pages.permittingDocuments.freeAdviceOnObtainingPermits')
                    </div>
                </div>
            </div>
            <ul class="nav nav_tab mt-4 pt-3" id="myTab" role="tablist">
                <li class="nav-item px-2 me-3" role="presentation">
                    <a href="#" class="nav-link py-0 active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                       type="button" role="tab" aria-controls="all" aria-selected="true" title="@lang('messages.pages.permittingDocuments.allDocuments')">@lang('messages.pages.permittingDocuments.allDocuments')</a>
                </li>
                <li class="nav-item px-2 me-3" role="presentation">
                    <a href="#" class="nav-link py-0" id="landRelation-tab" data-bs-toggle="tab"
                       data-bs-target="#landRelation" type="button" role="tab" aria-controls="landRelation"
                       aria-selected="false" title="@lang('messages.pages.permittingDocuments.landRelations')">@lang('messages.pages.permittingDocuments.landRelations')</a>
                </li>
                <li class="nav-item px-2 me-3" role="presentation">
                    <a href="#" class="nav-link py-0" id="networkEngineering-tab" data-bs-toggle="tab"
                       data-bs-target="#networkEngineering" type="button" role="tab" aria-controls="networkEngineering"
                       aria-selected="false" title="@lang('messages.pages.permittingDocuments.networkEngineering')">@lang('messages.pages.permittingDocuments.networkEngineering')</a>
                </li>
                <li class="nav-item px-2 me-3" role="presentation">
                    <a href="#" class="nav-link py-0" id="licenses-tab" data-bs-toggle="tab" data-bs-target="#licenses"
                       type="button" role="tab" aria-controls="licenses" aria-selected="false"
                       title="@lang('messages.pages.permittingDocuments.licensesAndOtherPermits')">@lang('messages.pages.permittingDocuments.licensesAndOtherPermits')</a>
                </li>
                <li class="nav-item px-2 me-3" role="presentation">
                    <a href="#" class="nav-link py-0" id="building-tab" data-bs-toggle="tab" data-bs-target="#building"
                       type="button" role="tab" aria-controls="building" aria-selected="false"
                       title="@lang('messages.pages.permittingDocuments.building')">@lang('messages.pages.permittingDocuments.building')</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active py-5" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <a href="#" class="wall-card blue-200" id="landRelationTabShow">
                        <div class="row g-0">
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <div class="wall-card__title">@lang('messages.pages.permittingDocuments.landRelations')</div>
                                    <div class="wall-card__text mt-3">@lang('messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividuals')
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-12 d-flex align-items-center ">
                                <button class="btn ms-auto wall-card__action">
                                    @lang('messages.action.moreDetails')

                                </button>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="wall-card blue-200 mt-2" id="networkEngineeringTabShow">
                        <div class="row g-0">
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <div class="wall-card__title">@lang('messages.pages.permittingDocuments.networkEngineering')</div>
                                    <div class="wall-card__text mt-3">@lang('messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividuals')
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 d-flex align-items-center ">
                                <button class="btn ms-auto wall-card__action">
                                    @lang('messages.action.moreDetails')
                                </button>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="wall-card blue-200 mt-2" id="licensesTabShow">
                        <div class="row g-0">
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <div class="wall-card__title">@lang('messages.pages.permittingDocuments.licensesAndOtherPermits')</div>
                                    <div class="wall-card__text mt-3">@lang('messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividuals')
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 d-flex align-items-center ">
                                <button class="btn ms-auto wall-card__action">
                                    @lang('messages.action.moreDetails')
                                </button>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="wall-card blue-200 mt-2" id="buildingTabShow">
                        <div class="row g-0">
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <div class="wall-card__title">@lang('messages.pages.permittingDocuments.building')</div>
                                    <div class="wall-card__text mt-3">@lang('messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividuals')
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 d-flex align-items-center ">
                                <button class="btn ms-auto wall-card__action">
                                    @lang('messages.action.moreDetails')
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="tab-pane fade" id="landRelation" role="tabpanel" aria-labelledby="landRelation-tab">
                    @include('client.components.permittingDocumentsServiceTab',
                            ['title'=> 'messages.pages.permittingDocuments.landRelations',
                            'name'=>'landRelation',
                            'text' => 'messages.pages.permittingDocuments.individualsAndLegalEntitiesInFieldOfLandRelations',
                             'serviceId' => '23ed0560-60f2-4bcd-b3e0-13cfde9e272a'])
                </div>
                <div class="tab-pane fade" id="networkEngineering" role="tabpanel"
                     aria-labelledby="networkEngineering-tab">
                    @include('client.components.permittingDocumentsServiceTab',
                            ['title'=> 'messages.pages.permittingDocuments.networkEngineering',
                            'name'=>'networkEngineering',
                            'text' => 'messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividualsAndLegalEntitiesInFieldOfEngineeringInfrastructure',
                             'serviceId' => '6f4a2d26-6119-41fd-b6fa-ec6358b73675'])
                </div>
                <div class="tab-pane fade" id="licenses" role="tabpanel" aria-labelledby="licenses-tab">
                    @include('client.components.permittingDocumentsServiceTab',
                            ['title'=> 'messages.pages.permittingDocuments.licensesAndOtherPermits',
                            'name'=>'licenses',
                            'text' => 'messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividualsAndLegalEntitiesInFieldOfLicensingAndPermits'])
                </div>
                <div class="tab-pane fade" id="building" role="tabpanel" aria-labelledby="building-tab">
                    @include('client.components.permittingDocumentsServiceTab',
                            ['title'=> 'messages.pages.permittingDocuments.building',
                            'name'=>'building',
                            'text' => 'messages.pages.permittingDocuments.thisSectionProvidesInformationMaterialForIndividualsAndLegalEntitiesInFieldOfArchitectureAndUrbanPlanning',
                             'serviceId' => '91816472-2491-4ae5-996f-dcbda5d6b4dc'
                             ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            let landRelationTab = new bootstrap.Tab($('#landRelation-tab'))
            let networkEngineeringTab = new bootstrap.Tab($('#networkEngineering-tab'))
            let licensesTab = new bootstrap.Tab($('#licenses-tab'))
            let buildingTab = new bootstrap.Tab($('#building-tab'))

            $('#landRelationTabShow').click((e) => {
                e.preventDefault();
                landRelationTab.show()
            })
            $('#networkEngineeringTabShow').click((e) => {
                e.preventDefault();
                networkEngineeringTab.show()
            })
            $('#licensesTabShow').click((e) => {
                e.preventDefault();
                licensesTab.show()
            })
            $('#buildingTabShow').click((e) => {
                e.preventDefault();
                buildingTab.show()
            })

            const hash = window.location.hash;
            if (hash) {
                (new bootstrap.Tab($(hash))).show()
                $('html, body').animate({
                    scrollTop: 0
                }, 0);
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 120
                }, 1000);
            }


        })
    </script>
@stop
