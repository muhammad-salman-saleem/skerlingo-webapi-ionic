<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Livreurs en attente</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{ livreurs.length }} Livreurs</span>
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
        <div class="card card-custom gutter-b">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Livreurs en attente</h3>
            </div>
          </div>
          <div class="card-body p-5 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table class="table" :headers="headers" :items="livreurs" :search="search">
                <template v-slot:item.nomComplet="{ item }">
                  <span class="font-weight-bold">
                    {{
                    item.nomComplet
                    }}
                  </span>
                </template>
                <template v-slot:item.ville_label="{ item }">
                  <span
                    class="label label-lg label-light-primary label-inline font-weight-normal"
                  >{{ item.ville_label }}</span>
                </template>
                <template v-slot:item.actions="{ item }">
                  <router-link
                    :to="{ name: 'livreur_profile', params: { id: item.id } }"
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
                <template v-slot:item.date="{ item }">
                  <span>{{ item.date }}</span>
                </template>
              </v-data-table>
            </v-card>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_livreur"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!livreur.id" class="modal-title" id="exampleModalLabel">Ajouter un livreur</h5>
            <h5 v-if="livreur.id" class="modal-title" id="exampleModalLabel">Modifier un livreur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form @submit.prevent="saveLivreur" class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Nom commercial :</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nom commercial"
                  v-model="livreur.raison_sociale"
                />
              </div>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Adresse :</label>
                <textarea class="form-control" v-model="livreur.adresse" rows="2"></textarea>
              </div>
              <div class="form-group mb-0">
                <label for="recipient-name" class="form-control-label">Ville :</label>
                <v-autocomplete v-model="livreur.ville_id" :items="villes" clearable dense filled></v-autocomplete>
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
export default {
  data() {
    return {
      url: "livreurs",
      search: "",
      headers: [
        {
          text: "Livreur",
          align: "middle",
          value: "nomComplet",
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
          text: "Ville",
          align: "middle",
          value: "ville_label",
        },
        {
          text: "Date d'inscription",
          align: "middle",
          value: "date",
        },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      livreurs: [],
      villes: [],
      livreur: {
        id: null,
        ville_id: null,
        raison_sociale: null,
        adresse: null,
      },
      edit: false,
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch() {
      let params = {};
      params["en_attente"] = true;
      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            this.villes = response.data.villes;
            this.livreurs = response.data.livreurs;
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
      $.each(this.livreur, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.clearForm();
          $("#modal_form_livreur").modal("toggle");
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
    },
    editLivreur(livreur) {
      $("#modal_form_livreur").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.livreur,
        function (key, value) {
          this.livreur[key] = livreur[key];
        }.bind(this)
      );
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.livreur,
        function (key, value) {
          this.livreur[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.livreur.image = e[0];
    },
  },
};
</script>
