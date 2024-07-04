<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Slides</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{types.length}} Sous catégories</span>
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
                  <h3 class="card-label">Slides</h3>
                </div>
              </div>
              <div class="card-body p-0 pt-5">
                <v-draggable-treeview v-model="dataTree">
                  <template v-slot:label="{ item }">
                    <span @click="editStatut(item)">{{ item.text }}</span>
                  </template>
                  <template v-slot:append="{ item }">
                    <a href="#" @click="editStatut(item)" class="btn btn-icon btn-light btn-sm">
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
            <form @submit.prevent="saveStatut" class="mb-3">
              <div class="card card-custom card-sticky" id="kt_page_sticky_card_">
                <div class="card-header">
                  <div class="card-title">
                    <h3 v-if="!rubrique.id" class="card-label">Gestion des slides</h3>
                    <h3 v-if="rubrique.id" class="card-label">Gestion des slides</h3>
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
                      <button type="submit" class="btn btn-primary">
                        <i class="ki ki-check icon-sm"></i>
                        Enregistrer
                      </button>
                    </div>
                    <a
                      v-if="rubrique.id"
                      href="#"
                      @click="deleteStatut(rubrique.id)"
                      class="btn btn-light-danger ml-2"
                    >
                      <i class="flaticon2-trash icon-sm"></i>
                      Supprimer
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <!--begin::Form-->
                  <form class="form" id="kt_form">
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

                              <div class="form-group">
                                <label>Catégorie</label>
                                <v-autocomplete
                                  :items="rubriques"
                                  v-model="rubrique.categorie_id"
                                  clearable
                                  dense
                                  solo
                                ></v-autocomplete>
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
                                <label class="d-block text-center">Image</label>
                                <div
                                  class="image-input image-input-empty image-input-outline"
                                  id="kt_user_edit_avatar"
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
                                <label class="d-block text-center">
                                  <small>1920px/1280px</small>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="separator separator-dashed my-5 mt-1"></div>
                        <h4 class="text-dark font-weight-bold mb-5 d-none">Paramètres :</h4>
                        <div class="form-group">
                          <div class="checkbox-list d-none">
                            <label class="checkbox">
                              <input
                                type="checkbox"
                                v-model="rubrique.show_menu"
                                name="Checkboxes1"
                              />
                              <span></span>Afficher le secteur sur le slider du page d'accueil
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
                  </form>
                  <!--end::Form-->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VJstree from "vue-jstree";

export default {
  components: {
    VJstree,
  },
  data() {
    return {
      url: "slides",
      dataTree: [],
      search: "",
      headers: [
        {
          text: "Statut",
          align: "middle",
          value: "label",
        },
        {
          text: "Couleur",
          align: "middle",
          value: "color",
        },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      types: [],
      rubriques: [],
      langues: [],
      langue: "fr",
      rubrique: {
        id: null,
        categorie_id: null,
        text: null,
        text_fr: null,
        text_en: null,
        codif: null,
        color: null,
        icon: null,
        show_menu: null,
        show_calendar: null,
        first_rubrique: null,
        image_url: null,
        children: [],
      },
      edit: false,
    };
  },
  mounted() {
    var avatar = new KTImageInput("kt_user_edit_avatar");
    //KTLayoutStickyCard.init("kt_page_sticky_card");
    console.log(KTLayoutStickyCard);
  },
  created() {
    this.fetch();
  },
  methods: {
    editStatut(item) {
      this.edit = true;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = item[key];
        }.bind(this)
      );
      $("#kt_user_edit_avatar .image-input-wrapper").css(
        "background-image",
        "url(" + this.rubrique.image_url + ")"
      );
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
        .post("slides/save_order", params)
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
            this.rubriques = response.data.rubriques;
            this.dataTree = response.data.dataTree;
            this.langues = response.data.langues;
            if (saveOrder) this.saveOrder(true);
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
                    "Rubrique supprimé !",
                    "La Rubrique a été supprimée avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveStatut() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.rubrique, function (key, value) {
        formData.append(key, value ? value : "");
      });
      formData.append("sous_rubrique", "sous_rubrique");

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.clearForm();
          swal.fire(
            "Sous catégorie enregistrée !",
            "La Sous catégorie a été enregistrée avec succés.",
            "success"
          );
          this.fetch(true);
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addStatut() {
      this.clearForm();
      this.validationErrors = null;
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = null;
        }.bind(this)
      );
      $("#kt_user_edit_avatar .remove_photo").trigger("click");
      $("#kt_user_edit_avatar input").val("");
      $("#kt_user_edit_avatar .image-input-wrapper").css(
        "background-image",
        "url(https://via.placeholder.com/300/004c68/FFF?text=Upload)"
      );
    },
    onImageChange(e) {
      this.rubrique.icon = e.target.files[0];
    },
    changeLang(l) {
      this.langue = l.value;
    },
  },
};
</script>
