<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Arborescence des rubriques</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{rubriques.length}} rubriques</span>
          </div>
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <!--end::Toolbar-->
      </div>
    </div>

    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5">
            <div class="card card-custom gutter-b">
              <div class="card-header">
                <div class="card-title">
                  <h3 class="card-label">Arborescence des rubriques</h3>
                </div>
              </div>
              <div class="card-body p-0 pt-5">
                <v-draggable-treeview v-model="dataTree">
                  <template v-slot:label="{ item }">
                    <div class="d-flex">
                      <span v-if="item.parent_id">
                        <span
                          v-bind:class="{ 'label-danger': !item.enable, 'label-success': item.enable}"
                          class="label label-sm mr-2"
                        ></span>
                      </span>
                      <span>{{ item.label }}</span>
                    </div>
                  </template>
                  <template v-slot:append="{ item }">
                    <a
                      v-if="true"
                      href="#"
                      @click="editStatut(item)"
                      class="btn btn-icon btn-light btn-sm"
                    >
                      <span class="svg-icon svg-icon-md svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                        <i class="flaticon-edit"></i>
                        <!--end::Svg Icon-->
                      </span>
                    </a>
                  </template>
                </v-draggable-treeview>
                <div class="text-center p-3">
                  <a href="#" @click="saveOrder()" class="btn btn-light-primary mr-2">
                    <i class="ki ki-check icon-sm"></i>
                    Enregistrer l'ordre actuel
                  </a>
                </div>
                <v-jstree v-if="false" :data="dataTree" @item-click="itemClick"></v-jstree>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <form class="mb-3">
              <div class="card card-custom card-sticky" id="kt_page_sticky_card_">
                <div class="card-header">
                  <div class="card-title">
                    <h3 v-if="!rubrique.id" class="card-label">Ajouter une rubrique</h3>
                    <h3 v-if="rubrique.id" class="card-label">Modifier une rubrique</h3>
                  </div>
                  <div class="card-toolbar">
                    <a
                      href="#"
                      v-if="rubrique.id"
                      @click="clearForm()"
                      class="btn btn-light-primary mr-2"
                    >
                      <i class="ki ki-long-arrow-back icon-sm"></i>
                      Retour
                    </a>
                    <div class="btn-group">
                      <button
                        type="button"
                        @click="saveStatut($event)"
                        class="btn btn-primary spinner-light-success spinner-right"
                      >
                        <i class="ki ki-check icon-sm"></i>
                        Enregistrer
                      </button>
                      <button
                        type="button"
                        :disabled="!rubrique.text"
                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      ></button>
                      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav nav-hover flex-column pl-0">
                          <li class="nav-item" v-if="rubrique.id && rubrique.children.length == 0">
                            <a href="#" @click="deleteStatut(rubrique.id)" class="nav-link">
                              <i class="nav-icon flaticon-delete"></i>
                              <span class="nav-text">Supprimer</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <!--begin::Form-->
                  <form class="form" id="kt_form">
                    <ul class="nav nav-tabs nav-tabs-line mb-5 pl-0">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                          <span class="nav-icon">
                            <i class="flaticon2-chat-1"></i>
                          </span>
                          <span class="nav-text">Informations</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                          <span class="nav-icon">
                            <i class="flaticon2-pie-chart-4"></i>
                          </span>
                          <span class="nav-text">Questions</span>
                        </a>
                      </li>
                    </ul>

                    <div class="tab-content mt-5" id="myTabContent">
                      <div
                        class="tab-pane fade show active"
                        id="kt_tab_pane_1"
                        role="tabpanel"
                        aria-labelledby="kt_tab_pane_1"
                      >
                        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
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
                        <div class="row justify-content-center">
                          <div class="col-xl-12">
                            <div class>
                              <h4 class="text-dark font-weight-bold mb-4 mt-4">Informations :</h4>
                              <div class="row">
                                <div class="col-md-8">
                                  <div class="form-group">
                                    <label>Catégorie</label>
                                    <v-autocomplete
                                      :items="rubriques"
                                      v-model="rubrique.parent_id"
                                      clearable
                                      dense
                                      solo
                                    ></v-autocomplete>
                                  </div>
                                  <div class="row">
                                    <div
                                      class="col-md-12 pt-0"
                                      v-for="l in langues"
                                      v-bind:key="l.value"
                                      v-bind:class="{ 'd-none': langue != l.value  }"
                                    >
                                      <div class="form-group">
                                        <label for="recipient-name" class="form-control-label">
                                          Titre
                                          <small>
                                            <b>[{{l.value}}]</b>
                                          </small>
                                        </label>
                                        <input
                                          type="text"
                                          class="form-control"
                                          :placeholder="'Titre '+l.value "
                                          v-model="rubrique['text_'+l.value]"
                                        />
                                      </div>
                                    </div>
                                    <div class="col-md-6 pb-0 d-none">
                                      <div class="form-group">
                                        <label
                                          for="recipient-name"
                                          class="form-control-label"
                                        >Codif Menu</label>
                                        <input
                                          type="text"
                                          class="form-control"
                                          placeholder="Titre"
                                          v-model="rubrique.codif"
                                        />
                                      </div>
                                    </div>
                                  </div>

                                  <div
                                    class
                                    v-for="l in langues"
                                    v-bind:key="l.value"
                                    v-bind:class="{ 'd-none': langue != l.value  }"
                                  >
                                    <div class="form-group">
                                      <label for="recipient-name" class="form-control-label">
                                        Brève description
                                        <small>
                                          <b>[{{l.value}}]</b>
                                        </small> :
                                      </label>
                                      <textarea
                                        class="form-control"
                                        :placeholder="'Titre '+l.value "
                                        v-model="rubrique['presentation_'+l.value]"
                                        rows="2"
                                      ></textarea>
                                    </div>
                                  </div>

                                  <div class="row d-none">
                                    <div class="col-md-6 pt-0">
                                      <div class="form-group mb-0">
                                        <label>Delivery time</label>
                                        <v-autocomplete
                                          :items="times"
                                          v-model="rubrique.time_to_deliver"
                                          clearable
                                          dense
                                          solo
                                        ></v-autocomplete>
                                      </div>
                                    </div>
                                    <div class="col-md-6 pt-0">
                                      <div class="form-group mb-0">
                                        <label
                                          for="recipient-name"
                                          class="form-control-label"
                                        >Price :</label>
                                        <input
                                          type="number"
                                          class="form-control"
                                          placeholder="Price"
                                          v-model="rubrique.montant"
                                        />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row d-none">
                                    <div class="col-md-12 pt-0">
                                      <div class="form-group">
                                        <label
                                          for="recipient-name"
                                          class="form-control-label"
                                        >Code couleur</label>
                                        <input
                                          type="text"
                                          class="form-control"
                                          placeholder="Code couleur"
                                          v-model="rubrique.color"
                                        />
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group mt-2 text-center">
                                    <label class="d-block text-center">Photo</label>
                                    <div
                                      class="image-input image-input-empty image-input-outline"
                                      id="kt_user_edit_avatar_icon"
                                      v-bind:style="{ 'background-image': 'url(' + rubrique.icon_url + ')' }"
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
                                  </div>
                                  <div class="form-group mt-2 text-center d-none">
                                    <label class="d-block text-center">Modèle document</label>
                                    <div
                                      class="image-input image-input-empty image-input-outline"
                                      id="kt_user_edit_avatar_image"
                                      v-bind:style="{ 'background-image': 'url(' + rubrique.image_url + ')' }"
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
                                          v-on:change="onImageChangeModele"
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
                                  v-model="rubrique['description_'+l.value]"
                                />
                              </div>
                            </div>
                            <div class="separator separator-dashed my-5 mt-1"></div>
                            <h4 class="text-dark font-weight-bold mb-5">Paramètres :</h4>
                            <div class="form-group">
                              <div class="checkbox-list">
                                <label class="checkbox">
                                  <input
                                    type="checkbox"
                                    v-model="rubrique.enable"
                                    name="Checkboxes1"
                                  />
                                  <span></span>Activer la rubrique
                                </label>
                                <label class="checkbox d-none">
                                  <input
                                    type="checkbox"
                                    v-model="rubrique.show_menu"
                                    name="Checkboxes1"
                                  />
                                  <span></span>Afficher le service sur le slider du page d'accueil
                                </label>
                                <label class="checkbox d-none">
                                  <input
                                    type="checkbox"
                                    v-model="rubrique.first_rubrique"
                                    name="Checkboxes1"
                                  />
                                  <span></span>Affecter cette rubrique automatiquement lors de l'injection des fiches
                                </label>
                                <label class="checkbox d-none">
                                  <input
                                    type="checkbox"
                                    v-model="rubrique.show_calendar"
                                    name="Checkboxes1"
                                  />
                                  <span></span>Demander un créneau si je choisi(e) cette rubrique (Rappel, RDV...)
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-2"></div>
                        </div>
                      </div>
                      <div
                        class="tab-pane fade"
                        id="kt_tab_pane_2"
                        role="tabpanel"
                        aria-labelledby="kt_tab_pane_2"
                      >
                        <div class="d-flex align-items-center justify-content-end">
                          <a
                            @click="addQuestion()"
                            data-toggle="modal"
                            href="#modal_form_question"
                            class="btn btn-primary btn-sm"
                          >
                            <i class="ki ki-plus icon-1x"></i>Ajouter une question
                          </a>
                        </div>
                        <v-card style="box-shadow: none;">
                          <v-data-table
                            class="table"
                            :headers="headers"
                            :items="rubrique.questions"
                            item-key="id"
                            :show-select="false"
                            :disable-pagination="true"
                            :hide-default-footer="true"
                          >
                            <template v-slot:body="props">
                              <draggable :list="rubrique.questions" tag="tbody">
                                <tr v-for="(item, index) in rubrique.questions" :key="index">
                                  <td>
                                    <v-icon small class="page__grab-icon">mdi-arrow-all</v-icon>
                                  </td>
                                  <td>
                                    <span class="font-weight-bold font-size-sm">{{ item.label }}</span>
                                  </td>
                                  <td>
                                    <span
                                      class="label label-lg label-dark-light label-inline"
                                    >{{ item.type_label }}</span>
                                  </td>
                                  <td>
                                    <span
                                      v-if="item.required"
                                      class="label label-lg label-light-danger label-inline"
                                    >Oui</span>
                                    <span
                                      v-if="!item.required"
                                      class="label label-lg label-light-success label-inline"
                                    >Non</span>
                                  </td>
                                  <td>
                                    <a
                                      @click="editQuestion(item)"
                                      href="javascript:void(0)"
                                      class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3"
                                    >
                                      <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          width="24px"
                                          height="24px"
                                          viewBox="0 0 24 24"
                                          version="1.1"
                                        >
                                          <g
                                            stroke="none"
                                            stroke-width="1"
                                            fill="none"
                                            fill-rule="evenodd"
                                          >
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                              d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                              fill="#000000"
                                              fill-rule="nonzero"
                                              transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"
                                            />
                                            <path
                                              d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                              fill="#000000"
                                              fill-rule="nonzero"
                                              opacity="0.3"
                                            />
                                          </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                      </span>
                                    </a>
                                    <a
                                      href="#"
                                      @click="deleteQuestion(item.id)"
                                      class="btn btn-icon btn-light btn-hover-primary btn-sm"
                                    >
                                      <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                          width="24px"
                                          height="24px"
                                          viewBox="0 0 24 24"
                                          version="1.1"
                                        >
                                          <g
                                            stroke="none"
                                            stroke-width="1"
                                            fill="none"
                                            fill-rule="evenodd"
                                          >
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                              d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                              fill="#000000"
                                              fill-rule="nonzero"
                                            />
                                            <path
                                              d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                              fill="#000000"
                                              opacity="0.3"
                                            />
                                          </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                      </span>
                                    </a>
                                  </td>
                                </tr>
                              </draggable>
                            </template>
                          </v-data-table>
                        </v-card>
                      </div>
                    </div>
                  </form>
                  <!--end::Form-->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_question"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!question.id" class="modal-title" id="exampleModalLabel">Ajouter une question</h5>
            <h5 v-if="question.id" class="modal-title" id="exampleModalLabel">Modifier une question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Titre :</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Titre"
                  v-model="question.label"
                />
              </div>

              <div class="row">
                <div class="col-md-6 pt-0">
                  <div class="form-group">
                    <label>Type de question</label>
                    <v-autocomplete :items="types" v-model="question.type" clearable dense solo></v-autocomplete>
                  </div>
                </div>
                <div class="col-md-6 pt-0" v-if="question.type == 'liste'">
                  <div class="form-group">
                    <label>Type des réponses</label>
                    <v-autocomplete :items="listes" v-model="question.liste" clearable dense solo></v-autocomplete>
                  </div>
                </div>
              </div>

              <div class="form-group" v-if="question.liste == 'keywords'">
                <label for="recipient-name" class="form-control-label">Réponses personalisées :</label>
                <v-combobox
                  v-model="question.reponses"
                  small-chips
                  clearable
                  label="Réponses personalisées"
                  multiple
                  solo
                >
                  <template v-slot:selection="{ attrs, item, select, selected }">
                    <v-chip
                      small
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
                <div class="checkbox-list">
                  <label class="checkbox">
                    <input type="checkbox" v-model="question.required" name="Checkboxes1" />
                    <span></span> Question obligatoire
                  </label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="clearFormQuestion()"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Fermer</button>
              <button
                @click="saveQuestion($event)"
                type="submit"
                class="btn btn-primary spinner-light-success spinner-right"
              >Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_service_optionnel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-if="!service_optionnel.id"
              class="modal-title"
              id="exampleModalLabel"
            >Affecter une rubrique optionnel</h5>
            <h5
              v-if="service_optionnel.id"
              class="modal-title"
              id="exampleModalLabel"
            >Modifier le service optionnel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>

              <div class="row">
                <div class="col-md-12 pt-0">
                  <div class="form-group">
                    <label>Service optionnel</label>
                    <v-autocomplete
                      :items="services_optionnel"
                      v-model="service_optionnel.service_id"
                      @change="changeServiceOptionnel()"
                      clearable
                      dense
                      solo
                    ></v-autocomplete>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="checkbox-list">
                  <label class="checkbox">
                    <input
                      type="checkbox"
                      v-model="service_optionnel.impact_prix"
                      name="Checkboxes1"
                    />
                    <span></span> Impact sur le prix
                  </label>
                </div>
              </div>

              <div class="row" v-if="service_optionnel.impact_prix">
                <div class="col-md-6 pt-0">
                  <div class="form-group">
                    <label>Type</label>
                    <v-autocomplete
                      :items="impacts_prix"
                      v-model="service_optionnel.impact_montant_type"
                      clearable
                      dense
                      solo
                    ></v-autocomplete>
                  </div>
                </div>
                <div class="col-md-6 pt-0">
                  <label for="recipient-name" class="form-control-label">Valeur :</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Valeur"
                    v-model="service_optionnel.impact_montant_valeur"
                  />
                </div>
              </div>

              <div class="form-group">
                <div class="checkbox-list">
                  <label class="checkbox">
                    <input
                      type="checkbox"
                      v-model="service_optionnel.impact_delai"
                      name="Checkboxes1"
                    />
                    <span></span> Impact sur le délai
                  </label>
                </div>
              </div>

              <div class="row" v-if="service_optionnel.impact_delai">
                <div class="col-md-6 pt-0">
                  <div class="form-group">
                    <label>Type</label>
                    <v-autocomplete
                      :items="impacts_delai"
                      v-model="service_optionnel.impact_delai_type"
                      clearable
                      dense
                      solo
                    ></v-autocomplete>
                  </div>
                </div>
                <div class="col-md-6 pt-0">
                  <label for="recipient-name" class="form-control-label">Valeur :</label>
                  <v-autocomplete
                    :items="times"
                    v-model="service_optionnel.impact_delai_valeur"
                    clearable
                    dense
                    solo
                  ></v-autocomplete>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="clearFormServiceOptionnel()"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Fermer</button>
              <button
                @click="saveServiceOptionnel($event)"
                type="submit"
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
import VJstree from "vue-jstree";
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
import draggable from "vuedraggable";

