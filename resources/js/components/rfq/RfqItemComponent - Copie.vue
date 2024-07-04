<template>
  <div>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Request details</h5>
          <!--end::Title-->
          <!--begin::Separator-->
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
          <ul
            class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 mr-3 font-size-sm"
          >
            <li class="breadcrumb-item">
              <router-link to="/rfqs" class="text-muted">Requests</router-link>
            </li>
          </ul>
          <!--end::Separator-->
          <!--begin::Search Form-->
          <div class="d-flex align-items-center" id="kt_subheader_search" v-if="rfq">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">#{{rfq.id}}</span>
          </div>
          <!--end::Search Form-->
        </div>
        <!--end::Details-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid" v-if="rfq">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Chat-->
        <div class="d-flex flex-row">
          <!--begin::Aside-->
          <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
            <!--begin::Card-->
            <div class="card card-custom">
              <!--begin::Body-->
              <div class="card-body">
                <!--begin:Search-->
                <div class="input-group input-group-solid">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <span class="svg-icon svg-icon-lg">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="24px"
                          height="24px"
                          viewBox="0 0 24 24"
                          version="1.1"
                        >
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path
                              d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                              fill="#000000"
                              fill-rule="nonzero"
                              opacity="0.3"
                            />
                            <path
                              d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                              fill="#000000"
                              fill-rule="nonzero"
                            />
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>
                    </span>
                  </div>
                  <input type="text" class="form-control py-4 h-auto" placeholder="Email" />
                </div>
                <!--end:Search-->
                <!--begin:Users-->
                <div class="mt-7 scroll scroll-pull">
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_12.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Matt Pears</a>
                        <span class="text-muted font-weight-bold font-size-sm">Head of Development</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">35 mins</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_11.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Charlie Stone</a>
                        <span class="text-muted font-weight-bold font-size-sm">Art Director</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">7 hrs</span>
                      <span class="label label-sm label-success">4</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_10.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Teresa Fox</a>
                        <span class="text-muted font-weight-bold font-size-sm">Web Designer</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">3 hrs</span>
                      <span class="label label-sm label-danger">5</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_13.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Giannis Nelson</a>
                        <span class="text-muted font-weight-bold font-size-sm">IT Consultant</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">2 days</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_15.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Carles Puyol</a>
                        <span class="text-muted font-weight-bold font-size-sm">Operator</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">5 mins</span>
                      <span class="label label-sm label-success">9</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_16.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Ana Torn</a>
                        <span class="text-muted font-weight-bold font-size-sm">Head Of Finance</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">2 days</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_18.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Lisa Pears</a>
                        <span class="text-muted font-weight-bold font-size-sm">Web Designer</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">6 mins</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_20.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Amanda Bold</a>
                        <span class="text-muted font-weight-bold font-size-sm">Art Director</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">3 hrs</span>
                      <span class="label label-sm label-warning">7</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_21.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Nick Jhonson</a>
                        <span class="text-muted font-weight-bold font-size-sm">IT Consultant</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">10 mins</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_19.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Sarah Larson</a>
                        <span class="text-muted font-weight-bold font-size-sm">Web Designer</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">4 hrs</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_22.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Matt Pears</a>
                        <span class="text-muted font-weight-bold font-size-sm">Head of Development</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">35 mins</span>
                      <span class="label label-sm label-success">5</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_23.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Tim Stone</a>
                        <span class="text-muted font-weight-bold font-size-sm">Web Developer</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">5 hrs</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_17.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Jhon Richardson</a>
                        <span class="text-muted font-weight-bold font-size-sm">Head of Development</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">1 week</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_18.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Ana Kiskia</a>
                        <span class="text-muted font-weight-bold font-size-sm">Web Master</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">35 mins</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_14.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Nick Stone</a>
                        <span class="text-muted font-weight-bold font-size-sm">Art Director</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">3 hrs</span>
                    </div>
                  </div>
                  <!--end:User-->
                  <!--begin:User-->
                  <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center">
                      <div class="symbol symbol-circle symbol-50 mr-3">
                        <img alt="Pic" src="assets/media/users/300_13.jpg" />
                      </div>
                      <div class="d-flex flex-column">
                        <a
                          href="#"
                          class="text-dark-75 text-hover-primary font-weight-bold font-size-lg"
                        >Nick Nilson</a>
                        <span class="text-muted font-weight-bold font-size-sm">Software Arcitect</span>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <span class="text-muted font-weight-bold font-size-sm">3 days</span>
                    </div>
                  </div>
                  <!--end:User-->
                </div>
                <!--end:Users-->
              </div>
              <!--end::Body-->
            </div>
            <!--end::Card-->
          </div>
          <!--end::Aside-->
          <!--begin::Content-->
          <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
            <!--begin::Card-->
            <div class="card card-custom">
              <!--begin::Header-->
              <div class="card-header align-items-center px-4 py-3">
                <div class="text-left flex-grow-1">
                  <!--begin::Aside Mobile Toggle-->
                  <button
                    type="button"
                    class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none"
                    id="kt_app_chat_toggle"
                  >
                    <span class="svg-icon svg-icon-lg">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="24px"
                        height="24px"
                        viewBox="0 0 24 24"
                        version="1.1"
                      >
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path
                            d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z"
                            fill="#000000"
                            opacity="0.3"
                          />
                          <path
                            d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
                            fill="#000000"
                          />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </button>
                  <!--end::Aside Mobile Toggle-->
                  <!--begin::Dropdown Menu-->
                  <div class="dropdown dropdown-inline">
                    <button
                      type="button"
                      class="btn btn-clean btn-sm btn-icon btn-icon-md"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="ki ki-bold-more-hor icon-md"></i>
                    </button>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-left dropdown-menu-md">
                      <!--begin::Navigation-->
                      <ul class="navi navi-hover py-5">
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-drop"></i>
                            </span>
                            <span class="navi-text">New Group</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-list-3"></i>
                            </span>
                            <span class="navi-text">Contacts</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-rocket-1"></i>
                            </span>
                            <span class="navi-text">Groups</span>
                            <span class="navi-link-badge">
                              <span
                                class="label label-light-primary label-inline font-weight-bold"
                              >new</span>
                            </span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-bell-2"></i>
                            </span>
                            <span class="navi-text">Calls</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-gear"></i>
                            </span>
                            <span class="navi-text">Settings</span>
                          </a>
                        </li>
                        <li class="navi-separator my-3"></li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-magnifier-tool"></i>
                            </span>
                            <span class="navi-text">Help</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-bell-2"></i>
                            </span>
                            <span class="navi-text">Privacy</span>
                            <span class="navi-link-badge">
                              <span
                                class="label label-light-danger label-rounded font-weight-bold"
                              >5</span>
                            </span>
                          </a>
                        </li>
                      </ul>
                      <!--end::Navigation-->
                    </div>
                  </div>
                  <!--end::Dropdown Menu-->
                </div>
                <div class="text-center flex-grow-1">
                  <div class="text-dark-75 font-weight-bold font-size-h5">Matt Pears</div>
                  <div>
                    <span class="label label-sm label-dot label-success"></span>
                    <span class="font-weight-bold text-muted font-size-sm">Active</span>
                  </div>
                </div>
                <div class="text-right flex-grow-1">
                  <!--begin::Dropdown Menu-->
                  <div class="dropdown dropdown-inline">
                    <button
                      type="button"
                      class="btn btn-clean btn-sm btn-icon btn-icon-md"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <span class="svg-icon svg-icon-lg">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="24px"
                          height="24px"
                          viewBox="0 0 24 24"
                          version="1.1"
                        >
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                              d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                              fill="#000000"
                              fill-rule="nonzero"
                              opacity="0.3"
                            />
                            <path
                              d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                              fill="#000000"
                              fill-rule="nonzero"
                            />
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>
                    </button>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md">
                      <!--begin::Navigation-->
                      <ul class="navi navi-hover py-5">
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-drop"></i>
                            </span>
                            <span class="navi-text">New Group</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-list-3"></i>
                            </span>
                            <span class="navi-text">Contacts</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-rocket-1"></i>
                            </span>
                            <span class="navi-text">Groups</span>
                            <span class="navi-link-badge">
                              <span
                                class="label label-light-primary label-inline font-weight-bold"
                              >new</span>
                            </span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-bell-2"></i>
                            </span>
                            <span class="navi-text">Calls</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-gear"></i>
                            </span>
                            <span class="navi-text">Settings</span>
                          </a>
                        </li>
                        <li class="navi-separator my-3"></li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-magnifier-tool"></i>
                            </span>
                            <span class="navi-text">Help</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-bell-2"></i>
                            </span>
                            <span class="navi-text">Privacy</span>
                            <span class="navi-link-badge">
                              <span
                                class="label label-light-danger label-rounded font-weight-bold"
                              >5</span>
                            </span>
                          </a>
                        </li>
                      </ul>
                      <!--end::Navigation-->
                    </div>
                  </div>
                  <!--end::Dropdown Menu-->
                </div>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body">
                <!--begin::Scroll-->
                <div class="scroll scroll-pull" data-mobile-height="350">
                  <!--begin::Messages-->
                  <div class="messages">
                    <!--begin::Message In-->
                    <div class="d-flex flex-column mb-5 align-items-start">
                      <div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-40 mr-3">
                          <img alt="Pic" src="assets/media/users/300_12.jpg" />
                        </div>
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >Matt Pears</a>
                          <span class="text-muted font-size-sm">2 Hours</span>
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"
                      >How likely are you to recommend our company to your friends and family?</div>
                    </div>
                    <!--end::Message In-->
                    <!--begin::Message Out-->
                    <div class="d-flex flex-column mb-5 align-items-end">
                      <div class="d-flex align-items-center">
                        <div>
                          <span class="text-muted font-size-sm">3 minutes</span>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >You</a>
                        </div>
                        <div class="symbol symbol-circle symbol-40 ml-3">
                          <img alt="Pic" src="assets/media/users/300_21.jpg" />
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"
                      >Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</div>
                    </div>
                    <!--end::Message Out-->
                    <!--begin::Message In-->
                    <div class="d-flex flex-column mb-5 align-items-start">
                      <div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-40 mr-3">
                          <img alt="Pic" src="assets/media/users/300_21.jpg" />
                        </div>
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >Matt Pears</a>
                          <span class="text-muted font-size-sm">40 seconds</span>
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"
                      >Ok, Understood!</div>
                    </div>
                    <!--end::Message In-->
                    <!--begin::Message Out-->
                    <div class="d-flex flex-column mb-5 align-items-end">
                      <div class="d-flex align-items-center">
                        <div>
                          <span class="text-muted font-size-sm">Just now</span>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >You</a>
                        </div>
                        <div class="symbol symbol-circle symbol-40 ml-3">
                          <img alt="Pic" src="assets/media/users/300_21.jpg" />
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"
                      >You’ll receive notifications for all issues, pull requests!</div>
                    </div>
                    <!--end::Message Out-->
                    <!--begin::Message In-->
                    <div class="d-flex flex-column mb-5 align-items-start">
                      <div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-40 mr-3">
                          <img alt="Pic" src="assets/media/users/300_12.jpg" />
                        </div>
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >Matt Pears</a>
                          <span class="text-muted font-size-sm">40 seconds</span>
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"
                      >
                        You can unwatch this repository immediately by clicking here:
                        <a
                          href="#"
                        >https://github.com</a>
                      </div>
                    </div>
                    <!--end::Message In-->
                    <!--begin::Message Out-->
                    <div class="d-flex flex-column mb-5 align-items-end">
                      <div class="d-flex align-items-center">
                        <div>
                          <span class="text-muted font-size-sm">Just now</span>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >You</a>
                        </div>
                        <div class="symbol symbol-circle symbol-40 ml-3">
                          <img alt="Pic" src="assets/media/users/300_21.jpg" />
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"
                      >Discover what students who viewed Learn Figma - UI/UX Design. Essential Training also viewed</div>
                    </div>
                    <!--end::Message Out-->
                    <!--begin::Message In-->
                    <div class="d-flex flex-column mb-5 align-items-start">
                      <div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-40 mr-3">
                          <img alt="Pic" src="assets/media/users/300_12.jpg" />
                        </div>
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >Matt Pears</a>
                          <span class="text-muted font-size-sm">40 seconds</span>
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"
                      >Most purchased Business courses during this sale!</div>
                    </div>
                    <!--end::Message In-->
                    <!--begin::Message Out-->
                    <div class="d-flex flex-column mb-5 align-items-end">
                      <div class="d-flex align-items-center">
                        <div>
                          <span class="text-muted font-size-sm">Just now</span>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"
                          >You</a>
                        </div>
                        <div class="symbol symbol-circle symbol-40 ml-3">
                          <img alt="Pic" src="assets/media/users/300_21.jpg" />
                        </div>
                      </div>
                      <div
                        class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"
                      >Company BBQ to celebrate the last quater achievements and goals. Food and drinks provided</div>
                    </div>
                    <!--end::Message Out-->
                  </div>
                  <!--end::Messages-->
                </div>
                <!--end::Scroll-->
              </div>
              <!--end::Body-->
              <!--begin::Footer-->
              <div class="card-footer align-items-center">
                <!--begin::Compose-->
                <textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
                <div class="d-flex align-items-center justify-content-between mt-5">
                  <div class="mr-3">
                    <a href="#" class="btn btn-clean btn-icon btn-md mr-1">
                      <i class="flaticon2-photograph icon-lg"></i>
                    </a>
                    <a href="#" class="btn btn-clean btn-icon btn-md">
                      <i class="flaticon2-photo-camera icon-lg"></i>
                    </a>
                  </div>
                  <div>
                    <button
                      type="button"
                      class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6"
                    >Send</button>
                  </div>
                </div>
                <!--begin::Compose-->
              </div>
              <!--end::Footer-->
            </div>
            <!--end::Card-->
          </div>
          <!--end::Content-->
        </div>
        <!--end::Chat-->
        <!--begin::Row-->
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-xl-5">
                <!--begin::Card-->
                <div class="card card-custom gutter-b" v-if="$auth.user()['role_id'] == 1">
                  <div class="card-body py-4">
                    <div class="d-flex">
                      <!--begin::Pic-->
                      <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-80 symbol-light-success mr-2">
                          <img v-bind:src="rfq.importer_image" alt />
                        </div>
                      </div>
                      <!--end::Pic-->
                      <!--begin: Info-->
                      <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                          <!--begin::User-->
                          <div class="mr-3">
                            <div class="d-flex align-items-center mr-3">
                              <!--begin::Name-->
                              <a
                                href="#"
                                class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"
                              >{{rfq.importer_label}}</a>
                              <!--end::Name-->
                            </div>
                            <!--begin::Contacts-->
                            <div class="mt-2">
                              <span class="btn btn-text-dark-50 pt-0 pb-1 px-0 font-size-sm">
                                <span class>
                                  <i class="flaticon-email"></i>
                                  <!--end::Svg Icon-->
                                </span>
                                {{rfq.importer_email}}
                              </span>
                              <br />
                              <span class="btn btn-text-dark-50 pt-0 pb-1 px-0 font-size-sm">
                                <span class>
                                  <i class="flaticon2-phone"></i>
                                  <!--end::Svg Icon-->
                                </span>
                                {{rfq.importer_tel}}
                              </span>
                              <br />
                              <span class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm">
                                <span class>
                                  <i class="flaticon-home"></i>
                                  <!--end::Svg Icon-->
                                </span>
                                {{rfq.importer_company}}
                              </span>
                            </div>
                            <!--end::Contacts-->
                          </div>
                          <!--begin::User-->
                        </div>
                        <!--end::Title-->
                      </div>
                      <!--end::Info-->
                    </div>
                  </div>
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom">
                  <!--begin::Header-->
                  <div class="card-header h-auto py-4">
                    <div class="card-title">
                      <h3 class="card-label">Informations</h3>
                    </div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body py-4">
                    <div class="row my-2 justify-content-center">
                      <label class="col-4 col-form-label">Sujet :</label>
                      <div class="col-8 p-0">
                        <span class="form-control-plaintext font-weight-bolder">{{ rfq.sujet }}</span>
                      </div>
                    </div>
                    <div class="row my-2 justify-content-center">
                      <label class="col-4 col-form-label">Pays :</label>
                      <div class="col-8 p-0">
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-40 symbol-light-success mr-2">
                            <img
                              v-if="rfq.importer_pays_flag"
                              v-bind:src="rfq.importer_pays_flag"
                              alt
                            />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <span class="text-muted font-size-sm">{{ rfq.importer_pays_label }}</span>
                          </div>
                          <!--end::Text-->
                        </div>
                      </div>
                    </div>
                    <div class="row my-2 justify-content-center" v-if="rfq.produit_label">
                      <label class="col-4 col-form-label">Produit :</label>
                      <div class="col-8 p-0">
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-50 symbol-light-success mr-2">
                            <img v-bind:src="rfq.produit_image" alt />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <a
                              href="#"
                              class="text-dark text-hover-primary font-size-sm font-weight-bold"
                            >{{rfq.produit_label}}</a>
                            <span class="text-muted font-size-sm">{{rfq.entreprise_label}}</span>
                          </div>
                          <!--end::Text-->
                        </div>
                      </div>
                    </div>
                    <div class="row my-2 justify-content-center">
                      <label class="col-4 col-form-label">Secteur :</label>
                      <div class="col-8 p-0">
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-30 symbol-light-success mr-2">
                            <img v-bind:src="rfq.secteur_image" alt />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <a
                              href="#"
                              class="text-dark text-hover-primary font-size-sm font-weight-bold"
                            >{{rfq.secteur_label}}</a>
                          </div>
                          <!--end::Text-->
                        </div>
                      </div>
                    </div>
                    <div class="row my-2 justify-content-center">
                      <label class="col-4 col-form-label">Date d'ajout :</label>
                      <div class="col-8 p-0">
                        <span
                          class="form-control-plaintext font-weight-bolder font-roboto"
                        >{{ rfq.date }}</span>
                      </div>
                    </div>
                  </div>
                  <!--end::Body-->
                </div>
                <!--end::Card-->
              </div>
              <div class="col-xl-7">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                  <!--begin::Header-->
                  <div
                    class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto"
                  >
                    <!--begin::Left-->
                    <div class="d-flex align-items-center my-2">
                      <a href="#" class="btn btn-clean btn-icon btn-sm mr-6" data-inbox="back">
                        <i class="flaticon2-left-arrow-1"></i>
                      </a>

                      <div class="font-weight-bold text-dark font-size-h5 mr-3">{{ rfq.sujet }}</div>
                    </div>
                    <!--end::Left-->
                    <!--begin::Right-->
                    <div class="d-flex align-items-center justify-content-end text-right my-2">
                      <div class="dropdown" data-toggle="tooltip" title="Settings">
                        <span class="btn btn-default btn-icon btn-sm" data-toggle="dropdown">
                          <i class="ki ki-bold-more-hor icon-1x"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right p-0 m-0 dropdown-menu-md">
                          <!--begin::Navigation-->
                          <ul class="navi navi-hover py-5">
                            <li class="navi-item">
                              <a href="#" class="navi-link">
                                <span class="navi-icon">
                                  <i class="flaticon2-drop"></i>
                                </span>
                                <span class="navi-text">Approuver</span>
                              </a>
                            </li>
                          </ul>
                          <!--end::Navigation-->
                        </div>
                      </div>
                    </div>
                    <!--end::Right-->
                  </div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body p-0">
                    <!--begin::Messages-->
                    <div class="mb-3">
                      <div class="cursor-pointer shadow-xs toggle-on" data-inbox="message">
                        <div class="d-flex align-items-center card-spacer-x py-6">
                          <span class="symbol symbol-50 mr-4">
                            <span
                              class="symbol-label"
                              v-bind:src="rfq.importer_image"
                              v-bind:style="{
                          'background-image':
                          'url(' + rfq.importer_image + ')'
                        }"
                            ></span>
                          </span>
                          <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                            <div class="d-flex">
                              <a
                                href="#"
                                class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2"
                              >{{rfq.importer_label}}</a>
                              <div class="font-weight-bold text-muted">
                                <span class="label label-success label-dot mr-2"></span>1 Day ago
                              </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-muted mr-2">Jul 15, 2019, 11:19AM</div>
                          </div>
                        </div>
                        <div class="card-spacer-x py-3 toggle-off-item">
                          <p>Hi Bob,</p>
                          <p>With resrpect, i must disagree with Mr.Zinsser. We all know the most part of important part of any article is the title.Without a compelleing title, your reader won't even get to the first sentence.After the title, however, the first few sentences of your article are certainly the most important part.</p>
                          <p>Jornalists call this critical, introductory section the "Lede," and when bridge properly executed, it's the that carries your reader from an headine try at attention-grabbing to the body of your blog post, if you want to get it right on of these 10 clever ways to omen your next blog posr with a bang</p>
                          <p>Best regards,</p>
                          <p>Jason Muller</p>
                        </div>
                      </div>
                    </div>
                    <!--end::Messages-->
                  </div>
                  <!--end::Body-->
                </div>
                <!--end::Card-->
              </div>
            </div>
          </div>
        </div>
        <!--end::Row-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "rfqs/" + this.$route.params.id,
      search: "",
      validationErrors: null,
      rfq: [],
      trakings: [],
      statuts: [],
      rfq: null,
      traking: {
        id: null,
        rfq_id: null,
        statut_id: null,
        commentaire: null,
      },
      edit: false,
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch() {
      axios
        .get(this.url)
        .then(
          function (response) {
            this.rfq = response.data.rfq;
            this.trakings = response.data.trakings;
            this.statuts = response.data.statuts;

            //this.traking.statut_id = this.rfq.statut_id;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    trakingForm() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      this.traking.rfq_id = this.rfq.id;

      let formData = new FormData();
      $.each(this.traking, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post("rfqs/traking_form", formData, config)
        .then((response) => {
          this.clearForm();
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.traking,
        function (key, value) {
          this.traking[key] = null;
        }.bind(this)
      );
    },
    deleteColis(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer ce rfq !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .delete(this.url)
                .then((response) => {
                  this.$router.push({ path: "/rfq" });
                  swal.fire(
                    "Colis supprimé !",
                    "Le Colis a été supprimé avec succés.",
                    "success"
                  );
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
  },
};
</script>
