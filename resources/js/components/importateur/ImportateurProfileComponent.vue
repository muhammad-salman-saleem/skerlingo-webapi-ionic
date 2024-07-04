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
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Fiche Importateur</h5>
          <!--end::Title-->
          <!--begin::Breadcrumb-->
          <ul
            class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm"
          >
            <li class="breadcrumb-item">
              <router-link to="/importateurs" class="text-muted">Importateurs</router-link>
            </li>
            <li class="breadcrumb-item" v-if="importateur">
              <a href="#" class="text-muted">{{ importateur.nomComplet }}</a>
            </li>
          </ul>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Details-->

        <div class="d-flex align-items-center">
          <div
            class="dropdown dropdown-inline"
            v-if="$auth.user()['role_id'] == 1"
            data-toggle="tooltip"
            title="Quick actions"
            data-placement="left"
          >
            <a
              href="#"
              class="btn btn-sm btn-primary"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Actions
              <span class="ml-2 svg-icon svg-icon-primary svg-icon-lg">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                <i class="flaticon-settings pr-0"></i>
                <!--end::Svg Icon-->
              </span>
            </a>
            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right py-3">
              <!--begin::Navigation-->
              <ul class="navi navi-hover py-5 pl-0">
                <li class="navi-item" v-if="!importateur.enabled">
                  <button @click="activer_compte()" class="navi-link pr-0 w-100 text-left">
                    <span class="navi-icon">
                      <i class="flaticon2-shield"></i>
                    </span>
                    <span class="navi-text">Activer le compte</span>
                  </button>
                </li>
                <li class="navi-item" v-if="importateur.enabled">
                  <button @click="bloquer_compte()" class="navi-link pr-0 w-100 text-left">
                    <span class="navi-icon">
                      <i class="flaticon2-delete"></i>
                    </span>
                    <span class="navi-text">Bloquer le compte</span>
                  </button>
                </li>
              </ul>
              <!--end::Navigation-->
            </div>
          </div>
          <!--end::Dropdowns-->
        </div>
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Card-->
        <div class="card card-custom">
          <!--begin::Card header-->
          <div class="card-header card-header-tabs-line nav-tabs-line-3x">
            <!--begin::Toolbar-->
            <div class="card-toolbar">
              <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                <!--begin::Item-->
                <li class="nav-item mr-3">
                  <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1">
                    <span class="nav-icon">
                      <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
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
                              d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                              fill="#000000"
                              fill-rule="nonzero"
                            />
                            <path
                              d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                              fill="#000000"
                              opacity="0.3"
                            />
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>
                    </span>
                    <span class="nav-text font-size-lg">Informations</span>
                  </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                  <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_2">
                    <span class="nav-icon">
                      <span class="svg-icon">
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
                              d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                              fill="#000000"
                              fill-rule="nonzero"
                              opacity="0.3"
                            />
                            <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1" />
                            <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1" />
                          </g>
                        </svg>
                      </span>
                    </span>
                    <span class="nav-text font-size-lg">RFQS</span>
                  </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                  <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_3">
                    <span class="nav-icon">
                      <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-importateur.svg-->
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
                              d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                              fill="#000000"
                              opacity="0.3"
                            />
                            <path
                              d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                              fill="#000000"
                              opacity="0.3"
                            />
                            <path
                              d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                              fill="#000000"
                              opacity="0.3"
                            />
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>
                    </span>
                    <span class="nav-text font-size-lg">Mot de passe</span>
                  </a>
                </li>
                <!--end::Item-->
              </ul>
            </div>
            <!--end::Toolbar-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body">
            <div class="tab-content">
              <!--begin::Tab-->
              <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                <!--begin::Row-->
                <form @submit.prevent="saveProfile">
                  <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-7 my-2">
                      <!--begin::Group-->
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Photo</label>
                        <div class="col-9 pt-0 pb-0">
                          <div
                            class="image-input image-input-empty image-input-outline"
                            id="kt_user_edit_avatar"
                            v-bind:style="{'background-image':'url(' + importateur.image_url + ')' }"
                          >
                            <div class="image-input-wrapper"></div>
                            <label
                              class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="change"
                              data-toggle="tooltip"
                              title
                              data-original-title="Change avatar"
                            >
                              <i class="fa fa-pen icon-sm text-muted"></i>
                              <input
                                type="file"
                                name="image"
                                v-on:change="onImageChange"
                                accept=".png, .jpg, .jpeg"
                              />
                              <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span
                              class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="cancel"
                              data-toggle="tooltip"
                              title="Cancel avatar"
                            >
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span
                              class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="remove"
                              data-toggle="tooltip"
                              title="Remove avatar"
                            >
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                          </div>
                          <br />
                          <span
                            class="label label-lg label-primary label-inline font-weight-normal"
                            v-if="importateur.enabled"
                          >Compte actif</span>
                          <span
                            class="label label-lg label-danger label-inline font-weight-normal"
                            v-if="!importateur.enabled"
                          >Compte bloqué</span>
                        </div>
                      </div>
                      <!--end::Group-->
                      <!--begin::Group-->
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Nom</label>
                        <div class="col-9 pt-0 pb-0">
                          <input
                            class="form-control form-control-lg form-control-solid"
                            type="text"
                            v-model="importateur.nom"
                          />
                        </div>
                      </div>
                      <!--end::Group-->
                      <!--begin::Group-->
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Prénom</label>
                        <div class="col-9 pt-0 pb-0">
                          <input
                            class="form-control form-control-lg form-control-solid"
                            type="text"
                            v-model="importateur.prenom"
                          />
                        </div>
                      </div>
                      <!--end::Group-->
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Téléphone</label>
                        <div class="col-9 pt-0 pb-0">
                          <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="la la-phone"></i>
                              </span>
                            </div>
                            <input
                              type="text"
                              class="form-control form-control-lg form-control-solid"
                              v-model="importateur.tel"
                              placeholder="Téléphone"
                            />
                          </div>
                        </div>
                      </div>
                      <!--end::Group-->
                      <!--begin::Group-->
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Email</label>
                        <div class="col-9 pt-0 pb-0">
                          <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="la la-at"></i>
                              </span>
                            </div>
                            <input
                              type="text"
                              class="form-control form-control-lg form-control-solid"
                              v-model="importateur.email"
                              placeholder="Email"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row d-none">
                        <label class="col-form-label col-3 text-lg-right text-left">Ville</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            v-model="importateur.ville_id"
                            :items="villes"
                            clearable
                            dense
                            filled
                          ></v-autocomplete>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label
                          class="col-form-label col-3 text-lg-right text-left"
                        >Pays de résidence</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            v-model="importateur.pays_id"
                            :items="pays"
                            clearable
                            dense
                            filled
                          ></v-autocomplete>
                        </div>
                      </div>
                      <div class="form-group row d-none">
                        <label class="col-form-label col-3 text-lg-right text-left">Banque</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            v-model="importateur.banque_id"
                            :items="banques"
                            clearable
                            dense
                            filled
                          ></v-autocomplete>
                        </div>
                      </div>
                      <div class="form-group row d-none">
                        <label class="col-form-label col-3 text-lg-right text-left">RIB</label>
                        <div class="col-9 pt-0 pb-0">
                          <input
                            class="form-control form-control-lg form-control-solid"
                            type="text"
                            v-model="importateur.rib"
                          />
                        </div>
                      </div>

                      <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                      <!--end::Group-->
                    </div>
                  </div>
                  <!--end::Row-->
                  <div class="card-footer pb-0">
                    <div class="row">
                      <div class="col-xl-2"></div>
                      <div class="col-xl-7">
                        <div class="row">
                          <div class="col-3"></div>
                          <div class="col-9 pt-0 pb-0">
                            <button
                              type="submit"
                              class="btn btn-light-primary font-weight-bold"
                            >Enregistrer</button>
                            <a href="#" class="btn btn-clean font-weight-bold">Annuler</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!--end::Tab-->
              <!--begin::Tab-->
              <div class="tab-pane px-7" id="kt_user_edit_tab_2" role="tabpanel">
                <v-card style="box-shadow: none;">
                  <v-data-table class="table" :headers="_headers" :items="rfqs">
                    <template v-slot:item.importer_label="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark font-size-sm font-weight-bold"
                      >
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-40 symbol-light-success mr-2">
                            <img
                              v-if="item.importer_pays_flag"
                              v-bind:src="item.importer_pays_flag"
                              alt
                            />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <span
                              class="text-dark font-size-sm font-weight-bold"
                            >{{item.importer_label}}</span>
                            <span
                              class="text-muted font-size-xs"
                            >{{ item.importer_company }} - {{ item.importer_pays_label }}</span>
                          </div>
                          <!--end::Text-->
                        </div>
                      </router-link>
                    </template>
                    <template v-slot:item.importer_company="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark font-size-sm font-weight-bold"
                      >
                        <span class="font-size-sm">{{ item.importer_company }}</span>
                      </router-link>
                    </template>
                    <template v-slot:item.importer_pays_label="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark font-size-sm font-weight-bold"
                      >
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-30 symbol-light-success mr-2">
                            <img
                              v-if="item.importer_pays_flag"
                              v-bind:src="item.importer_pays_flag"
                              alt
                            />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <span
                              class="text-dark font-size-sm font-weight-bold"
                            >{{item.importer_pays_label}}</span>
                          </div>
                          <!--end::Text-->
                        </div>
                      </router-link>
                    </template>
                    <template v-slot:item.produit_label="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark font-size-sm font-weight-bold"
                      >
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-50 symbol-light-success mr-2">
                            <img v-bind:src="item.produit_image" alt />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <span
                              class="text-dark font-size-sm font-weight-bold"
                            >{{item.produit_label}}</span>
                            <span class="text-muted font-size-sm">{{item.entreprise_label}}</span>
                          </div>
                          <!--end::Text-->
                        </div>
                      </router-link>
                    </template>
                    <template v-slot:item.secteur_label="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark font-size-sm font-weight-bold"
                      >
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-30 symbol-light-success mr-2">
                            <img v-bind:src="item.secteur_image" alt />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <a
                              href="#"
                              class="text-dark font-size-sm font-weight-bold"
                            >{{item.secteur_label}}</a>
                          </div>
                          <!--end::Text-->
                        </div>
                      </router-link>
                    </template>
                    <template v-slot:item.published="{ item }">
                      <span
                        class="label label-inline font-weight-normal"
                        v-bind:style="{
                                color: '#fff',
                                'background-color':
                                'rgb(' + item.statut_color + ')'
                              }"
                      >{{ item.statut_label }}</span>
                    </template>
                    <template v-slot:item.closed="{ item }">
                      <span
                        v-if="!item.closed"
                        style="background-color: #006266"
                        class="label label-warning label-inline font-weight-lighter mr-1"
                      >Ouverte</span>
                      <span
                        v-if="item.closed"
                        style="background-color: #1B1464"
                        class="label label-dark label-inline font-weight-lighter mr-1"
                      >Clôturée</span>
                    </template>
                    <template v-slot:item.sujet="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark font-size-sm font-weight-bold"
                      >
                        <span class="d-block font-size-sm">{{ item.sujet }}</span>
                      </router-link>
                    </template>
                    <template v-slot:item.date="{ item }">
                      <span class="d-block font-roboto">{{ item.date }}</span>
                    </template>

                    <template v-slot:item.actions="{ item }">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="btn btn-icon btn-light btn-sm"
                      >
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
                      </router-link>
                    </template>
                  </v-data-table>
                </v-card>
                <!--begin::Body-->
              </div>
              <!--end::Tab-->
              <!--begin::Tab-->
              <div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">
                <!--begin::Body-->
                <form @submit.prevent="savePassword">
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-xl-2"></div>
                      <div class="col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                          <label
                            class="col-form-label col-3 text-lg-right text-left"
                          >Nouveau mot de passe :</label>
                          <div class="col-9 pt-0 pb-0">
                            <input
                              class="form-control form-control-lg form-control-solid"
                              type="password"
                              v-model="password.nouveau"
                              placeholder="Nouveau mot de passe"
                            />
                          </div>
                        </div>
                        <!--end::Group-->
                        <!--begin::Group-->
                        <div class="form-group row">
                          <label class="col-form-label col-3 text-lg-right text-left">Confirmer</label>
                          <div class="col-9 pt-0 pb-0">
                            <input
                              class="form-control form-control-lg form-control-solid"
                              type="password"
                              v-model="password.confirmation"
                              placeholder="Confirmer"
                            />
                          </div>
                        </div>
                        <!--end::Group-->
                      </div>
                    </div>
                    <!--end::Row-->
                  </div>
                  <!--end::Body-->
                  <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                  <!--begin::Footer-->
                  <div class="card-footer pb-0">
                    <div class="row">
                      <div class="col-xl-2"></div>
                      <div class="col-xl-7">
                        <div class="row">
                          <div class="col-3"></div>
                          <div class="col-9 pt-0 pb-0">
                            <button
                              type="submit"
                              class="btn btn-light-primary font-weight-bold"
                            >Enregistrer</button>
                            <a href="#" class="btn btn-clean font-weight-bold">Annuler</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Footer-->
                </form>
              </div>
              <!--end::Tab-->
            </div>
          </div>
          <!--begin::Card body-->
        </div>
        <!--end::Card-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->

    <div
      class="modal fade"
      id="modal_form_document"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Joindre un document</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form @submit.prevent="saveDocument" class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Libellé :</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nom de la ville"
                  v-model="document.label"
                />
              </div>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Piéce jointe :</label>
                <input
                  type="file"
                  v-on:change="onImageDocument"
                  accept=".png, .jpg, .jpeg"
                  class="form-control"
                  placeholder="Piéce jointe"
                />
              </div>
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
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueDropify from "vue-dropify";