export default {
  components: {
    VJstree,
    TiptapVuetify,
    draggable,
  },
  data() {
    return {
      url: "rubriques",
      dataTree: [],
      times: [],
      impacts_prix: [],
      impacts_delai: [],
      search: "",
      headers: [
        { text: "", sortable: false },
        {
          text: "Question",
          align: "middle",
          value: "label",
        },
        {
          text: "Type",
          align: "middle",
          value: "type_label",
        },
        {
          text: "Obligatoire",
          align: "middle",
          value: "required",
        },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      headers_services_optionnel: [
        { text: "", sortable: false },
        {
          text: "Service",
          align: "middle",
          value: "label",
        },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      types: [],
      listes: [],
      rubriques: [],
      langues: [],
      langue: "fr",
      services_optionnel: [],
      rubrique: {
        id: null,
        parent_id: null,
        text: null,
        text_fr: null,
        text_it: null,
        text_ar: null,
        codif: null,
        color: null,
        icon: null,
        image: null,
        montant: null,
        presentation: null,
        presentation_fr: null,
        presentation_it: null,
        presentation_ar: null,
        description: null,
        description_fr: null,
        description_it: null,
        description_ar: null,
        time_to_deliver: null,
        enable: null,
        show_menu: null,
        show_calendar: null,
        first_rubrique: null,
        icon_url: null,
        image_url: null,
        children: [],
        questions: [],
        services_optionnel: [],
      },
      question: {
        id: null,
        rubrique_id: null,
        label: null,
        type: null,
        liste: null,
        description: null,
        required: null,
        reponses: [],
      },
      service_optionnel: {
        id: null,
        rubrique_id: null,
        service_id: null,
        impact_prix: null,
        impact_montant_type: null,
        impact_montant_valeur: null,
        impact_delai: null,
        impact_delai_type: null,
        impact_delai_valeur: null,
      },
      extensions: [
        History,
        Link,
        Underline,
        Strike,
        Italic,
        ListItem,
        BulletList,
        Bold,
      ],
      edit: false,
    };
  },
  mounted() {
    var avatar = new KTImageInput("kt_user_edit_avatar_icon");
    var avatar = new KTImageInput("kt_user_edit_avatar_image");
    //KTLayoutStickyCard.init("kt_page_sticky_card");
  },
  created() {
    this.fetch();
  },
  methods: {
    editStatut(item) {
      $("#kt_user_edit_avatar_icon .image-input-wrapper").css(
        "background-image",
        "none"
      );
      this.edit = true;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = item[key];
        }.bind(this)
      );
      this.get_questions();
    },
    itemClick(node) {
      this.edit = true;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = node.model[key];
        }.bind(this)
      );
    },
    saveOrder(without_popup = false) {
      this.overlay = true;
      let params = {};
      params["dataTree"] = this.dataTree;
      axios
        .post("rubriques/save_order", params)
        .then(
          function (response) {
            this.fetch();
            if (!without_popup)
              swal.fire(
                response.data.title,
                response.data.message,
                response.data.icon
              );
          }.bind(this)
        )
        .catch((error) => {
          // code here when an upload is not valid
          this.overlay = false;
          console.log("check error: ", this.error);
        });
    },
    fetch(saveOrder = false) {
      let params = {};
      if (this.$route.query.t) {
        params["t"] = this.$route.query.t;
      }
      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            this.types = response.data.types;
            this.listes = response.data.listes;
            this.rubriques = response.data.rubriques;
            this.dataTree = response.data.dataTree;
            this.times = response.data.times;
            this.impacts_prix = response.data.impacts_prix;
            this.impacts_delai = response.data.impacts_delai;
            this.langues = response.data.langues;
            if (saveOrder) this.saveOrder(true);
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    get_questions() {
      let params = {};
      params["rubrique_id"] = this.rubrique.id;
      axios
        .get("questions", {
          params: params,
        })
        .then(
          function (response) {
            this.rubrique.questions = response.data.questions;
            this.rubrique.services_optionnel = response.data.services_optionnel;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    deleteStatut(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer cette rubrique !",
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
                    "Service supprimé !",
                    "Le service a été supprimé avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    deleteQuestion(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer cette question !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post("questions/" + id, { _method: "DELETE" })
                .then((response) => {
                  swal.fire(
                    "Question supprimée !",
                    "La question a été supprimée avec succés.",
                    "success"
                  );
                  let item = this.rubrique.questions.find(
                    (item) => item.id === id
                  );
                  let index = this.rubrique.questions.indexOf(item);
                  this.rubrique.questions.splice(index, 1);
                  this.rubrique.questions = [...this.rubrique.questions];
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    deleteServiceOptionnel(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de désaffecter ce service !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post("rubriques/delete_service_optionnel/" + id, {
                  _method: "DELETE",
                })
                .then((response) => {
                  swal.fire(
                    "Service optionnel désaffecté !",
                    "Le service a été désaffecté avec succés.",
                    "success"
                  );
                  let item = this.rubrique.services_optionnel.find(
                    (item) => item.id === id
                  );
                  let index = this.rubrique.services_optionnel.indexOf(item);
                  this.rubrique.services_optionnel.splice(index, 1);
                  this.rubrique.services_optionnel = [
                    ...this.rubrique.services_optionnel,
                  ];
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveStatut(e) {
      e.target.disabled = true;
      e.target.classList.toggle("spinner");

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.rubrique, function (key, value) {
        formData.append(key, value ? value : "");
      });
      formData.append("questions", JSON.stringify(this.rubrique.questions));
      formData.append(
        "services_optionnel",
        JSON.stringify(this.rubrique.services_optionnel)
      );

      axios
        .post(this.url, formData, config)
        .then((response) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          this.clearForm();
          swal.fire(
            "Rubrique enregistrée !",
            "La rubrique a été enregistrée avec succés.",
            "success"
          );
          this.langue = "fr";
          this.fetch(true);
        })
        .catch((error) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addStatut() {
      this.clearForm();
      this.validationErrors = null;
    },
    addQuestion() {
      this.clearFormQuestion();
      this.validationErrors = null;
    },
    editQuestion(question) {
      console.log(this.rubrique.questions);
      $("#modal_form_question").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.question,
        function (key, value) {
          this.question[key] = question[key];
        }.bind(this)
      );
    },
    saveQuestion(e) {
      e.target.disabled = true;
      e.target.classList.toggle("spinner");
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.question, function (key, value) {
        formData.append(key, value ? value : "");
      });
      if (this.rubrique) formData.append("rubrique_id", this.rubrique.id);
      formData.append("reponses", JSON.stringify(this.question.reponses));

      axios
        .post("questions", formData, config)
        .then((response) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (response.data.question) {
            let questionsSearch = this.rubrique.questions.filter(
              (c) => c.id == response.data.question.id
            )[0];
            if (questionsSearch) {
              let item = this.rubrique.questions.find(
                (item) => item.id === response.data.question.id
              );
              let index = this.rubrique.questions.indexOf(item);
              this.rubrique.questions.splice(index, 1, response.data.question);
              this.rubrique.questions = [...this.rubrique.questions];
            } else {
              this.rubrique.questions.push(response.data.question);
            }
          }
          this.clearFormQuestion();
          $("#modal_form_question").modal("toggle");
        })
        .catch((error) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addServiceOptionnel() {
      this.clearFormServiceOptionnel();
      this.validationErrors = null;
    },
    editServiceOptionnel(service_optionnel) {
      $("#modal_form_service_optionnel").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.service_optionnel,
        function (key, value) {
          this.service_optionnel[key] = service_optionnel[key];
        }.bind(this)
      );
    },
    changeServiceOptionnel() {
      let serviceOptionnel = this.services_optionnel.filter(
        (c) => c.id == this.service_optionnel.service_id
      )[0];
      this.service_optionnel.impact_montant_valeur = serviceOptionnel.prix;
      this.service_optionnel.impact_delai_valeur = serviceOptionnel.delai;
    },
    saveServiceOptionnel(e) {
      e.target.disabled = true;
      e.target.classList.toggle("spinner");
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.service_optionnel, function (key, value) {
        formData.append(key, value ? value : "");
      });
      if (this.rubrique) formData.append("rubrique_id", this.rubrique.id);

      axios
        .post("rubriques/service_optionnel", formData, config)
        .then((response) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (response.data.service_optionnel) {
            let service_optionnelsSearch =
              this.rubrique.services_optionnel.filter(
                (c) => c.id == response.data.service_optionnel.id
              )[0];
            if (service_optionnelsSearch) {
              let item = this.rubrique.services_optionnel.find(
                (item) => item.id === response.data.service_optionnel.id
              );
              let index = this.rubrique.services_optionnel.indexOf(item);
              this.rubrique.services_optionnel.splice(
                index,
                1,
                response.data.service_optionnel
              );
              this.rubrique.services_optionnel = [
                ...this.rubrique.services_optionnel,
              ];
            } else {
              this.rubrique.services_optionnel.push(
                response.data.service_optionnel
              );
            }
          }
          this.clearFormServiceOptionnel();
          $("#modal_form_service_optionnel").modal("toggle");
        })
        .catch((error) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    clearFormServiceOptionnel() {
      this.edit = false;
      $.each(
        this.service_optionnel,
        function (key, value) {
          this.service_optionnel[key] = null;
        }.bind(this)
      );
    },
    removeKeywords(item) {
      this.question.reponses.splice(this.question.reponses.indexOf(item), 1);
      this.question.reponses = [...this.question.reponses];
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = null;
        }.bind(this)
      );
      this.rubrique["questions"] = [];
      this.rubrique["services_optionnel"] = [];
      $("#kt_user_edit_avatar_icon .remove_photo").trigger("click");
      $("#kt_user_edit_avatar_icon input").val("");
      $("#kt_user_edit_avatar_icon .image-input-wrapper").css(
        "background-image",
        "url(https://via.placeholder.com/300/004c68/FFF?text=Upload)"
      );
    },
    clearFormQuestion() {
      this.edit = false;
      $.each(
        this.question,
        function (key, value) {
          this.question[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.rubrique.image_url = "";
      this.rubrique.icon_url = "";
      this.rubrique.icon = e.target.files[0];
    },
    onImageChangeModele(e) {
      this.rubrique.image = e.target.files[0];
    },
    changeLang(l) {
      this.langue = l.value;
    },
  },
};
</script>
