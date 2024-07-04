<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Formations</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <form class="ml-5">
              <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                <input type="text" v-model="search" class="form-control" placeholder="Recherche..." />
                <div class="input-group-append">
                  <span class="input-group-text">
                    <span class="svg-icon">
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
                    <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!--end::Info-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
          <a
            @click="addProduit()"
            data-toggle="modal"
            href="#modal_form_produit"
            class="btn btn-primary btn-sm d-none"
          >
            <i class="ki ki-plus icon-1x"></i>Ajouter un produit
          </a>
        </div>
        <!--end::Toolbar-->
      </div>
    </div>

    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="card card-custom gutter-b" v-if="$auth.user()['role_id'] == 1">
          <div class="card-body p-4 pr-8 pl-8">
            <div class="row justify-content-center">
              <div class="col-xl-4">
                <div class="form-group mb-0">
                  <label>État du formation</label>
                  <v-autocomplete
                    :items="types"
                    v-model="filter.validation_exporteur"
                    clearable
                    dense
                    filled
                  ></v-autocomplete>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group mb-0">
                  <label>Catégorie</label>
                  <v-autocomplete
                    :items="rubriques_produit"
                    v-model="filter.secteur"
                    clearable
                    dense
                    filled
                  >
                    <template v-slot:item="data">
                      <template>
                        <v-list-item-avatar style="border-radius: 0;">
                          <img v-if="!data.item.parent_label" :src="data.item.avatar" />
                          <img
                            v-if="data.item.parent_label"
                            style="width: 25px; height: 25px;"
                            :src="data.item.avatar"
                          />
                        </v-list-item-avatar>
                        <v-list-item-content>
                          <v-list-item-title v-html="data.item.text"></v-list-item-title>
                          <v-list-item-subtitle v-html="data.item.parent_label"></v-list-item-subtitle>
                        </v-list-item-content>
                      </template>
                    </template>
                  </v-autocomplete>
                </div>
              </div>
              <div class="col-xl-3 d-none">
                <div class="form-group mb-0">
                  <label>Marque</label>
                  <v-autocomplete :items="marques" v-model="filter.marque" clearable dense filled></v-autocomplete>
                </div>
              </div>
              <div class="col-xl-1 mt-7">
                <button @click="fetch()" class="btn btn-primary btn-block">
                  <span class="navi-icon">
                    <i class="flaticon-search"></i>
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-custom gutter-b">
          <div class="card-header card-header-nob">
            <div class="card-title">
              <h3 class="card-label">{{ produits.length }} Formations</h3>
            </div>
          </div>
          <div class="card-body p-5 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table
                class="table overflow-initial"
                :headers="_headers"
                :items="produits"
                :search="search"
              >
                <template v-slot:item.marque_label="{ item }">
                  <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-30 symbol-light-success mr-2">
                      <img v-bind:src="item.marque_image" alt />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <a
                        href="#"
                        class="text-dark text-hover-primary font-size-xs font-weight-bold"
                      >{{item.marque_label}}</a>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.label="{ item }">
                  <div class="d-flex align-items-center" @click="editProduit(item)">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50 symbol-light-success mr-2">
                      <img v-bind:src="item.image_url" alt />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <a
                        href="#"
                        class="text-dark text-hover-primary font-size-sm font-weight-bold"
                      >{{item.label}}</a>
                      <span class="text-muted font-size-xs">{{item.secteur_label}}</span>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.date="{ item }">
                  <span class="font-size-sm font-roboto">{{ item.date }}</span>
                </template>
                <template v-slot:item.caracteristiques="{ item }">
                  <span
                    class="label label-lg label-inline font-weight-normal"
                  >{{ item.caracteristiques.length }}</span>
                </template>
                <template v-slot:item.validation_date_entreprise="{ item }">
                  <span
                    v-if="!item.validation_date_entreprise"
                    class="label label-lg label-light-danger label-inline font-weight-normal"
                  >Brouillon</span>
                  <span
                    v-if="item.validation_date_entreprise"
                    class="label label-lg label-light-info label-inline font-weight-normal"
                  >Publié</span>
                  <div
                    v-if="item.validation_date_entreprise && false"
                    class="d-flex align-items-center"
                  >
                    <div class="symbol symbol-35 symbol-light-success mr-2 flex-shrink-0">
                      <div class="symbol-label">
                        <span class="svg-icon svg-icon-md svg-icon-success">
                          <i class="flaticon2-checkmark font-size-h4"></i>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="text-dark font-size-sm font-weight-bolder d-block"
                      >{{ item.validation_label_entreprise }}</a>
                      <span class="text-muted font-size-xs">{{ item.validation_date_entreprise }}</span>
                    </div>
                  </div>
                </template>
                <template v-slot:item.validation_date_skerlingo="{ item }">
                  <span
                    v-if="!item.validation_date_skerlingo && !item.refus_date"
                    class="label label-lg label-light-warning label-inline font-weight-normal"
                  >A valider</span>
                  <span
                    v-if="item.refus_date"
                    class="label label-lg label-light-danger label-inline font-weight-normal"
                  >Refusé</span>
                  <span
                    v-if="item.validation_date_skerlingo"
                    class="label label-lg label-light-info label-inline font-weight-normal"
                  >Validé</span>
                  <div
                    v-if="item.validation_date_skerlingo && false"
                    class="d-flex align-items-center"
                  >
                    <div class="symbol symbol-35 symbol-light-success mr-2 flex-shrink-0">
                      <div class="symbol-label">
                        <span class="svg-icon svg-icon-md svg-icon-success">
                          <i class="flaticon2-checkmark font-size-h4"></i>
                        </span>
                      </div>
                    </div>
                    <div>
                      <a
                        href="#"
                        class="text-dark font-size-sm font-weight-bolder d-block"
                      >{{ item.validation_label_skerlingo }}</a>
                      <span class="text-muted font-size-xs">{{ item.validation_date_skerlingo }}</span>
                    </div>
                  </div>
                </template>
                <template v-slot:item.actions="{ item }">
                  <div class="dropdown dropdown-inline">
                    <a
                      href="javascript:;"
                      class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2"
                      data-toggle="dropdown"
                    >
                      <i class="ki ki-bold-more-hor"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right w-300px">
                      <ul class="navi flex-column navi-hover py-2" style="padding-inline-start: 0;">
                        <li
                          class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2"
                        >Actions :</li>
                        <li class="navi-item">
                          <a @click="editProduit(item)" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-edit"></i>
                            </span>
                            <span class="navi-text">Détails</span>
                          </a>
                        </li>
                        <li v-if="!item.validation_date_entreprise" class="navi-item">
                          <a
                            @click="valider_produit(item.id, 'entreprise')"
                            href="#"
                            class="navi-link"
                          >
                            <span class="navi-icon">
                              <i class="la la-check"></i>
                            </span>
                            <span class="navi-text">Publier le produit</span>
                          </a>
                        </li>
                        <li
                          v-if="item.refus_date && $auth.user()['role_id'] == 1"
                          class="navi-item"
                        >
                          <a @click="annuler_produit(item.id, 'refus')" href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="la la-check"></i>
                            </span>
                            <span class="navi-text">Annuler le refus</span>
                          </a>
                        </li>
                        <li
                          v-if="item.validation_date_skerlingo && $auth.user()['role_id'] == 1"
                          class="navi-item"
                        >
                          <a @click="annuler_produit(item.id, 'asmex')" href="#" class="navi-link">
                            <span class="navi-icon">
                              <i class="la la-check"></i>
                            </span>
                            <span class="navi-text">
                              Annuler la validation
                              <small
                                v-if="$auth.user()['role_id'] == 1"
                              >(asmex)</small>
                            </span>
                          </a>
                        </li>
                        <li v-if="item.validation_date_entreprise" class="navi-item">
                          <a
                            @click="annuler_produit(item.id, 'entreprise')"
                            href="#"
                            class="navi-link"
                          >
                            <span class="navi-icon">
                              <i class="la la-check"></i>
                            </span>
                            <span class="navi-text">Mettre en Brouillon</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a @click="deleteProduit(item.id)" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-delete-1"></i>
                            </span>
                            <span class="navi-text">Supprimer</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </template>
              </v-data-table>
            </v-card>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_produit"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!produit.id" class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
            <h5 v-if="produit.id" class="modal-title" id="exampleModalLabel">Modifier un produit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="mb-3">
            <div class="modal-body p-0">
              <div class="card gutter-b mb-0" v-bind:class="{ 'overlay overlay-block': overlay }">
                <div class>
                  <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line">
                      <li class="nav-item">
                        <a
                          class="nav-link active"
                          data-toggle="tab"
                          ref="infoTabs"
                          href="#kt_tab_pane_1_4"
                        >
                          <span class="nav-icon">
                            <i class="flaticon2-chat-1"></i>
                          </span>
                          <span class="nav-text">Informations</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                          <span class="nav-icon">
                            <i class="flaticon2-drop"></i>
                          </span>
                          <span class="nav-text">Caractéristiques</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link"
                          ref="imageTabs"
                          data-toggle="tab"
                          href="#kt_tab_pane_3_4"
                        >
                          <span class="nav-icon">
                            <i class="flaticon-photo-camera"></i>
                          </span>
                          <span class="nav-text">Photos</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="overlay-wrapper">
                  <div class="card-body">
                    <div class="tab-content">
                      <div
                        class="tab-pane fade show active"
                        id="kt_tab_pane_1_4"
                        role="tabpanel"
                        aria-labelledby="kt_tab_pane_1_4"
                      >
                        <ul class="nav nav-tabs pl-0" id="myTab" role="tablist">
                          <li
                            class="nav-item"
                            @click="changeLang(l)"
                            v-for="l in langues"
                            v-bind:key="l.value"
                          >
                            <a
                              class="nav-link"
                              v-bind:class="{ 'active': langue == l.value  }"
                              id="home-tab"
                              data-toggle="tab"
                              href="#"
                            >
                              <span class="nav-icon">
                                <i class="far fa-flag"></i>
                              </span>
                              <span class="nav-text">{{ l.text }}</span>
                            </a>
                          </li>
                        </ul>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group mb-2" v-if="$auth.user()['role_id'] == 1">
                              <label for="recipient-name" class="form-control-label">Marque :</label>
                              <v-autocomplete
                                v-model="produit.marque_id"
                                :items="marques"
                                clearable
                                dense
                                filled
                              ></v-autocomplete>
                            </div>
                            <div class="form-group d-none mb-2">
                              <label>Produit/Service</label>
                              <div class="radio-inline">
                                <label class="radio">
                                  <input
                                    type="radio"
                                    name="radios2"
                                    value="non"
                                    v-model="produit.service"
                                  />
                                  <span></span>Produit
                                </label>
                                <label class="radio">
                                  <input
                                    type="radio"
                                    name="radios2"
                                    value="oui"
                                    v-model="produit.service"
                                  />
                                  <span></span>Service
                                </label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div
                                  v-for="l in langues"
                                  v-bind:key="l.value"
                                  v-bind:class="{ 'd-none': langue != l.value  }"
                                >
                                  <div class="form-group mb-0">
                                    <label for="recipient-name" class="form-control-label">
                                      Nom du produit/service
                                      <small>
                                        <b>[{{l.value}}]</b>
                                      </small>
                                    </label>
                                    <input
                                      type="text"
                                      autocomplete="off"
                                      class="form-control"
                                      :placeholder="'Nom du produit/service '+l.value "
                                      v-model="produit['label_'+l.value]"
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group mb-0">
                                  <label for="recipient-name" class="form-control-label">Catégorie :</label>
                                  <v-autocomplete
                                    v-model="produit.secteur_id"
                                    :items="rubriques_produit"
                                    clearable
                                    dense
                                    filled
                                  >
                                    <template v-slot:item="data">
                                      <template>
                                        <v-list-item-avatar style="border-radius: 0;">
                                          <img
                                            v-if="!data.item.parent_label"
                                            :src="data.item.avatar"
                                          />
                                          <img
                                            v-if="data.item.parent_label"
                                            style="width: 20px; height: 20px;margin-left:20px;"
                                            :src="data.item.avatar"
                                          />
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                          <v-list-item-title v-html="data.item.text"></v-list-item-title>
                                          <v-list-item-subtitle v-html="data.item.parent_label"></v-list-item-subtitle>
                                        </v-list-item-content>
                                      </template>
                                    </template>
                                  </v-autocomplete>
                                </div>
                              </div>
                            </div>

                            <div
                              class="form-group"
                              v-for="l in langues"
                              v-bind:key="l.value"
                              v-bind:class="{ 'd-none': langue != l.value  }"
                            >
                              <label for="recipient-name" class="form-control-label">
                                Description rapide
                                <small>
                                  <b>[{{l.value}}]</b>
                                </small>
                                <small>(120 caractères max)</small>
                              </label>
                              <textarea
                                class="form-control"
                                maxlength="120"
                                v-model="produit['introduction_'+l.value]"
                                rows="3"
                              ></textarea>
                            </div>
                          </div>
                          <div class="col-md-4 d-none">
                            <div class="form-group mt-2 mb-2 text-center">
                              <label class="d-block mb-3">Photo</label>
                              <div
                                class="image-input image-input-empty image-input-outline"
                                id="kt_user_edit_avatar_produit"
                                v-bind:style="{ 'background-image': 'url(' + produit.image_url + ')' }"
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
                                    name="profile_avatar"
                                    v-on:change="onImageChangeProduit"
                                    accept=".png, .jpg, .jpeg, .svg"
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
                            </div>
                          </div>
                        </div>

                        <div
                          class="form-group"
                          v-for="l in langues"
                          v-bind:key="l.value"
                          v-bind:class="{ 'd-none': langue != l.value  }"
                        >
                          <label for="recipient-name" class="form-control-label">
                            Description
                            <small>
                              <b>[{{l.value}}]</b>
                            </small> :
                          </label>
                          <!-- Use the component in the right place of the template -->
                          <tiptap-vuetify
                            :extensions="extensions"
                            v-model="produit['details_'+l.value]"
                          />
                        </div>

                        <div class="form-group">
                          <label for="recipient-name" class="form-control-label">Mot clés</label>
                          <v-combobox
                            v-model="produit.keywords"
                            chips
                            clearable
                            label="Mot clés"
                            multiple
                            prepend-icon="mdi-filter-variant"
                            solo
                          >
                            <template v-slot:selection="{ attrs, item, select, selected }">
                              <v-chip
                                v-bind="attrs"
                                :input-value="selected"
                                close
                                @click="select"
                                @click:close="removeKeywords(item)"
                              >{{ item }}&nbsp;</v-chip>
                            </template>
                          </v-combobox>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="form-control-label">Fiche technique</label>
                          <v-file-input small-chips v-model="produit_fiche" truncate-length="13"></v-file-input>
                        </div>
                      </div>
                      <div
                        class="tab-pane fade"
                        id="kt_tab_pane_2_4"
                        role="tabpanel"
                        aria-labelledby="kt_tab_pane_2_4"
                      >
                        <ul class="nav nav-tabs pl-0" id="myTab" role="tablist">
                          <li
                            class="nav-item"
                            @click="changeLang(l)"
                            v-for="l in langues"
                            v-bind:key="l.value"
                          >
                            <a
                              class="nav-link"
                              v-bind:class="{ 'active': langue == l.value  }"
                              id="home-tab"
                              data-toggle="tab"
                              href="#"
                            >
                              <span class="nav-icon">
                                <i class="far fa-flag"></i>
                              </span>
                              <span class="nav-text">{{ l.text }}</span>
                            </a>
                          </li>
                        </ul>

                        <h4 class="text-dark mt-3 font-weight-bolder">Caractéristiques</h4>
                        <div
                          class="row"
                          v-for="(caracteristique, index) in produit.caracteristiques"
                          v-bind:key="caracteristique.id"
                        >
                          <div class="col-md-4">
                            <div
                              class="form-group mb-0"
                              v-for="l in langues"
                              v-bind:key="l.value"
                              v-bind:class="{ 'd-none': langue != l.value  }"
                            >
                              <input
                                type="text"
                                autocomplete="off"
                                class="form-control"
                                :placeholder="'Caractéristique ['+l.value+']'"
                                v-model="caracteristique['label_'+l.value]"
                              />
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div
                              class="form-group mb-0"
                              v-for="l in langues"
                              v-bind:key="l.value"
                              v-bind:class="{ 'd-none': langue != l.value  }"
                            >
                              <input
                                type="text"
                                autocomplete="off"
                                class="form-control"
                                :placeholder="'Valeur ['+l.value+']'"
                                v-model="caracteristique['value_'+l.value]"
                              />
                            </div>
                          </div>
                          <div class="col-md-1 pl-0">
                            <a
                              @click="deleteCaracteristique(index)"
                              class="btn btn-danger btn-block btn-sm mt-1"
                            >
                              <i class="flaticon-delete icon-1x"></i>
                            </a>
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                          <a @click="addCaracteristique()" class="btn btn-primary btn-sm">
                            <i class="ki ki-plus icon-1x"></i> Ajouter
                          </a>
                        </div>
                      </div>

                      <div
                        class="tab-pane fade"
                        id="kt_tab_pane_3_4"
                        role="tabpanel"
                        aria-labelledby="kt_tab_pane_3_4"
                      >
                        <div class="symbol-list d-flex flex-wrap">
                          <div
                            v-for="(image, index) in produit.images"
                            v-bind:key="image.id"
                            class="symbol symbol-150 m-5"
                          >
                            <img alt="Pic" :src="image.image_url" />
                            <a
                              href="#"
                              @click="deleteImage(image.id)"
                              class="symbol-badge btn btn-icon btn-danger btn-circle mr-2"
                              style="width: 30px; height: 30px; right: -20px; top: -11px; border: none;"
                            >
                              <i class="nav-icon flaticon-delete" style="font-size: 13px;"></i>
                            </a>
                          </div>
                          <div
                            class="image-input image-input-empty image-input-outline m-5"
                            id="kt_user_edit_avatar_produit_image"
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
                                name="profile_avatar"
                                v-on:change="onImageChangeProduitImage"
                                accept=".png, .jpg, .jpeg, .svg"
                              />
                              <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span
                              class="btn btn-xs remove_image btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="remove"
                              data-toggle="tooltip"
                              title="Remove avatar"
                            >
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                  </div>
                </div>

                <div class="overlay-layer bg-dark-o-10" v-if="overlay">
                  <div class="spinner spinner-primary"></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="clearForm()"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Fermer</button>
              <button
                type="button"
                @click="saveProduit($event)"
                class="btn btn-primary spinner-light-success spinner-right"
              >Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  TiptapVuetify,
  Heading,
  Bold,
  Italic,
  Strike,
  Underline,
  Code,
  Paragraph,
  BulletList,
  OrderedList,
  ListItem,
  Link,
  Blockquote,
  HardBreak,
  HorizontalRule,
  History,
} from "tiptap-vuetify";

