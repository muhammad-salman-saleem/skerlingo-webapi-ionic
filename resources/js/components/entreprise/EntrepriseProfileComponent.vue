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
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Fiche Entreprise</h5>
          <!--end::Title-->
          <!--begin::Breadcrumb-->
          <ul
            class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm"
          >
            <li class="breadcrumb-item">
              <router-link to="/entreprises" class="text-muted">Exportateurs</router-link>
            </li>
            <li class="breadcrumb-item" v-if="entreprise">
              <a href="#" class="text-muted">{{ entreprise.label }}</a>
            </li>
            <li class="breadcrumb-item" v-if="entreprise && entreprise.validation_date">
              <a href="#" class="text-muted">
                <span class="label label-lg label-light-dark label-inline font-weight-normal">
                  Entreprise validé par
                  <b>: {{entreprise.validation_label}}</b>, le
                  <b>: {{entreprise.validation_date}}</b>
                </span>
              </a>
            </li>
          </ul>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Details-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Card-->
        <router-link to="/entreprises" v-if="entreprise.id" class="btn btn-info btn-sm mb-3">
          <i class="flaticon2-left-arrow-1 mr-2"></i> Retour
        </router-link>
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
                      <i class="flaticon2-chat-1"></i>
                    </span>
                    <span class="nav-text font-size-lg">Informations</span>
                  </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                  <a
                    class="nav-link"
                    data-toggle="tab"
                    ref="tabContacts"
                    href="#kt_user_edit_tab_3"
                  >
                    <span class="nav-icon">
                      <i class="flaticon-users-1"></i>
                    </span>
                    <span class="nav-text font-size-lg">Contacts</span>
                  </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3">
                  <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_2">
                    <span class="nav-icon">
                      <i class="flaticon-open-box"></i>
                    </span>
                    <span class="nav-text font-size-lg">Produits</span>
                  </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3 d-none">
                  <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_4">
                    <span class="nav-icon">
                      <i class="flaticon-interface-6"></i>
                    </span>
                    <span class="nav-text font-size-lg">Site web</span>
                  </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mr-3 d-none">
                  <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_5">
                    <span class="nav-icon">
                      <i class="flaticon-settings"></i>
                    </span>
                    <span class="nav-text font-size-lg">Etat du compte</span>
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
              <div class="tab-pane show active" id="kt_user_edit_tab_1" role="tabpanel">
                <!--begin::Row-->
                <form @submit.prevent="saveProfile">
                  <div class="row">
                    <div class="col-md-6">
                      <!--begin::Group-->
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Logo</label>
                        <div class="col-9 pt-0 pb-0">
                          <div
                            class="image-input image-input-empty image-input-outline"
                            id="kt_user_edit_avatar_entreprise"
                            v-bind:style="{'background-image':'url(' + entreprise.image_url + ')' }"
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
                          <br />
                          <span
                            v-if="entreprise && entreprise.statut_label"
                            class="label label-lg label-inline font-weight-normal"
                            v-bind:style="{
                          color: 'rgb(' + entreprise.statut_color + ')',
                          'background-color':
                          'rgb(' + entreprise.statut_color + ',.2)'
                        }"
                          >{{ entreprise.statut_label }}</span>
                        </div>
                      </div>
                      <!--end::Group-->
                      <div class="form-group row">
                        <label
                          class="col-form-label col-3 text-lg-right text-left"
                        >Nom de l'entreprise</label>
                        <div class="col-9 pt-0 pb-0">
                          <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="flaticon-safe-shield-protection"></i>
                              </span>
                            </div>
                            <input
                              type="text"
                              class="form-control form-control-lg form-control-solid"
                              v-model="entreprise.label"
                              placeholder="Nom de l'entreprise"
                            />
                          </div>
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
                              v-model="entreprise.tel"
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
                              v-model="entreprise.email"
                              placeholder="Email"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">Ville</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            v-model="entreprise.ville_id"
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
                        >Secteur d'activité</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            v-model="entreprise.secteur_id"
                            :items="rubriques"
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

                      <div class="form-group row d-none">
                        <label class="col-form-label col-3 text-lg-right text-left">Secteurs</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            v-model="entreprise.secteurs_id"
                            :items="rubriques"
                            clearable
                            dense
                            multiple
                            small-chips
                            filled
                          ></v-autocomplete>
                        </div>
                      </div>
                      <div class="form-group row" v-if="utilisateurs.length > 0">
                        <label class="col-form-label col-3 text-lg-right text-left">État du compte</label>
                        <div class="col-9 pt-0 pb-0">
                          <v-autocomplete
                            :items="statuts"
                            v-model="entreprise.statut_id"
                            clearable
                            dense
                            filled
                          ></v-autocomplete>
                        </div>
                      </div>
                      <div class="form-group row" v-if="entreprise.statut_id == 3">
                        <label class="col-form-label col-3 text-lg-right text-left">Motif de refus</label>
                        <div class="col-9 pt-0 pb-0">
                          <textarea
                            class="form-control form-control-lg form-control-solid"
                            v-model="entreprise.motif_refus"
                            id="exampleTextarea"
                            rows="3"
                            placeholder="Commentaire"
                          ></textarea>
                        </div>
                      </div>

                      <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                      <!--end::Group-->
                    </div>
                    <div class="col-md-5 offset-md-1">
                      <!--begin::Card-->
                      <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                          <div class="card-title">
                            <h3 class="card-label">Historique</h3>
                          </div>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body px-0">
                          <div class="container">
                            <!--begin::Timeline-->
                            <div class="timeline timeline-3">
                              <div class="timeline-items">
                                <div
                                  class="timeline-item"
                                  v-for="traking_item in trakings"
                                  v-bind:key="traking_item.id"
                                >
                                  <div
                                    class="timeline-media"
                                    v-bind:style="{
                                      'background-color': 'rgb(' + traking_item.color + ')',
                                      'border-color': 'rgb(' + traking_item.color + ')'
                                    }"
                                  >
                                    <i
                                      v-bind:class="traking_item.icon"
                                      v-bind:style="{
                                      color: '#fff'
                                    }"
                                    ></i>
                                  </div>
                                  <div class="timeline-content">
                                    <div
                                      class="d-flex align-items-center justify-content-between mb-3"
                                    >
                                      <div class="mr-2">
                                        <a
                                          href="#"
                                          class="text-dark-75 text-hover-primary font-weight-bold font-size-sm"
                                        >{{ traking_item.label }}</a>
                                        <span
                                          class="text-muted ml-2 font-size-xs"
                                        >{{ traking_item.date }}</span>
                                        <span
                                          v-if="traking_item.statut_id"
                                          class="label font-weight-bolder label-inline d-inline-block mt-1"
                                          v-bind:style="{
                                      color: 'rgb(' + traking_item.color + ')',
                                      'background-color':
                                      'rgb(' + traking_item.color + ',.2)'
                                    }"
                                        >{{ traking_item.statut_label }}</span>
                                      </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                      <div class="symbol symbol-30 mr-2">
                                        <img v-bind:src="traking_item.user_img" alt />
                                      </div>
                                      <div>
                                        <a
                                          href="#"
                                          class="text-dark font-size-xs font-weight-bolder"
                                        >{{ traking_item.user_nom }}</a>
                                      </div>
                                    </div>
                                    <p
                                      v-if="traking_item.commentaire"
                                      class="p-0 font-size-sm"
                                    >{{ traking_item.commentaire }}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!--end::Timeline-->
                          </div>
                        </div>
                        <!--end::Body-->
                      </div>
                      <!--end::Card-->
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
                            <router-link
                              to="/entreprises"
                              class="btn btn-clean font-weight-bold"
                            >Annuler</router-link>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!--end::Tab-->
              <!--begin::Tab-->
              <div class="tab-pane" id="kt_user_edit_tab_2" role="tabpanel">
                <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                  <div class="d-flex align-items-center justify-content-end">
                    <a
                      v-if="$auth.user()['role_id'] == 1 && entreprise.id"
                      @click="addProduit()"
                      data-toggle="modal"
                      href="#modal_form_produit"
                      class="btn btn-primary btn-sm"
                    >
                      <i class="ki ki-plus icon-1x"></i>Ajouter un produit
                    </a>
                  </div>
                  <v-card style="box-shadow: none;">
                    <v-data-table
                      class="table overflow-initial"
                      :headers="_headers"
                      :items="produits"
                      :search="search"
                    >
                      <template v-slot:item.entreprise_label="{ item }">
                        <div class="d-flex align-items-center">
                          <!--begin::Symbol-->
                          <div class="symbol symbol-30 symbol-light-success mr-2">
                            <img v-bind:src="item.entreprise_image" alt />
                          </div>
                          <!--end::Symbol-->
                          <!--begin::Text-->
                          <div class="d-flex flex-column flex-grow-1">
                            <a
                              href="#"
                              class="text-dark text-hover-primary font-size-xs font-weight-bold"
                            >{{item.entreprise_label}}</a>
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
                            <span
                              class="text-muted font-size-xs"
                            >{{ item.validation_date_entreprise }}</span>
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
                            <span
                              class="text-muted font-size-xs"
                            >{{ item.validation_date_skerlingo }}</span>
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
                            <ul
                              class="navi flex-column navi-hover py-2"
                              style="padding-inline-start: 0;"
                            >
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
                              <li
                                v-if="!item.validation_date_skerlingo && !item.refus_date && $auth.user()['role_id'] == 1"
                                class="navi-item"
                              >
                                <a
                                  @click="valider_produit(item.id, 'asmex')"
                                  href="#"
                                  class="navi-link"
                                >
                                  <span class="navi-icon">
                                    <i class="la la-check"></i>
                                  </span>
                                  <span class="navi-text">
                                    Valider le produit
                                    <small
                                      v-if="$auth.user()['role_id'] == 1"
                                    >(asmex)</small>
                                  </span>
                                </a>
                              </li>
                              <li
                                v-if="!item.validation_date_skerlingo && !item.refus_date && $auth.user()['role_id'] == 1"
                                class="navi-item"
                              >
                                <a
                                  @click="valider_produit(item.id, 'refus')"
                                  href="#"
                                  class="navi-link"
                                >
                                  <span class="navi-icon">
                                    <i class="flaticon-cancel"></i>
                                  </span>
                                  <span class="navi-text">Refuser le produit</span>
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
                                  <span class="navi-text">
                                    Publier le produit
                                    <small
                                      v-if="$auth.user()['role_id'] == 1"
                                    >(entreprise)</small>
                                  </span>
                                </a>
                              </li>
                              <li
                                v-if="item.refus_date && $auth.user()['role_id'] == 1"
                                class="navi-item"
                              >
                                <a
                                  @click="annuler_produit(item.id, 'refus')"
                                  href="#"
                                  class="navi-link"
                                >
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
                                <a
                                  @click="annuler_produit(item.id, 'asmex')"
                                  href="#"
                                  class="navi-link"
                                >
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
                                  <span class="navi-text">
                                    Mettre en Brouillon
                                    <small
                                      v-if="$auth.user()['role_id'] == 1"
                                    >(entreprise)</small>
                                  </span>
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
                <!--begin::Body-->
              </div>
              <!--end::Tab-->
              <!--begin::Tab-->
              <div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">
                <div class="d-flex align-items-center justify-content-end">
                  <a
                    v-if="$auth.user()['role_id'] == 1  && entreprise.id && utilisateurs.length > 0"
                    @click="addUtilisateur()"
                    data-toggle="modal"
                    href="#modal_form_utilisateur"
                    class="btn btn-primary btn-sm"
                  >
                    <i class="ki ki-plus icon-1x"></i>Ajouter un contact
                  </a>
                </div>
                <div
                  class="row justify-content-center"
                  v-if="utilisateurs.length == 0 && entreprise.id"
                >
                  <div class="col-md-8">
                    <div
                      class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap"
                    >
                      <div class="d-flex flex-column mr-5">
                        <a href="#" class="h4 text-dark text-hover-primary mb-5">Ajouter un contact</a>
                        <p
                          class="text-dark-50"
                        >Au moins un seul contact est requis pour valider l'entreprise</p>
                      </div>
                      <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                        <a
                          @click="addUtilisateur()"
                          data-toggle="modal"
                          href="#modal_form_utilisateur"
                          class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6"
                        >Ajouter un contact</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div
                    class="col-xl-4 col-lg-6 col-md-6 col-sm-6"
                    v-for="utilisateur in utilisateurs"
                    v-bind:key="utilisateur.id"
                  >
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                      <!--begin::Body-->
                      <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">
                          <div
                            class="dropdown dropdown-inline"
                            data-toggle="tooltip"
                            title
                            data-placement="left"
                            data-original-title="Quick actions"
                          >
                            <a
                              href="#"
                              class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                              <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                              <!--begin::Navigation-->
                              <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                  <span class="font-size-lg">Actions :</span>
                                  <i
                                    class="flaticon2-information icon-md text-muted"
                                    data-toggle="tooltip"
                                    data-placement="right"
                                    title
                                    data-original-title="Click to learn more..."
                                  ></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                  <a @click="editUtilisateur(utilisateur)" class="navi-link">
                                    <span class="navi-text">
                                      <i class="flaticon2-edit"></i>
                                      <span class="ml-2">Modifier</span>
                                    </span>
                                  </a>
                                </li>
                                <li class="navi-item">
                                  <a @click="sendPassword(utilisateur.id)" class="navi-link">
                                    <span class="navi-text">
                                      <i class="flaticon-security"></i>
                                      <span class="ml-2">Envoyer les codes d'accès</span>
                                    </span>
                                  </a>
                                </li>
                                <li class="navi-item">
                                  <a @click="deleteUtilisateur(utilisateur.id)" class="navi-link">
                                    <span class="navi-text">
                                      <i class="flaticon2-rubbish-bin-delete-button"></i>
                                      <span class="ml-2">Supprimer</span>
                                    </span>
                                  </a>
                                </li>
                              </ul>
                              <!--end::Navigation-->
                            </div>
                          </div>
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::User-->
                        <div class="d-flex align-items-end mb-7">
                          <!--begin::Pic-->
                          <div class="d-flex align-items-center">
                            <!--begin::Pic-->
                            <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                              <div class="symbol symbol-circle symbol-lg-75">
                                <img
                                  class="kt-widget__img kt-hidden-"
                                  v-bind:src="utilisateur.image_url"
                                  alt="image"
                                />
                              </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Title-->
                            <div class="d-flex flex-column">
                              <a
                                href="#"
                                class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"
                              >{{ utilisateur.nom }} {{ utilisateur.prenom }}</a>
                              <span
                                v-if="utilisateur.enabled"
                                class="label label-inline label-lg label-light-success font-weight-bold mt-1"
                              >Actif</span>
                              <span
                                v-if="!utilisateur.enabled"
                                class="label label-inline label-lg label-light-danger font-weight-bold mt-1"
                              >Inactif</span>
                            </div>
                            <!--end::Title-->
                          </div>
                          <!--end::Title-->
                        </div>
                        <!--end::User-->
                        <!--begin::Desc-->
                        <p class="mb-7"></p>
                        <!--end::Desc-->
                        <!--begin::Info-->
                        <div class="mb-7 mt-20">
                          <div class="d-flex justify-content-between align-items-center">
                            <span class="text-dark-75 font-weight-bolder mr-2">Email :</span>
                            <a
                              href="#"
                              class="text-muted text-hover-primary"
                            >{{ utilisateur.email }}</a>
                          </div>
                          <div class="d-flex justify-content-between align-items-cente my-1">
                            <span class="text-dark-75 font-weight-bolder mr-2">Tél. :</span>
                            <a href="#" class="text-muted text-hover-primary">{{ utilisateur.tel }}</a>
                          </div>
                        </div>
                        <!--end::Info-->
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                </div>
              </div>
              <!--end::Tab-->
              <!--begin::Tab-->
              <div class="tab-pane px-7" id="kt_user_edit_tab_4" role="tabpanel">
                <!--begin::Body-->
                <form @submit.prevent="saveProfile">
                  <div class="card-body">
                    <div class="row">
                      <label class="col-form-label col-2 text-lg-right text-left"></label>
                      <div class="col-10">
                        <h6 class="text-dark font-weight-bold mb-2">Présentation :</h6>
                      </div>
                    </div>
                    <div class="separator separator-dashed"></div>
                    <div class="row">
                      <div class="col-xl-2"></div>
                      <div class="col-xl-8">
                        <div class="form-group mb-0">
                          <div class="col-12">
                            <div class="form-group">
                              <!-- Use the component in the right place of the template -->
                              <tiptap-vuetify
                                :extensions="extensions"
                                v-model="entreprise.presentation"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div v-if="$auth.user()['role_id'] == 1">
                      <div class="row">
                        <label class="col-form-label col-2 text-lg-right text-left"></label>
                        <div class="col-10">
                          <h6 class="text-dark font-weight-bold mb-2">Paramètres :</h6>
                        </div>
                      </div>
                      <div class="separator separator-dashed"></div>
                      <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                          <div class="form-group row">
                            <div class="col-10">
                              <div class="checkbox-inline mb-2">
                                <label class="checkbox">
                                  <input type="checkbox" v-model="entreprise.allow_add_products" />
                                  <span></span> Permettre à l'exportateur d'ajouter des produits
                                </label>
                              </div>
                              <div class="checkbox-inline mb-2">
                                <label class="checkbox">
                                  <input type="checkbox" v-model="entreprise.allow_get_rfq" />
                                  <span></span> Permettre à l'exportateur de recevoir des demandes de devis
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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
              <!--begin::Tab-->
              <div class="tab-pane px-7" id="kt_user_edit_tab_5" role="tabpanel">
                <div class="row">
                  <div class="col-md-5">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                      <div class="card-header h-auto py-4">
                        <div class="card-title">
                          <h3 class="card-label">Changer le statut</h3>
                        </div>
                      </div>
                      <!--begin::Body-->
                      <div class="card-body px-0">
                        <div class="container">
                          <form
                            @submit.prevent="trakingForm"
                            class="form"
                            v-if="$auth.user()['role_id'] == 1"
                          >
                            <div class="form-group">
                              <label>Statut</label>
                              <v-autocomplete
                                :items="statuts"
                                v-model="traking.statut_id"
                                clearable
                                dense
                                filled
                              ></v-autocomplete>
                            </div>
                            <div class="form-group">
                              <textarea
                                class="form-control form-control-lg form-control-solid"
                                v-model="traking.commentaire"
                                id="exampleTextarea"
                                rows="3"
                                placeholder="Commentaire"
                              ></textarea>
                            </div>
                            <div class="row">
                              <div class="col">
                                <button
                                  type="submit"
                                  class="btn btn-light-primary font-weight-bold"
                                >Enregistrer</button>
                              </div>
                            </div>
                            <div class="separator separator-dashed my-10"></div>
                          </form>
                        </div>
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                  <div class="col-md-7">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                      <div class="card-header h-auto py-4">
                        <div class="card-title">
                          <h3 class="card-label">Historique</h3>
                        </div>
                      </div>
                      <!--begin::Body-->
                      <div class="card-body px-0">
                        <div class="container">
                          <!--begin::Timeline-->
                          <div class="timeline timeline-3">
                            <div class="timeline-items">
                              <div
                                class="timeline-item"
                                v-for="traking_item in trakings"
                                v-bind:key="traking_item.id"
                              >
                                <div
                                  class="timeline-media"
                                  v-bind:style="{
                                      'background-color': 'rgb(' + traking_item.color + ')',
                                      'border-color': 'rgb(' + traking_item.color + ')'
                                    }"
                                >
                                  <i
                                    v-bind:class="traking_item.icon"
                                    v-bind:style="{
                                      color: '#fff'
                                    }"
                                  ></i>
                                </div>
                                <div class="timeline-content">
                                  <div
                                    class="d-flex align-items-center justify-content-between mb-3"
                                  >
                                    <div class="mr-2">
                                      <a
                                        href="#"
                                        class="text-dark-75 text-hover-primary font-weight-bold font-size-sm"
                                      >{{ traking_item.label }}</a>
                                      <span
                                        class="text-muted ml-2 font-size-xs"
                                      >{{ traking_item.date }}</span>
                                      <span
                                        v-if="traking_item.statut_id"
                                        class="label font-weight-bolder label-inline d-inline-block mt-1"
                                        v-bind:style="{
                                      color: 'rgb(' + traking_item.color + ')',
                                      'background-color':
                                      'rgb(' + traking_item.color + ',.2)'
                                    }"
                                      >{{ traking_item.statut_label }}</span>
                                    </div>
                                  </div>
                                  <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-30 mr-2">
                                      <img v-bind:src="traking_item.user_img" alt />
                                    </div>
                                    <div>
                                      <a
                                        href="#"
                                        class="text-dark font-size-xs font-weight-bolder"
                                      >{{ traking_item.user_nom }}</a>
                                    </div>
                                  </div>
                                  <p
                                    v-if="traking_item.commentaire"
                                    class="p-0"
                                  >{{ traking_item.commentaire }}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--end::Timeline-->
                        </div>
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                </div>
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
                            <div class="form-group mb-2">
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
                                    :items="rubriques_produit_filtred"
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

    <div
      class="modal fade"
      id="modal_form_utilisateur"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-if="!utilisateur.id"
              class="modal-title"
              id="exampleModalLabel"
            >Ajouter un membre d'équipe</h5>
            <h5
              v-if="utilisateur.id"
              class="modal-title"
              id="exampleModalLabel"
            >Modifier un membre d'équipe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="saveUtilisateur" class="mb-3">
            <div class="modal-body">
              <div class="form-group mt-2 text-center">
                <div
                  class="image-input image-input-empty image-input-outline"
                  id="kt_user_edit_avatar_user"
                  v-bind:style="{ 'background-image': 'url(' + utilisateur.image_url + ')' }"
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
                      v-on:change="onImageChange"
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
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Nom</label>
                    <input
                      type="text"
                      autocomplete="off"
                      class="form-control"
                      placeholder="Nom"
                      v-model="utilisateur.nom"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Prénom</label>
                    <input
                      type="text"
                      autocomplete="off"
                      class="form-control"
                      placeholder="Prénom"
                      v-model="utilisateur.prenom"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">GSM</label>
                    <input
                      type="text"
                      class="form-control"
                      autocomplete="off"
                      placeholder="GSM"
                      v-model="utilisateur.tel"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Email</label>
                    <input
                      type="text"
                      class="form-control"
                      autocomplete="off"
                      placeholder="Emaill"
                      v-model="utilisateur.email"
                    />
                  </div>
                </div>
              </div>

              <div class="row" v-if="$auth.user()['role_id'] == 1">
                <div class="col-md-6 d-none">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">CNIE</label>
                    <input
                      type="text"
                      autocomplete="off"
                      class="form-control"
                      placeholder="CNIE"
                      v-model="utilisateur.cni"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Fonction</label>
                    <input
                      type="text"
                      autocomplete="off"
                      class="form-control"
                      placeholder="Fonction"
                      v-model="utilisateur.fonction"
                    />
                  </div>
                </div>
              </div>
              <div class="form-group mb-0">
                <div class="checkbox-inline mb-2">
                  <label class="checkbox checkbox-lg">
                    <input type="checkbox" v-model="utilisateur.enabled" name="enabled" />
                    <span></span>Son compte est-il actif ?
                  </label>
                </div>
              </div>

              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="clearFormUtilisateur()"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_password"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Changer le mot de passe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="savePassword" class="mb-3">
            <div class="card-body">
              <!--begin::Row-->
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-12">
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
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
            </div>
            <!--end::Body-->
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
    "vue-dropify": VueDropify,
    TiptapVuetify,
  },
  data() {
    return {
      url: "entreprises",
      entreprises: [],
      search: "",
      headers: [
        { text: "Produit", align: "middle", value: "label", width: "280px" },
        {
          text: "Entreprise",
          align: "middle",
          value: "entreprise_label",
          hide: this.$auth.user()["role_id"] != 1,
        },
        {
          text: "État du produit",
          align: "middle",
          value: "validation_date_entreprise",
        },
        {
          text: "Approbation skerlingo",
          align: "middle",
          value: "validation_date_skerlingo",
        },
        { text: "Date d'ajout", align: "middle", value: "date" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      entreprise: {
        id: null,
        label: null,
        prenom: null,
        tel: null,
        image: null,
        image_url: null,
        ville_id: null,
        secteur_id: null,
        presentation: null,
        allow_add_products: null,
        allow_get_rfq: null,
        email: null,
        statut_id: null,
        motif_refus: null,
        validation_date: null,
        validation_label: null,
        secteurs_id: [],
      },
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
        secteur_id: null,
        entreprise_id: null,
        caracteristiques: [],
        keywords: [],
        images: [],
      },
      overlay: null,
      produits: [],
      utilisateurs: [],
      rubriques: [],
      rubriques_produit: [],
      rubriques_produit_filtred: [],
      trakings: [],
      langues: [],
      langue: "fr",
      statuts: [],
      villes: [],
      password: {
        actuel: null,
        nouveau: null,
        confirmation: null,
      },
      utilisateur: {
        id: null,
        nom: null,
        prenom: null,
        tel: null,
        image: null,
        image_url: null,
        ville_id: null,
        entreprise_id: null,
        cni: null,
        fonction: null,
        enabled: null,
        code_retour: null,
        password_retour: null,
        email: null,
      },
      document: {
        label: null,
        file: null,
        entreprise_id: null,
      },
      traking: {
        id: null,
        entreprise_id: null,
        statut_id: null,
        commentaire: null,
      },
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
    this.fetch();
  },
  methods: {
    fetch() {
      this.entreprise.image_url =
        "https://via.placeholder.com/300/004c68/FFF?text=Image";
      window.scrollTo(0, 0);
      let params = {};

      if (this.$route.params.id) params["id"] = this.$route.params.id;
      else if (this.entreprise) params["id"] = this.entreprise.id;
      axios
        .get("entreprises/profile", {
          params: params,
        })
        .then(
          function (response) {
            if (response.data.entreprise)
              this.entreprise = response.data.entreprise;
            this.produits = response.data.produits;
            this.villes = response.data.villes;
            this.rubriques = response.data.rubriques;
            this.rubriques_produit = response.data.rubriques_produit;
            this.trakings = response.data.trakings;
            this.statuts = response.data.statuts;
            this.utilisateurs = response.data.utilisateurs;
            this.langues = response.data.langues;

            var avatar = new KTImageInput("kt_user_edit_avatar_entreprise");
            //CVCustom.init();
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    valider_entreprise(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de valider l'inscription de ce entreprise !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Valider",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.entreprise.id;
              axios
                .get("entreprises/valider_entreprise", {
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
          text: "Vous êtes sur le point d'activer ce compte entreprise !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Activer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.entreprise.id;
              axios
                .get("entreprises/activer_compte", {
                  params: params,
                })
                .then((response) => {
                  swal.fire(
                    "Compte activé",
                    "Le compte a été activé avec succés.",
                    "success"
                  );
                  this.entreprise = response.data.entreprise;
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
          text: "Vous êtes sur le point de bloquer ce compte entreprise !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Bloquer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.entreprise.id;
              axios
                .get("entreprises/bloquer_compte", {
                  params: params,
                })
                .then((response) => {
                  swal.fire(
                    "Compte bloqué",
                    "Le compte a été bloqué avec succés.",
                    "success"
                  );
                  this.entreprise = response.data.entreprise;
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
      $.each(this.entreprise, function (key, value) {
        formData.append(key, value ? value : "");
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.entreprise = response.data.entreprise;
          this.trakings = response.data.trakings;
          this.validationErrors = null;
          if (this.utilisateurs.length == 0) {
            const elem = this.$refs.tabContacts;
            elem.click();
            swal.fire(
              "Ajouter un contact",
              "Au moins un seul contact est requis pour valider l'entreprise",
              "warning"
            );
          } else {
            swal.fire("Le changement a été effectué !", "", "success");
          }
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

      this.document.entreprise_id = this.entreprise.id;

      let formData = new FormData();
      $.each(this.document, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post("entreprises/add_document", formData, config)
        .then((response) => {
          this.entreprise = response.data.entreprise;
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

      formData.append("id", this.entreprise.id);

      axios
        .post("entreprises/change_password", formData, config)
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
      formData.append("entreprise_id", this.entreprise.id);

      axios
        .post("produits", formData, config)
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

      this.rubriques_produit_filtred = this.rubriques_produit.filter(
        (c) => c.parent_id == this.entreprise.secteur_id
      );

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

      this.rubriques_produit_filtred = this.rubriques_produit.filter(
        (c) => c.parent_id == this.entreprise.secteur_id
      );

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
      this.validationErrors = null;
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
    },
    clearFormTraking() {
      this.edit = false;
      this.validationErrors = null;
      $.each(
        this.traking,
        function (key, value) {
          this.traking[key] = null;
        }.bind(this)
      );
    },

    trakingForm() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      this.traking.entreprise_id = this.entreprise.id;

      let formData = new FormData();
      $.each(this.traking, function (key, value) {
        formData.append(key, value ? value : "");
      });

      axios
        .post("entreprises/traking_form", formData, config)
        .then((response) => {
          this.clearFormTraking();
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    onImageChange(e) {
      this.entreprise.image = e.target.files[0];
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
                .post("produits/delete_photo/" + id)
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
    addUtilisateur() {
      this.clearFormUtilisateur();
      this.validationErrors = null;
      var avatar = new KTImageInput("kt_user_edit_avatar_user");
    },
    clearFormUtilisateur() {
      this.edit = false;
      $.each(
        this.utilisateur,
        function (key, value) {
          this.utilisateur[key] = null;
        }.bind(this)
      );
    },
    saveUtilisateur() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.utilisateur, function (key, value) {
        formData.append(key, value ? value : "");
      });
      formData.append("entreprise_id", this.entreprise.id);

      axios
        .post("utilisateurs", formData, config)
        .then((response) => {
          this.clearFormUtilisateur();
          $("#modal_form_utilisateur").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    editUtilisateur(utilisateur) {
      $("#modal_form_utilisateur").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      var avatar = new KTImageInput("kt_user_edit_avatar_user");
      $.each(
        this.utilisateur,
        function (key, value) {
          this.utilisateur[key] = utilisateur[key];
        }.bind(this)
      );
    },
    sendPassword(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point d'envoyer les codes d'accès a cet utilisateur !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Envoyer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = id;
              axios
                .post("utilisateurs/send_password", params)
                .then((response) => {
                  swal.fire(
                    "Codes d'accès envoyés !",
                    "Les codes d'accès ont été envoyés avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    onImageDocument(e) {
      this.document.file = e.target.files[0];
      console.log(this.document);
    },
    changeLang(l) {
      this.langue = l.value;
    },
  },
};
</script>
