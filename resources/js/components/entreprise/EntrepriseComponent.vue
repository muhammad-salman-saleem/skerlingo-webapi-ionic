<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Entreprises</h5>
          <!--end::Page Title-->
          <!--begin::Actions-->
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{entreprises.length}} Entreprises</span>
          </div>
          <!--end::Actions-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
          <router-link :to="{ name: 'entreprise_profile' }" class="btn btn-primary btn-sm">
            <i class="ki ki-plus icon-1x"></i>Ajouter une entreprise
          </router-link>
        </div>
        <!--end::Toolbar-->
      </div>
    </div>
    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="card card-custom gutter-b mb-2" v-if="$auth.user()['role_id'] == 1">
          <div class="card-body p-2 pr-8 pl-8">
            <div class="row justify-content-center">
              <div class="col-xl-3">
                <div class="form-group mb-0">
                  <label>Statut</label>
                  <v-autocomplete :items="statuts" v-model="filter.statut" clearable dense filled></v-autocomplete>
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group mb-0">
                  <label>Ville</label>
                  <v-autocomplete :items="villes" v-model="filter.ville" clearable dense filled></v-autocomplete>
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group mb-0">
                  <label>Secteur d'activité</label>
                  <v-autocomplete
                    :items="rubriques"
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
              <div class="col-xl-2 mt-7">
                <button @click="fetch()" class="btn btn-primary btn-block">
                  <span class="navi-icon">
                    <i class="flaticon-search"></i>
                  </span>
                  <span class="navi-text">Filtrer</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div
            class="col-xl-3 col-lg-6 col-md-6 col-sm-6"
            v-for="entreprise in entreprises"
            v-bind:key="entreprise.id"
          >
            <!--begin::Card-->
            <div class="card card-custom">
              <!--begin::Body-->
              <div class="card-body p-5 pt-4">
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
                          <router-link
                            :to="{ name: 'entreprise_profile', params: { id: entreprise.id } }"
                            class="navi-link"
                          >
                            <span class="navi-text">
                              <i class="flaticon2-user"></i>
                              <span class="ml-2">Profile</span>
                            </span>
                          </router-link>
                        </li>
                        <li class="navi-item">
                          <a @click="editEntreprise(entreprise)" class="navi-link">
                            <span class="navi-text">
                              <i class="flaticon2-edit"></i>
                              <span class="ml-2">Modifier</span>
                            </span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a @click="deleteEntreprise(entreprise.id)" class="navi-link d-none">
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
                          v-bind:src="entreprise.image_url"
                          alt="image"
                        />
                      </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Title-->
                    <div class="d-flex flex-column">
                      <router-link
                        :to="{ name: 'entreprise_profile', params: { id: entreprise.id } }"
                        style="line-height: 1.2;"
                        class="text-dark font-weight-bolder text-hover-primary font-size-h6 mb-1"
                      >{{ entreprise.label }}</router-link>
                      <span class>{{ entreprise.secteur_label }}</span>
                    </div>
                    <!--end::Title-->
                  </div>
                  <!--end::Title-->
                </div>
                <!--end::User-->
                <!--end::Desc-->
                <!--begin::Info-->
                <div class="mb-3 mt-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-dark-75 font-weight-bolder mr-2">Email :</span>
                    <a
                      href="#"
                      class="text-muted text-hover-primary"
                      style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 75%;"
                    >{{ entreprise.email }}</a>
                  </div>
                  <div class="d-flex justify-content-between align-items-cente my-1">
                    <span class="text-dark-75 font-weight-bolder mr-2">Tél. :</span>
                    <a href="#" class="text-muted text-hover-primary">{{ entreprise.tel }}</a>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-dark-75 font-weight-bolder mr-2">Ville :</span>
                    <span class="text-muted font-weight-bold">{{ entreprise.ville_label }}</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mt-1">
                    <span class="text-dark-75 font-weight-bolder mr-2">Statut :</span>
                    <span
                      class="label label-md label-inline font-weight-normal"
                      v-bind:style="{
                          color: 'rgb(' + entreprise.statut_color + ')',
                          'background-color':
                          'rgb(' + entreprise.statut_color + ',.2)'
                        }"
                    >{{ entreprise.statut_label }}</span>
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
    </div>

    <div
      class="modal fade"
      id="modal_form_entreprise"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-if="!entreprise.id"
              class="modal-title"
              id="exampleModalLabel"
            >Ajouter une entreprise</h5>
            <h5
              v-if="entreprise.id"
              class="modal-title"
              id="exampleModalLabel"
            >Modifier une entreprise</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="save" class="mb-3">
            <div class="modal-body">
              <div class="form-group mt-2 mb-2 text-center">
                <div
                  class="image-input image-input-empty image-input-outline"
                  id="kt_user_edit_avatar"
                  v-bind:style="{ 'background-image': 'url(' + entreprise.image_url + ')' }"
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
              <div class="form-group mb-0">
                <label for="recipient-name" class="form-control-label">Enseigne :</label>
                <input
                  type="text"
                  autocomplete="off"
                  class="form-control"
                  placeholder="Enseigne"
                  v-model="entreprise.label"
                />
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
                      v-model="entreprise.tel"
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
                      v-model="entreprise.email"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 pt-0">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Ville :</label>
                    <v-autocomplete
                      v-model="entreprise.ville_id"
                      :items="villes"
                      clearable
                      dense
                      filled
                    ></v-autocomplete>
                  </div>
                </div>
                <div class="col-md-6 pt-0">
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Secteur principal :</label>
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
              </div>

              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Secteurs :</label>
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
      url: "entreprises",
      validationErrors: null,
      ville_search: null,
      entreprises: [],
      entreprise_id: null,
      statuts: [],
      villes: [],
      rubriques: [],
      filter: {
        secteur: null,
        ville: null,
        statut: null,
      },
      entreprise: {
        id: null,
        label: null,
        prenom: null,
        tel: null,
        image: null,
        image_url: null,
        ville_id: null,
        secteur_id: null,
        enabled: null,
        email: null,
        secteurs_id: [],
      },
      edit: false,
    };
  },
  created() {
    if (this.$route.query.statut) {
      this.filter.statut = parseInt(this.$route.query.statut);
    }
    this.fetch();
  },
  methods: {
    fetch(page_url) {
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
            this.entreprises = response.data.entreprises;
            if (response.data.statuts) {
              this.statuts = response.data.statuts;
            }
            if (response.data.villes) {
              this.villes = response.data.villes;
            }
            if (response.data.rubriques) {
              this.rubriques = response.data.rubriques;
            }
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    deleteEntreprise(id) {
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
                .delete(this.url + id)
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
    sendPassword(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Oui !",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["entreprise"] = id;
              axios
                .get(this.url + "/password", {
                  params: params,
                })
                .then((response) => {
                  swal.fire(
                    "Email envoyé !",
                    "Merci de consulter votre boite email, un email vous a été envoyé, contenant votre nouveau mot de passe.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    save() {
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
          this.clearForm();
          $("#modal_form_entreprise").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    saveCompetences() {
      let params = {};
      params["entreprise"] = this.entreprise_id;
      params["competences"] = this.entreprise_competences;

      axios
        .post(this.url + "/competences", params)
        .then((response) => {
          $("#modal_form_competences").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addEntreprise() {
      this.clearForm();
      this.entreprise.image_url =
        "https://via.placeholder.com/300/004c68/FFF?text=Logo";
      this.validationErrors = null;
      var avatar = new KTImageInput("kt_user_edit_avatar");
    },
    editEntreprise(entreprise) {
      $("#modal_form_entreprise").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      var avatar = new KTImageInput("kt_user_edit_avatar");
      $.each(
        this.entreprise,
        function (key, value) {
          this.entreprise[key] = entreprise[key];
        }.bind(this)
      );
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.entreprise,
        function (key, value) {
          this.entreprise[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.entreprise.image = e.target.files[0];
    },
  },
};
</script>