export default {
  components: {
    "vue-dropify": VueDropify,
  },
  data() {
    return {
      url: "importateurs",

      headers: [
        {
          text: "Sector",
          align: "middle",
          value: "secteur_label",
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "Subject" : "Sujet",
          align: "middle",
          value: "sujet",
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "Status" : "Statut",
          align: "middle",
          value: "published",
          hide: this.$auth.user()["role_id"] == 2,
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "State" : "Etat",
          align: "middle",
          value: "closed",
          hide: this.$auth.user()["role_id"] == 2 || this.$route.query.product,
        },
        { text: "Date", align: "middle", value: "date" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      importateur: {
        id: null,
        nom: null,
        prenom: null,
        email: null,
        image: null,
        image_url: null,
        tel: null,
        pays_id: null,
        ville_id: null,
        banque_id: null,
        rib: null,
      },
      documents: [],
      banques: [],
      pays: [],
      villes: [],
      rfqs: [],
      password: {
        actuel: null,
        nouveau: null,
        confirmation: null,
      },
      document: {
        label: null,
        file: null,
        importateur_id: null,
      },
      edit: false,
    };
  },
  computed: {
    _headers() {
      return this.headers.filter((x) => !x.hide);
    },
  },
  created() {
    var avatar = new KTImageInput("kt_user_edit_avatar");
    this.fetch();
  },
  methods: {
    fetch() {
      window.scrollTo(0, 0);
      let params = {};
      if (this.$route.params.id) params["id"] = this.$route.params.id;
      axios
        .get("importateurs/profile", {
          params: params,
        })
        .then(
          function (response) {
            this.importateur = response.data.importateur;
            this.documents = response.data.documents;
            this.pays = response.data.pays;
            this.villes = response.data.villes;
            this.banques = response.data.banques;
            this.rfqs = response.data.rfqs;
            var avatar = new KTImageInput("kt_user_edit_avatar");
            //CVCustom.init();
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    valider_importateur(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de valider l'inscription de ce importateur !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Valider",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.importateur.id;
              axios
                .get("importateurs/valider_importateur", {
                  params: params,
                })
                .then((response) => {
                  this.$root.$refs.AdminSideBar.fetch();
                  swal.fire(
                    "Inscription Validée",
                    "L'inscription a été validée avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    activer_compte(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point d'activer ce compte importateur !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Activer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.importateur.id;
              axios
                .get("importateurs/activer_compte", {
                  params: params,
                })
                .then((response) => {
                  swal.fire(
                    "Compte activé",
                    "Le compte a été activé avec succés.",
                    "success"
                  );
                  this.importateur = response.data.importateur;
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    bloquer_compte(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de bloquer ce compte importateur !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Bloquer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.importateur.id;
              axios
                .get("importateurs/bloquer_compte", {
                  params: params,
                })
                .then((response) => {
                  swal.fire(
                    "Compte bloqué",
                    "Le compte a été bloqué avec succés.",
                    "success"
                  );
                  this.importateur = response.data.importateur;
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveProfile() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.importateur, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.importateur = response.data.importateur;
          this.validationErrors = null;
          swal.fire("Le changement a été effectué!", "", "success");
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    saveDocument() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      this.document.importateur_id = this.importateur.id;

      let formData = new FormData();
      $.each(this.document, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post("importateurs/add_document", formData, config)
        .then((response) => {
          this.importateur = response.data.importateur;
          this.documents = response.data.documents;
          this.validationErrors = null;
          $("#modal_form_document").modal("toggle");
          swal.fire("Le document a été ajouté avec succés !", "", "success");
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    savePassword() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.password, function (key, value) {
        formData.append(key, value);
      });

      formData.append("id", this.importateur.id);

      axios
        .post("importateurs/change_password", formData, config)
        .then((response) => {
          this.validationErrors = null;
          swal.fire(
            "Votre mot de passe a été changé avec succès !",
            "",
            "success"
          );
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
        this.fonctionalite,
        function (key, value) {
          this.fonctionalite[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.importateur.image = e.target.files[0];
    },
    onImageDocument(e) {
      this.document.file = e.target.files[0];
      console.log(this.document);
    },
  },
};
</script>