export default {
  components: {
    TiptapVuetify,
  },
  data() {
    return {
      url: "produits",
      search: "",
      headers: [
        { text: "Formation", align: "middle", value: "label", width: "280px" },
        {
          text: "État du formation",
          align: "middle",
          value: "validation_date_entreprise",
        },
        { text: "Date d'ajout", align: "middle", value: "date" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      filter: {
        type: null,
        secteur: null,
        marque: null,
        validation_skerlingo: null,
        validation_exporteur: null,
      },
      validationErrors: null,
      entreprise_categorie: null,
      produits: [],
      marques: [],
      langues: [],
      langue: "fr",
      rubriques_produit: [],
      rubriques_produit_filtred: [],
      types: [],
      types_skerlingo: [],
      produit_fiche: null,
      produit: {
        id: null,
        label: null,
        label_en: null,
        label_fr: null,
        introduction: null,
        introduction_en: null,
        introduction_fr: null,
        details: null,
        details_en: null,
        details_fr: null,
        service: "non",
        image: null,
        image_url: null,
        fiche_url: null,
        secteur_id: null,
        marque_id: null,
        caracteristiques: [],
        keywords: [],
        images: [],
      },
      overlay: null,
      edit: false,
      extensions: [
        History,
        Blockquote,
        Link,
        Underline,
        Strike,
        Italic,
        ListItem,
        BulletList,
        OrderedList,
        [
          Heading,
          {
            options: {
              levels: [1, 2, 3],
            },
          },
        ],
        Bold,
        Code,
        HorizontalRule,
        Paragraph,
        HardBreak,
      ],
    };
  },
  computed: {
    _headers() {
      return this.headers.filter((x) => !x.hide);
    },
  },
  created() {
    if (this.$route.query.a_valider) {
      this.filter.validation_skerlingo = "non_valide";
      this.filter.validation_exporteur = "valide";
    }
    this.fetch();
  },
  methods: {
    fetch() {
      let params = {};
      $.each(this.filter, function (key, value) {
        params[key] = value;
      });
      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            if (response.data.marques) this.marques = response.data.marques;
            this.types = response.data.types;
            this.types_skerlingo = response.data.types_skerlingo;
            this.rubriques_produit = response.data.rubriques_produit;
            this.produits = response.data.produits;
            this.langues = response.data.langues;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    saveProduit(e) {
      e.target.disabled = true;
      e.target.classList.toggle("spinner");
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      if (this.produit.images.length == 0) {
        const elem = this.$refs.imageTabs;
        elem.click();
        swal.fire(
          "Ajouter une photo",
          "Au moins une photo est requise pour ajouter le produit.",
          "warning"
        );
        e.target.disabled = false;
        e.target.classList.toggle("spinner");
        return false;
      }

      let formData = new FormData();
      $.each(this.produit, function (key, value) {
        formData.append(key, value ? value : "");
      });
      formData.append(
        "caracteristiques",
        JSON.stringify(this.produit.caracteristiques)
      );
      formData.append("keywords", JSON.stringify(this.produit.keywords));
      formData.append("images", JSON.stringify(this.produit.images));
      formData.append("fiche", this.produit_fiche);

      axios
        .post(this.url, formData, config)
        .then((response) => {
          swal.fire(response.data.title, response.data.message, "success");
          this.clearForm();
          $("#modal_form_produit").modal("toggle");
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          this.fetch();
        })
        .catch((error) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addProduit() {
      const elem = this.$refs.infoTabs;
      elem.click();

      this.clearForm();
      this.produit.image_url =
        "https://via.placeholder.com/300/004c68/FFF?text=Image";
      this.validationErrors = null;
      var avatar = new KTImageInput("kt_user_edit_avatar_produit");
      var avatarTwo = new KTImageInput("kt_user_edit_avatar_produit_image");
      this.addCaracteristique();
    },
    editProduit(produit) {
      const elem = this.$refs.infoTabs;
      elem.click();

      produit = _.cloneDeep(produit);

      $("#modal_form_produit").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      var avatar = new KTImageInput("kt_user_edit_avatar_produit");
      var avatar = new KTImageInput("kt_user_edit_avatar_produit_image");
      $.each(
        this.produit,
        function (key, value) {
          this.produit[key] = produit[key];
        }.bind(this)
      );

      let entreprise = this.marques.filter(
        (c) => c.value == this.produit.marque_id
      )[0];
      this.rubriques_produit_filtred = this.rubriques_produit;

      this.addCaracteristique();
    },
    valider_produit(id, type) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text:
            type == "refus"
              ? "Vous êtes sur le point de refuser ce produit !"
              : "Vous êtes sur le point de valider ce produit !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: type == "refus" ? "Refuser" : "Valider",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = id;
              params["type"] = type;
              axios
                .get("produits/valider_produit", {
                  params: params,
                })
                .then((response) => {
                  this.$root.$refs.AdminSideBar.fetch();
                  swal.fire(
                    response.data.title
                      ? response.data.title
                      : "Produit Validé",
                    response.data.message
                      ? response.data.message
                      : "Le produit a été validé avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    annuler_produit(id, type) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text:
            type == "refus"
              ? "Vous êtes sur le point d'annuler le refus !"
              : "Vous êtes sur le point d'annuler la validation du produit !",
          type: "question",
          showCancelButton: true,
          confirmButtonText:
            type == "refus" ? "Annuler le refus" : "Annuler la validation",
          cancelButtonText: "Fermer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = id;
              params["type"] = type;
              axios
                .get("produits/annuler_produit", {
                  params: params,
                })
                .then((response) => {
                  this.$root.$refs.AdminSideBar.fetch();
                  swal.fire(
                    response.data.title
                      ? response.data.title
                      : "Validation annulé",
                    response.data.message
                      ? response.data.message
                      : "La validation a été annulée avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    deleteProduit(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer ce produit !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post(this.url + "/" + id, { _method: "DELETE" })
                .then((response) => {
                  swal.fire(
                    "Produit supprimé !",
                    "Le Produit a été supprimé avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    removeKeywords(item) {
      this.produit.keywords.splice(this.produit.keywords.indexOf(item), 1);
      this.produit.keywords = [...this.produit.keywords];
    },
    addCaracteristique() {
      this.produit.caracteristiques.push({});
    },
    deleteCaracteristique(index) {
      this.$delete(this.produit.caracteristiques, index);
      console.log(this.produit.caracteristiques);
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.produit,
        function (key, value) {
          this.produit[key] = null;
        }.bind(this)
      );
      this.produit["service"] = "non";
      this.produit["caracteristiques"] = [];
      this.produit["images"] = [];
      this.produit["keywords"] = [];
      this.produit_fiche = null;
    },
    onImageChangeProduit(e) {
      this.produit.image = e.target.files[0];
    },
    onImageChangeProduitImage(e) {
      this.overlay = true;

      let image = e.target.files[0];

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();

      formData.append("image", image);
      if (this.produit.id) formData.append("produit", this.produit.id);

      axios
        .post("produits/upload_photo", formData, config)
        .then((response) => {
          if (response.data.image)
            this.produit.images.push(response.data.image);

          $("#kt_user_edit_avatar_produit_image .remove_photo").trigger(
            "click"
          );
          $("#kt_user_edit_avatar_produit_image input").val("");
          $("#kt_user_edit_avatar_produit_image .image-input-wrapper").css(
            "background-image",
            "url(https://via.placeholder.com/300/004c68/FFF?text=Upload)"
          );

          this.overlay = false;
        })
        .catch((error) => {
          this.overlay = false;
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    deleteImage(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer cette image !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post(this.url + "/delete_photo/" + id)
                .then((response) => {
                  this.produit.images = this.produit.images.filter(function (
                    image_item
                  ) {
                    return image_item.id != id;
                  });
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    changeLang(l) {
      this.langue = l.value;
    },
    changeEntreprise() {
      let entreprise = this.marques.filter(
        (c) => c.value == this.produit.marque_id
      )[0];
      this.rubriques_produit_filtred = this.rubriques_produit;
    },
  },
};
</script>
