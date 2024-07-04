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
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{page_title}}</h5>
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
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Chat-->
        <div class="d-flex flex-row">
          <!--begin::Aside-->
          <div
            v-if="false"
            class="flex-row-auto offcanvas-mobile w-350px w-xl-400px"
            id="kt_chat_asides"
          >
            <!--begin::Card-->
            <div class="card card-custom">
              <!--begin::Body-->
              <div class="card-body px-3">
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
                  <input
                    type="text"
                    v-model="search"
                    class="form-control py-4 h-auto"
                    placeholder="Search"
                  />
                </div>
                <!--end:Search-->
                <!--begin:Users-->
                <div class="mt-7 scroll scroll-pull">
                  <v-card style="box-shadow: none;">
                    <v-data-table
                      :footer-props="{
                          'items-per-page-options': []
                      }"
                      class="table no-td-p"
                      :headers="_headers"
                      :items="rfqs"
                      :search="search"
                    >
                      <template v-slot:item.importer_label="{ item }">
                        <!--begin:User-->
                        <a @click="fetch(item.id)">
                          <div
                            class="d-flex align-items-center justify-content-between p-3"
                            :style="[rfq && item.id == rfq.id ? {'background-color': '#F7F7F7'} : {}]"
                          >
                            <div
                              class="d-flex align-items-center"
                              v-if="$auth.user()['role_id'] != 3"
                            >
                              <div class="symbol symbol-circle symbol-50 mr-5">
                                <img
                                  alt="Pic"
                                  v-if="item.importer_image"
                                  v-bind:src="item.importer_image"
                                />
                                <img
                                  style="width: 30px; height: auto; max-width: initial; border-radius: 0; position: absolute; right: -10px; bottom: -10px;"
                                  v-if="item.importer_pays_flag"
                                  v-bind:src="item.importer_pays_flag"
                                  alt
                                />
                              </div>
                              <div class="d-flex flex-column">
                                <span
                                  :style="[rfq && item.id == rfq.id ? {'font-weight': 'bold !important'} : {}]"
                                  class="text-dark-75 text-hover-primary font-weight-bold font-size-md"
                                >{{item.importer_label}}</span>
                                <span
                                  :style="[rfq && item.id == rfq.id ? {'font-weight': 'bold !important'} : {}]"
                                  class="text-muted font-size-xs"
                                >{{ item.sujet }}</span>
                                <div>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2 && !item.validation_date && !item.closed"
                                    class="label label-sm label-warning label-inline font-weight-lighter mr-1"
                                  >TO APPROVE</span>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2 && item.validation_date && !item.closed"
                                    class="label label-sm label-success label-inline font-weight-lighter mr-1"
                                  >APPROUVED</span>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2 && item.closed && false"
                                    class="label label-sm label-dark label-inline font-weight-lighter mr-2"
                                  >CLOSED</span>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2"
                                    class="label label-sm label-primary label-inline font-weight-lighter mr-1"
                                  >{{ item.active_proposals }} PROPOSALS</span>
                                </div>
                              </div>
                            </div>
                            <div
                              class="d-flex align-items-center"
                              v-if="$auth.user()['role_id'] == 3"
                            >
                              <div class="symbol symbol-50 mr-5">
                                <img
                                  alt="Pic"
                                  v-if="item.produit_label"
                                  v-bind:src="item.produit_image"
                                />
                                <img
                                  alt="Pic"
                                  v-if="!item.produit_label"
                                  v-bind:src="item.secteur_image"
                                />
                              </div>
                              <div class="d-flex flex-column">
                                <span
                                  :style="[rfq && item.id == rfq.id ? {'font-weight': 'bold !important'} : {}]"
                                  class="text-dark-75 text-hover-primary font-weight-bold font-size-md"
                                >{{item.sujet}}</span>
                                <span
                                  :style="[rfq && item.id == rfq.id ? {'font-weight': 'bold !important'} : {}]"
                                  class="text-muted font-size-xs"
                                >{{ item.produit_label?item.produit_label:item.secteur_label }}</span>
                                <div>
                                  <span
                                    v-if="$auth.user()['role_id'] == 1 && !item.validation_date && !item.closed"
                                    class="label label-sm label-warning label-inline font-weight-lighter mr-1"
                                  >TO APPROVE</span>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2 && item.validation_date && !item.closed"
                                    class="label label-sm label-success label-inline font-weight-lighter mr-1"
                                  >APPROUVED</span>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2 && item.closed && false"
                                    class="label label-sm label-dark label-inline font-weight-lighter mr-2"
                                  >CLOSED</span>
                                  <span
                                    v-if="$auth.user()['role_id'] != 2"
                                    class="label label-sm label-primary label-inline font-weight-lighter mr-2"
                                  >{{ item.active_proposals }} PROPOSALS</span>
                                </div>
                              </div>
                            </div>
                            <div class="d-flex flex-column align-items-end max-w-90px">
                              <span
                                :style="[rfq && item.id == rfq.id ? {'font-weight': 'bold !important'} : {}]"
                                class="text-muted text-right font-size-xs"
                              >{{ item.date_human }}</span>
                            </div>
                          </div>
                        </a>
                        <!--end:User-->
                      </template>
                    </v-data-table>
                  </v-card>
                </div>
                <!--end:Users-->
              </div>
              <!--end::Body-->
            </div>
            <!--end::Card-->
          </div>
          <!--end::Aside-->
          <!--begin::Content-->
          <div class="flex-row-fluid ml-lg-8s" id="kt_chat_content" v-if="rfq">
            <!--begin::Card-->
            <div class="card card-custom gutter-b" v-if="$auth.user()['role_id'] != 3">
              <div class="card-body py-4">
                <div class="d-flex">
                  <!--begin::Pic-->
                  <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq.importer_image" alt />

                      <img
                        style="width: 30px; height: auto; max-width: initial; border-radius: 0; position: absolute; right: -5px; bottom: -5px;"
                        v-if="rfq.importer_pays_flag"
                        v-bind:src="rfq.importer_pays_flag"
                        alt
                      />
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
                          <span
                            v-if="$auth.user()['role_id'] == 1"
                            class="label label-light-success label-inline font-weight-bolder mr-1"
                          >Compte actif</span>
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
                          <span class="btn btn-text-dark-50 pt-0 pb-1 px-0 font-size-sm">
                            <span class>
                              <i class="flaticon2-phone"></i>
                              <!--end::Svg Icon-->
                            </span>
                            {{rfq.importer_tel}}
                          </span>
                          <br v-if="$auth.user()['role_id'] == 1" />
                          <span
                            v-if="$auth.user()['role_id'] == 1"
                            class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm"
                          >
                            <span class>
                              <i class="flaticon-user"></i>
                              <!--end::Svg Icon-->
                            </span>
                            Member since : {{ rfq.importer_since }}
                          </span>
                          <br />
                          <span class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm mt-1">
                            <span class>
                              <i class="flaticon-home"></i>
                              <!--end::Svg Icon-->
                            </span>
                            {{rfq.importer_company}}
                          </span>
                          <span class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm mt-1">
                            <span class>
                              <i class="flaticon-earth-globe"></i>
                              <!--end::Svg Icon-->
                            </span>
                            {{rfq.importer_pays_label}}
                          </span>
                        </div>
                        <!--end::Contacts-->
                      </div>
                      <!--begin::User-->
                    </div>
                    <!--end::Title-->
                  </div>
                  <!--end::Info-->
                  <div class="flex-shrink-0" v-if="rfq.produit_label">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq.produit_image" class="m-auto" alt />
                      <span
                        class="d-block text-center font-size-xs text-dark max-w-90px font-weight-bold mt-1"
                      >{{rfq.produit_label}}</span>
                    </div>
                  </div>
                  <div class="flex-shrink-0" v-if="!rfq.produit_label">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq.secteur_image" class="m-auto" alt />
                      <span
                        class="d-block text-center font-size-xs text-dark max-w-90px font-weight-bold mt-1"
                      >{{rfq.secteur_label}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="card card-custom gutter-b"
              v-if="$auth.user()['role_id'] == 3 && rfq.produit_label"
            >
              <div class="card-body py-4">
                <div class="d-flex">
                  <!--begin::Pic-->
                  <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq.entreprise_image" alt />
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
                          >{{rfq.entreprise_label}}</a>
                          <!--end::Name-->
                        </div>
                        <!--begin::Contacts-->
                        <div class="mt-2">
                          <span class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm mt-1">
                            <span class>
                              <i class="flaticon-home"></i>
                              <!--end::Svg Icon-->
                            </span>
                            {{rfq.secteur_label}}
                          </span>
                        </div>
                        <!--end::Contacts-->
                      </div>
                      <!--begin::User-->
                    </div>
                    <!--end::Title-->
                  </div>
                  <!--end::Info-->
                  <div class="flex-shrink-0" v-if="rfq.produit_label">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq.produit_image" class="m-auto" alt />
                      <span
                        class="d-block text-center font-size-xs text-dark max-w-90px font-weight-bold mt-1"
                      >{{rfq.produit_label}}</span>
                    </div>
                  </div>
                  <div class="flex-shrink-0" v-if="!rfq.produit_label">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq.secteur_image" class="m-auto" alt />
                      <span
                        class="d-block text-center font-size-xs text-dark max-w-90px font-weight-bold mt-1"
                      >{{rfq.secteur_label}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="card card-custom gutter-b"
              v-if="$auth.user()['role_id'] == 3 && !rfq.produit_label  && rfq_entreprise && contact_entreprise"
            >
              <div class="card-body py-4">
                <div class="d-flex">
                  <!--begin::Pic-->
                  <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="rfq_entreprise.entreprise_image" alt />
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
                          >{{contact_entreprise.nomComplet}}</a>
                          <!--end::Name-->
                        </div>
                        <!--begin::Contacts-->
                        <div class="mt-2">
                          <span class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm mt-1">
                            <span class>
                              <i class="flaticon-whatsapp"></i>
                              <!--end::Svg Icon-->
                            </span>
                            {{contact_entreprise.tel}}
                          </span>
                          <span
                            class="btn btn-text-dark-50 pt-0 pb-0 px-0 font-size-sm mt-1 d-block"
                          >
                            <span class>
                              <i class="flaticon-multimedia"></i>
                              <!--end::Svg Icon-->
                            </span>
                            {{contact_entreprise.email}}
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
              <div class="card-header align-items-center px-4 py-3">
                <div class="text-left flex-grow-1">
                  <div class="text-dark-75 font-weight-bold font-size-h5 mb-1">{{ rfq.sujet }}</div>
                  <span
                    class="label label-inline font-weight-bold text-uppercase"
                    v-bind:style="{
                                color: '#FFF',
                                'background-color':
                                'rgb(' + rfq.statut_color + ')'
                              }"
                  >{{ rfq.statut_label }}</span>
                  <span v-if="$auth.user()['role_id'] != 2">
                    <span
                      v-if="rfq.closed"
                      class="label label-dark label-inline font-weight-lighter mr-2"
                      style="background-color: #1B1464"
                    >Clôturée</span>
                    <span
                      v-if="$auth.user()['role_id'] == 1 && !rfq.published  && !rfq.produit_label"
                      class="label label-danger label-inline font-weight-lighter mr-2"
                    >UNPUBLISHED</span>
                    <span
                      v-if="$auth.user()['role_id'] == 1 && rfq.published  && !rfq.produit_label"
                      class="label label-primary label-inline font-weight-lighter mr-2"
                    >PUBLISHED</span>
                  </span>
                </div>
                <div class="text-right flex-grow-1">
                  <!--begin::Dropdown Menu-->

                  <button
                    v-if="$auth.user()['role_id'] == 3 && !rfq.closed && !rfq.produit_id"
                    @click="close_rfq()"
                    type="button"
                    class="btn btn-dark btn-sm btn-icon-md"
                  >
                    <i class="mr-2 flaticon-close icon-md"></i>
                    Close the request
                  </button>
                  <div class="dropdown dropdown-inline" v-if="$auth.user()['role_id'] == 1">
                    <button
                      type="button"
                      class="btn btn-clean btn-sm btn-icon-md"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      Actions
                      <i class="ml-2 ki ki-bold-more-hor icon-md"></i>
                    </button>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md">
                      <!--begin::Navigation-->
                      <ul class="navi navi-hover py-5 pl-0">
                        <li class="navi-item" v-if="rfq.statut_id == 1">
                          <a @click="change_statut(rfq.id, 'approuver')" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-interface-5"></i>
                            </span>
                            <span class="navi-text">Approuver la demande</span>
                          </a>
                        </li>
                        <li class="navi-item" v-if="rfq.statut_id == 1">
                          <a @click="change_statut(rfq.id, 'refuser')" class="navi-link">
                            <span class="navi-icon">
                              <i class="fa la-times"></i>
                            </span>
                            <span class="navi-text">Refuser la demande</span>
                          </a>
                        </li>
                        <li
                          class="navi-item"
                          v-if="rfq_entreprises.length == 0 && !rfq.entreprise_id && rfq.statut_id == 2"
                        >
                          <a href="#modal_form_approuver" data-toggle="modal" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-interface-5"></i>
                            </span>
                            <span class="navi-text">Diffusion de la RFQ Direct</span>
                          </a>
                        </li>
                        <li
                          class="navi-item"
                          v-if="rfq_entreprises && !rfq.produit_label && !rfq.published && rfq.statut_id == 2"
                        >
                          <a @click="publier_rfq()" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-share"></i>
                            </span>
                            <span class="navi-text">Publier sur le site</span>
                          </a>
                        </li>
                        <li class="navi-item" v-if="rfq_entreprises && !rfq.closed && false">
                          <a @click="close_rfq()" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-close"></i>
                            </span>
                            <span class="navi-text">Close the request</span>
                          </a>
                        </li>
                        <li
                          class="navi-item"
                          v-if="rfq_entreprises.length > 0 && rfq.published && rfq.entreprise_id"
                        >
                          <a @click="retirer_rfq()" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-circle"></i>
                            </span>
                            <span class="navi-text">Retirer de la plateforme</span>
                          </a>
                        </li>

                        <li
                          class="navi-item"
                          v-if="rfq_entreprises.length > 0 && !rfq.entreprise_id"
                        >
                          <a href="#modal_form_approuver" data-toggle="modal" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-map"></i>
                            </span>
                            <span class="navi-text">Entreprises contactées</span>
                          </a>
                        </li>
                        <li class="navi-item" v-if="rfq_entreprises">
                          <a @click="deleteRfq(rfq.id)" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-delete"></i>
                            </span>
                            <span class="navi-text">Supprimer</span>
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
                <div v-slimscroll="optionsScroll">
                  <v-card
                    v-if="!rfq_entreprise && rfq_proposals.length > 0"
                    style="box-shadow: none;"
                  >
                    <v-data-table
                      hide-default-footer
                      class="table no-td-rl-p"
                      :headers="_headers_entreprises_messagerie"
                      :items="rfq_proposals"
                    >
                      <template v-slot:item.entreprise_label="{ item }">
                        <a @click="show_messages(item)">
                          <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light-success mr-2">
                              <img v-bind:src="item.entreprise_image" alt />
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                              <span
                                class="text-dark text-hover-primary font-size-sm font-weight-bold"
                              >{{item.entreprise_label}}</span>
                            </div>
                            <!--end::Text-->
                          </div>
                        </a>
                      </template>
                      <template v-slot:item.date_human="{ item }">
                        <span class="d-block font-roboto">{{ item.date_human }}</span>
                      </template>
                      <template v-slot:item.messages_count="{ item }">
                        <a @click="show_messages(item)">
                          <span
                            class="label label-lg label-inline font-weight-normal"
                          >{{ item.messages_count }}</span>
                        </a>
                      </template>
                      <template v-slot:item.actions="{ item }">
                        <a @click="show_messages(item)" class="btn btn-icon btn-light btn-sm">
                          <span class="svg-icon svg-icon-md svg-icon-success">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
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
                                <rect
                                  fill="#000000"
                                  opacity="0.5"
                                  transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                  x="11"
                                  y="5"
                                  width="2"
                                  height="14"
                                  rx="1"
                                />
                                <path
                                  d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                  fill="#000000"
                                  fill-rule="nonzero"
                                  transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"
                                />
                              </g>
                            </svg>
                            <!--end::Svg Icon-->
                          </span>
                        </a>
                      </template>
                    </v-data-table>
                  </v-card>
                  <!--begin::Messages-->
                  <div class="messages" v-if="rfq_entreprise || rfq_proposals.length == 0">
                    <a
                      href="#"
                      v-if="rfq_proposals.length > 1"
                      @click="show_messages()"
                      class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-danger font-weight-bold btn-hover-bg-light p-0 mb-5"
                    >
                      <i class="flaticon2-left-arrow mr-1"></i>Retour
                    </a>
                    <!--begin::Message In-->
                    <div class="d-flex flex-column mb-5 align-items-start">
                      <div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-40 mr-3">
                          <img alt="Pic" v-if="rfq.importer_image" v-bind:src="rfq.importer_image" />
                        </div>
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-sm"
                          >
                            {{ rfq.importer_label }}
                            <span
                              class="d-block text-muted font-size-xs"
                            >{{ rfq.date_human }}</span>
                          </a>
                        </div>
                      </div>
                      <div
                        style="white-space: pre-line;"
                        class="mt-2 rounded p-5 bg-light-success text-dark-50 font-size-sm text-left max-w-600px"
                      >{{ rfq.message }}</div>
                    </div>
                    <!--end::Message In-->
                    <div
                      class="d-flex flex-column mb-5"
                      v-for="message in messages"
                      v-bind:class="{ 'align-items-start': !message.to_importer, 'align-items-end': message.to_importer  }"
                      v-bind:key="message.id"
                    >
                      <div class="d-flex align-items-center" v-if="!message.to_importer">
                        <div class="symbol symbol-circle symbol-40 mr-3">
                          <img alt="Pic" v-if="message.from_image" v-bind:src="message.from_image" />
                        </div>
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-sm"
                          >
                            {{ message.from_label }}
                            <span
                              class="d-block text-muted font-size-xs"
                            >{{ message.date_human }}</span>
                          </a>
                        </div>
                      </div>
                      <div class="d-flex align-items-center" v-if="message.to_importer">
                        <div>
                          <a
                            href="#"
                            class="text-dark-75 text-hover-primary font-weight-bold font-size-sm"
                          >
                            {{ message.from_label }}
                            <span
                              class="d-block text-muted font-size-xs"
                            >{{ message.date_human }}</span>
                          </a>
                        </div>
                        <div class="symbol symbol-circle symbol-40 ml-3">
                          <img alt="Pic" v-if="message.from_image" v-bind:src="message.from_image" />
                        </div>
                      </div>
                      <div
                        style="white-space: pre-line;"
                        v-bind:class="{ 'bg-light-success': !message.to_importer, 'bg-light-primary': message.to_importer  }"
                        class="mt-2 rounded p-5 text-dark-50 font-size-sm text-left max-w-600px"
                      >
                        {{ message.message }}
                        <a
                          v-for="(file, index) in message.files_path"
                          :href="file"
                          download
                          class="label label-light-dark label-inline mr-2 mt-2"
                          v-bind:key="file+index"
                        >Pièce jointe {{ index + 1 }}</a>
                      </div>
                    </div>
                  </div>
                  <!--end::Messages-->
                </div>
                <!--end::Scroll-->
              </div>
              <!--end::Body-->
              <!--begin::Footer-->
              <div
                v-if="rfq_entreprise && $auth.user()['role_id'] != 1"
                class="card-footer align-items-center"
              >
                <!--begin::Compose-->
                <textarea
                  class="form-control border-0 p-0"
                  rows="4"
                  v-model="message_text"
                  placeholder="Type a message"
                ></textarea>

                <div class="d-flex align-items-center justify-content-between mt-5">
                  <div class="mr-3">
                    <v-file-input multiple small-chips v-model="message_files" truncate-length="13"></v-file-input>
                    <a href="#" class="btn btn-clean btn-icon btn-md mr-1 d-none">
                      <i class="flaticon-upload-1 icon-lg"></i>
                    </a>
                  </div>
                  <div>
                    <button
                      :disabled="!message_text"
                      @click="send_message($event)"
                      type="button"
                      class="btn btn-primary btn-md spinner-light-success spinner-right text-uppercase font-weight-bold py-2 px-6"
                    >Send message</button>
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
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->

    <div
      class="modal fade"
      id="modal_form_approuver"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Diffusion de la RFQ Direct :</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="saveEntreprises(false)" class="mb-3">
            <ul class="nav nav-tabs nav-tabs-line mb-5">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                  <span class="nav-icon">
                    <i class="flaticon2-chat-1"></i>
                  </span>
                  <span class="nav-text">Envoyer à :</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                  <span class="nav-icon">
                    <i class="flaticon2-pie-chart-4"></i>
                  </span>
                  <span class="nav-text">Entreprises contactées</span>
                </a>
              </li>
            </ul>

            <div class="tab-content mt-5" id="myTabContent">
              <div
                class="tab-pane fade show active"
                id="kt_tab_pane_1"
                role="tabpanel"
                aria-labelledby="kt_tab_pane_2"
              >
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group mb-0 mt-3">
                        <div class="checkbox-inline">
                          <label class="checkbox checkbox-rounded">
                            <input
                              type="checkbox"
                              v-model="publish_request.imediat"
                              name="Checkboxes15_1"
                            />
                            <span></span>Send immediately to :
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group mb-0">
                        <v-autocomplete
                          :items="entites"
                          small-chips
                          :disabled="!publish_request.imediat"
                          v-model="publish_request.imediat_ids"
                          clearable
                          multiple
                          dense
                          filled
                        ></v-autocomplete>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group mb-0 mt-3">
                        <div class="checkbox-inline">
                          <label class="checkbox checkbox-rounded">
                            <input
                              type="checkbox"
                              v-model="publish_request.after_24h"
                              name="Checkboxes15_1"
                            />
                            <span></span>Send after 24H :
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group mb-0">
                        <v-autocomplete
                          :items="entites"
                          :disabled="!publish_request.after_24h"
                          v-model="publish_request.after_24h_ids"
                          small-chips
                          clearable
                          multiple
                          dense
                          filled
                        ></v-autocomplete>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group mb-0 mt-3">
                        <div class="checkbox-inline">
                          <label class="checkbox checkbox-rounded">
                            <input
                              type="checkbox"
                              v-model="publish_request.after_48h"
                              name="Checkboxes15_1"
                            />
                            <span></span>Send after 48H :
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group mb-0">
                        <v-autocomplete
                          :items="entites"
                          small-chips
                          :disabled="!publish_request.after_48h"
                          v-model="publish_request.after_48h_ids"
                          clearable
                          multiple
                          dense
                          filled
                        ></v-autocomplete>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group mb-0 mt-3">
                        <div class="checkbox-inline">
                          <label class="checkbox checkbox-rounded">
                            <input
                              type="checkbox"
                              v-model="publish_request.publish_online"
                              name="Checkboxes15_1"
                            />
                            <span></span>
                            Publish online
                            <b
                              class="ml-2"
                            >( show to all connected visitors)</b>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    @click="clearForm()"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                  >Fermer</button>
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="kt_tab_pane_2"
                role="tabpanel"
                aria-labelledby="kt_tab_pane_2"
              >
                <div class="modal-body">
                  <v-card style="box-shadow: none;">
                    <v-data-table
                      hide-default-footer
                      class="table no-td-rl-p"
                      :headers="_headers_entreprises"
                      :items="rfq_entreprises"
                    >
                      <template v-slot:item.entreprise_label="{ item }">
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-50 symbol-light-success mr-2">
                            <img v-bind:src="item.entreprise_image" alt />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <a
                              href="#"
                              class="text-dark text-hover-primary font-size-sm font-weight-bold"
                            >{{item.entreprise_label}}</a>
                            <span
                              v-if="item.groupe_label"
                              class="text-muted font-size-xs font-weight-bold"
                            >{{item.groupe_label}}</span>
                          </div>
                          <!--end::Text-->
                        </div>
                      </template>
                      <template v-slot:item.sent="{ item }">
                        <span
                          v-if="item.sent"
                          class="label label-lg label-primary label-inline"
                        >SENT</span>
                        <span
                          v-if="!item.sent"
                          class="label label-lg label-warning label-inline"
                        >SCHEDULED</span>
                      </template>
                      <template v-slot:item.date_human="{ item }">
                        <span class="d-block font-roboto">{{ item.date_human }}</span>
                      </template>
                    </v-data-table>
                  </v-card>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "rfqs/" + (this.$route.params.id ? this.$route.params.id : ""),
      optionsScroll: {
        height: "350px",
        allowPageScroll: true,
        size: "5px",
        start: "bottom",
      },
      headers: [
        {
          text: "RFQ",
          align: "middle",
          value: "importer_label",
        },
      ],
      headers_entreprises: [
        {
          text: "Entreprise",
          align: "middle",
          value: "entreprise_label",
        },
        {
          text: "Envoi",
          align: "middle",
          value: "sent",
        },
        { text: "Date", align: "middle", value: "date_human" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      headers_entreprises_messagerie: [
        {
          text: "Exporter",
          align: "middle",
          value: "entreprise_label",
        },
        { text: "Messages", align: "middle", value: "messages_count" },
        { text: "Date", align: "middle", value: "date_human" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      search: "",
      validationErrors: null,
      rfq_entreprise: null,
      page_title: null,
      message_text: null,
      message_files: null,
      rfq: [],
      rfqs: [],
      rfq_entreprises: [],
      rfq_proposals: [],
      messages: [],
      contact_entreprise: null,
      trakings: [],
      entites: [],
      statuts: [],
      rfq: null,
      traking: {
        id: null,
        rfq_id: null,
        statut_id: null,
        commentaire: null,
      },
      filter: {
        date:
          moment().startOf("year").format("Y-MM-DD") +
          " - " +
          moment().endOf("year").format("Y-MM-DD"),
        rfq_product: null,
        statut: null,
        code: null,
        partenaire: null,
      },
      publish_request: {
        imediat: null,
        imediat_ids: [],
        after_24h: null,
        after_24h_ids: [],
        after_48h: null,
        after_48h_ids: [],
        publish_online: null,
        rfq_id: null,
      },
      edit: false,
    };
  },
  mounted() {
    setTimeout(
      function () {
        KTAppChat.init();
      }.bind(this),
      1000
    );
  },
  computed: {
    _headers() {
      return this.headers.filter((x) => !x.hide);
    },
    _headers_entreprises() {
      return this.headers_entreprises.filter((x) => !x.hide);
    },
    _headers_entreprises_messagerie() {
      return this.headers_entreprises_messagerie.filter((x) => !x.hide);
    },
  },
  created() {
    if (this.$route.query.product || (this.rfq && this.rfq.entreprise_id)) {
      this.filter.rfq_product = true;
      if (this.$auth.user()["role_id"] == 1) {
        this.page_title = "Product/service requests";
      } else if (this.$auth.user()["role_id"] == 2) {
        this.page_title = "RFQs - From your Catalog";
      } else {
        this.page_title = "My Requests for Quotation";
      }
    } else {
      if (this.$auth.user()["role_id"] == 1) {
        this.page_title = "Direct requests";
      } else if (this.$auth.user()["role_id"] == 2) {
        this.page_title = "RFQ - From skerlingo";
      } else {
        this.page_title = "My Requests for Quotation";
      }
    }

    this.fetch();
  },
  methods: {
    fetch(id) {
      if (this.rfq && id && this.rfq.id == id) return false;

      if (this.$route.query.rcode) {
        this.filter.code = this.$route.query.rcode;
        this.url = "rfqs/rcode";
      } else if (id) {
        this.url = "rfqs/" + id;
      } else if (!this.$route.params.id) {
        this.$router.push({ path: "/rfqs" });
      }
      let params = {};
      $.each(this.filter, function (key, value) {
        params[key] = value;
      });
      axios
        .get(id ? "rfqs/" + id : this.url, {
          params: params,
        })
        .then(
          function (response) {
            this.rfq = response.data.rfq;
            if (response.data.trakings) this.trakings = response.data.trakings;
            if (response.data.statuts) this.statuts = response.data.statuts;
            this.rfqs = response.data.rfqs;
            if (response.data.rfq_entreprises)
              this.rfq_entreprises = response.data.rfq_entreprises;
            if (response.data.rfq_proposals) {
              this.rfq_proposals = response.data.rfq_proposals;
              if (this.rfq_proposals.length == 1) {
                this.rfq_entreprise = this.rfq_proposals[0];
              } else if (this.rfq_proposals.length == 0) {
                this.rfq_entreprise = null;
              }
            }
            if (response.data.entites) this.entites = response.data.entites;
            if (this.rfq_entreprise) {
              this.get_messages(this.rfq_entreprise.id);
            } else {
              this.messages = [];
            }

            if (this.rfq && this.rfq.entreprise_id) {
              this.filter.rfq_product = true;
              if (this.$auth.user()["role_id"] == 1) {
                this.page_title = "Product/service requests";
              } else if (this.$auth.user()["role_id"] == 2) {
                this.page_title = "RFQs - From your Catalog";
              } else {
                this.page_title = "My Requests for Quotation";
              }
            } else {
              if (this.$auth.user()["role_id"] == 1) {
                this.page_title = "Direct requests";
              } else if (this.$auth.user()["role_id"] == 2) {
                this.page_title = "RFQ - From skerlingo";
              } else {
                this.page_title = "My Requests for Quotation";
              }
            }
            //window.scrollTo(0, 0);

            //this.traking.statut_id = this.rfq.statut_id;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    get_messages(rfq_entreprise_id) {
      axios
        .get("rfqs/get_messages?id=" + rfq_entreprise_id)
        .then(
          function (response) {
            this.messages = response.data.messages;
            this.contact_entreprise = response.data.contact_entreprise;

            //$("html, body").animate({ scrollTop: $(document).height() }, 1000);

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
    saveEntreprises(entreprise_product = false) {
      let params = {};
      $.each(this.publish_request, function (key, value) {
        params[key] = value;
      });
      if (entreprise_product) params["approuver_entreprise_product"] = true;

      params["rfq_id"] = this.rfq.id;

      axios
        .post("rfqs/save_entreprises", params)
        .then((response) => {
          if (!entreprise_product) {
            $("#modal_form_approuver").modal("toggle");
          }

          this.publish_request.imediat_ids = [];
          this.publish_request.after_24h_ids = [];
          this.publish_request.after_48h_ids = [];
          this.clearForm();
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    change_statut(id, type) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text:
            type == "refuser"
              ? "Vous êtes sur le point de refuser cette RFQ !"
              : "Vous êtes sur le point d'approuver cette RFQ !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: type == "refus" ? "Refuser" : "Approuver",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = id;
              params["type"] = type;
              axios
                .get("rfqs/change_statut", {
                  params: params,
                })
                .then((response) => {
                  swal.fire(
                    response.data.title,
                    response.data.message,
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    send_message(e) {
      e.target.disabled = true;
      e.target.classList.toggle("spinner");

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();

      formData.append("rfq_entreprise_id", this.rfq_entreprise.id);
      formData.append("rfq_id", this.rfq.id);
      formData.append("entreprise_id", this.rfq_entreprise.entreprise_id);
      formData.append("message", this.message_text);

      $.each(this.message_files, function (i, file) {
        formData.append("files[]", file);
      });

      axios
        .post("rfqs/send_message", formData, config)
        .then((response) => {
          this.message_text = null;
          this.message_files = [];
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          this.clearForm();
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    publier_rfq() {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de publier cette demande sur le site !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Publier",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.rfq.id;
              params["publish"] = true;
              axios
                .post("rfqs/published", params)
                .then((response) => {
                  swal.fire(
                    "La Demande est maintenant publiée sur le site.",
                    "",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    close_rfq() {
      swal
        .fire({
          title: "Are you sure ?",
          text: "You are about to close this request !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Close the request",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.rfq.id;
              params["close"] = true;
              axios
                .post("rfqs/published", params)
                .then((response) => {
                  swal.fire("The Request has been closed.", "", "success");
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    retirer_rfq(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de retirer cette demande de la plateforme !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Retirer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.rfq.id;
              params["publish"] = false;
              axios
                .post("rfqs/published", params)
                .then((response) => {
                  this.$root.$refs.AdminSideBar.fetch();
                  swal.fire(
                    "La Demande à été retirée de  la plateforme.",
                    "",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
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
    show_messages(rfq_entreprise = null) {
      this.rfq_entreprise = rfq_entreprise;
      this.get_messages(this.rfq_entreprise.id);
    },
    deleteRfq(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer cette demande !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post("rfqs/" + id, { _method: "DELETE" })
                .then((response) => {
                  this.url = "rfqs/";
                  this.fetch();
                  swal.fire(
                    "Rfq supprimé !",
                    "Le demande a été supprimée avec succés.",
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
