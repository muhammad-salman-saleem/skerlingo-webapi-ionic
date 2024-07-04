<template>
  <div v-if="$auth.user()['role_id'] == 1">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ page_title }}</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{ importateurs.length }} Importateurs</span>
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
      </div>
    </div>

    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="card card-custom gutter-b" v-bind:class="{ 'overlay overlay-block': overlay }">
          <div class="card-header flex-wrap pt-4 pb-4">
            <div class="card-title">
              <h3 class="card-label d-flex">
                <span class="mr-3">
                  {{page_title}}
                  <br />
                  <span
                    v-if="selected_items.length > 0"
                    class="text-muted font-size-sm font-weight-normal"
                  >{{ selected_items.length }} selectionnées</span>
                </span>
                <div class="dropdown dropdown-inline" v-if="selected_items.length > 0">
                  <button
                    :disabled="selected_items.length == 0"
                    type="button"
                    class="btn btn-light-primary btn-sm dropdown-toggle"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >Actions</button>
                  <!--begin::Dropdown Menu-->
                  <div
                    class="dropdown-menu dropdown-menu-sm dropdown-menu-left font-weight-normal"
                    style="width: 300px;"
                  >
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2 pl-0">
                      <li class="navi-item">
                        <a href="#" @click="supprimer()" class="navi-link">
                          <span class="navi-icon">
                            <i class="flaticon-delete"></i>
                          </span>
                          <span class="navi-text">Supprimer la sélection</span>
                        </a>
                      </li>
                    </ul>
                    <!--end::Navigation-->
                  </div>
                  <!--end::Dropdown Menu-->
                </div>
              </h3>
            </div>
          </div>

          <div class="overlay-wrapper">
            <div class="card-body p-5 pt-0">
              <v-card style="box-shadow: none;">
                <v-data-table
                  class="table"
                  :headers="headers"
                  :items="importateurs"
                  :search="search"
                >
                  <template v-slot:item.nomComplet="{ item }">
                    <span class="font-weight-bold">{{ item.nomComplet }}</span>
                  </template>

                  <template v-slot:item.pays_label="{ item }">
                    <div class="d-flex align-items-center">
                      <!--begin::Symbol-->
                      <div class="symbol symbol-40 symbol-light-success mr-2">
                        <img v-if="item.pays_flag" v-bind:src="item.pays_flag" alt />
                      </div>
                      <!--end::Symbol-->
                      <!--begin::Text-->
                      <div class="d-flex flex-column flex-grow-1">
                        <span
                          class="text-dark text-hover-primary font-size-sm font-weight-bold"
                        >{{item.pays_label}}</span>
                      </div>
                      <!--end::Text-->
                    </div>
                  </template>
                  <template v-slot:item.ville_label="{ item }">
                    <span class="label label-outline-info label-inline">{{ item.ville_label }}</span>
                  </template>
                  <template v-slot:item.enabled="{ item }">
                    <span
                      class="label label-lg label-primary label-inline font-weight-normal"
                      v-if="item.enabled"
                    >Compte actif</span>
                    <span
                      class="label label-lg label-danger label-inline font-weight-normal"
                      v-if="!item.enabled"
                    >Compte bloqué</span>
                  </template>
                  <template v-slot:item.date="{ item }">
                    <span class="font-roboto">{{ item.date }}</span>
                  </template>

                  <template v-slot:item.actions="{ item }">
                    <router-link
                      :to="{ name: 'importateur_profile', params: { id: item.id } }"
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
            </div>
          </div>

          <div class="overlay-layer bg-dark-o-10" v-if="overlay">
            <div class="spinner spinner-primary"></div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_importateur"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-if="!importateur.id"
              class="modal-title"
              id="exampleModalLabel"
            >Ajouter un importateur</h5>
            <h5
              v-if="importateur.id"
              class="modal-title"
              id="exampleModalLabel"
            >Modifier un importateur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="saveLivreur" class="mb-3">
            <div class="modal-body">
              <div class="form-group mt-2 text-center">
                <div
                  class="image-input image-input-empty image-input-outline"
                  id="kt_user_edit_avatar"
                  v-bind:style="{ 'background-image': 'url(' + importateur.image_url + ')' }"
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
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Nom :</label>
                    <input
                      type="text"
                      autocomplete="off"
                      class="form-control"
                      placeholder="Nom"
                      v-model="importateur.nom"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Prénom :</label>
                    <input
                      type="text"
                      autocomplete="off"
                      class="form-control"
                      placeholder="Prénom"
                      v-model="importateur.prenom"
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
                      v-model="importateur.tel"
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
                      v-model="importateur.email"
                    />
                  </div>
                </div>
              </div>

              <div class="form-group mb-2 mt-2">
                <label for="recipient-name" class="form-control-label">Ville de résidence :</label>
                <v-autocomplete
                  v-model="importateur.ville_id"
                  :items="villes"
                  clearable
                  dense
                  filled
                ></v-autocomplete>
              </div>

              <div class="form-group d-none">
                <label for="recipient-name" class="form-control-label">Zones de couverture :</label>
                <v-autocomplete
                  v-model="importateur.villes_id"
                  :items="villes"
                  clearable
                  dense
                  multiple
                  small-chips
                  filled
                ></v-autocomplete>
              </div>

              <div class="form-group mb-0">
                <div class="checkbox-inline mb-2">
                  <label class="checkbox checkbox-lg">
                    <input type="checkbox" v-model="importateur.enabled" name="enabled" />
                    <span></span>Son compte est-il actif ?
                  </label>
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
      url: "importateurs",
      search: "",
      page_title: "Importateurs",
      headers: [
        {
          text: "Nom & prénom",
          align: "middle",
          value: "nomComplet",
        },
        {
          text: "Pays",
          align: "middle",
          value: "pays_label",
        },
        {
          text: "Email",
          align: "middle",
          value: "email",
        },
        {
          text: "Téléphone",
          align: "middle",
          value: "tel",
        },
        {
          text: "Etat du compte",
          align: "middle",
          value: "enabled",
        },
        {
          text: "Date d'inscription",
          align: "middle",
          value: "date",
        },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      filter: {
        type: null,
        ville: null,
      },
      overlay: null,
      validationErrors: null,
      importateurs: [],
      selected_items: [],
      villes: [],
      types: [],
      importateur: {
        id: null,
        nom: null,
        prenom: null,
        tel: null,
        image: null,
        image_url: null,
        ville_id: null,
        enabled: null,
        email: null,
        villes_id: [],
      },
      edit: false,
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch() {
      if (this.$route.query.en_attente) {
        this.filter.en_attente = true;
        this.page_title = "Importateurs en attente";
      }

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
            this.villes = response.data.villes;
            this.types = response.data.types;
            this.importateurs = response.data.importateurs;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    deleteLivreur(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .delete(this.url + "/" + id)
                .then((response) => {
                  swal.fire(
                    "Deleted!",
                    "Your file has been deleted.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveLivreur() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.importateur, function (key, value) {
        formData.append(key, value ? value : "");
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.clearForm();
          $("#modal_form_importateur").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addLivreur() {
      this.clearForm();
      this.validationErrors = null;
      var avatar = new KTImageInput("kt_user_edit_avatar");
    },
    editLivreur(importateur) {
      $("#modal_form_importateur").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      var avatar = new KTImageInput("kt_user_edit_avatar");
      $.each(
        this.importateur,
        function (key, value) {
          this.importateur[key] = importateur[key];
        }.bind(this)
      );
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.importateur,
        function (key, value) {
          this.importateur[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.importateur.image = e[0];
    },
    supprimer() {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer la sélection !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              this.overlay = true;
              let params = {};
              params["id"] = this.id;
              params["ids"] = this.selected_items.map((x) => x.id);
              axios
                .post("importateurs/delete_importateurs", params)
                .then(
                  function (response) {
                    this.fiches = response.data.fiches;
                    this.overlay = false;
                    this.selected_items = [];
                    this.fetch();
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
            }
          }.bind(this)
        );
    },
  },
};
</script>
