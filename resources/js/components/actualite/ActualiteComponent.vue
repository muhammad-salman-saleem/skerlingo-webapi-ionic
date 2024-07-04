<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Actualités</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{actualites.length}} actualites</span>
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
            @click="addActualite()"
            data-toggle="modal"
            href="#modal_form_actualite"
            class="btn btn-primary btn-sm"
          >
            <i class="ki ki-plus icon-1x"></i>Ajouter une actualité
          </a>
        </div>
        <!--end::Toolbar-->
      </div>
    </div>

    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="card card-custom gutter-b">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Liste des Actualités</h3>
            </div>
          </div>
          <div class="card-body p-5 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table class="table" :headers="_headers" :items="actualites" :search="search">
                <template v-slot:item.label="{ item }">
                  <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60 symbol-light-success mr-2">
                      <img v-bind:src="item.image_url" alt />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <a
                        href="#"
                        class="text-dark text-hover-primary font-weight-bold"
                      >{{item.label}}</a>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.intro="{ item }">
                  <small class>{{ item.intro }}</small>
                </template>
                <template v-slot:item.date_format="{ item }">
                  <span
                    class="label label-lg label-light-dark label-inline font-weight-normal"
                  >{{ item.date_format }}</span>
                </template>
                <template v-slot:item.actions="{ item }">
                  <a href="#" @click="editActualite(item)" class="btn btn-icon btn-light btn-sm">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                      <i class="flaticon-edit"></i>
                      <!--end::Svg Icon-->
                    </span>
                  </a>
                  <a href="#" class="btn btn-icon btn-light btn-sm">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                      <i class="flaticon-delete"></i>
                      <!--end::Svg Icon-->
                    </span>
                  </a>
                </template>
              </v-data-table>
            </v-card>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_actualite"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-if="!actualite.id"
              class="modal-title"
              id="exampleModalLabel"
            >Ajouter une actualité</h5>
            <h5
              v-if="actualite.id"
              class="modal-title"
              id="exampleModalLabel"
            >Modifier une actualité</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form @submit.prevent="saveActualite" class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Titre :</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Titre"
                      v-model="actualite.label"
                    />
                  </div>
                  <div class="form-group mb-0">
                    <label for="recipient-name" class="form-control-label">Brève description :</label>
                    <textarea class="form-control" v-model="actualite.intro" rows="2"></textarea>
                  </div>
                </div>
              </div>

              <div class="form-group mt-2">
                <label for="recipient-name" class="form-control-label">Date de publication</label>
                <v-menu
                  ref="menu1"
                  v-model="menu1"
                  :close-on-content-click="false"
                  transition="scale-transition"
                  offset-y
                  max-width="290px"
                  min-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      class="date_picker_text"
                      v-model="actualite.date"
                      persistent-hint
                      v-bind="attrs"
                      @blur="actualite.date = actualite.date"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="actualite.date" no-title @input="menu1 = false"></v-date-picker>
                </v-menu>
              </div>

              <div class="form-group">
                <div class="checkbox-list">
                  <label class="checkbox">
                    <input type="checkbox" name="enabled" v-model="actualite.enabled" />
                    <span></span> Afficher l'actualité pour les clients ?
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Détails :</label>
                <!-- Use the component in the right place of the template -->
                <tiptap-vuetify :extensions="extensions" v-model="actualite.description" />
              </div>

              <div class="form-group mt-2 text-center">
                <vue-dropify @upload="onImageChange" accept=".png, .jpg, .jpeg, .svg"></vue-dropify>
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
      url: "actualites",
      search: "",
      headers: [
        { text: "Titre", align: "middle", value: "label" },
        { text: "Brève description", align: "middle", value: "intro" },
        { text: "Date", align: "middle", value: "date_format" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      actualites: [],
      metiers: [],
      villes: [],
      actualite: {
        id: null,
        label: null,
        image: null,
        intro: null,
        description: null,
        enabled: null,
        date: new Date().toISOString().substr(0, 10),
        image_url: null,
      },
      edit: false,
      menu1: false,

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
    fetch(current) {
      axios
        .get(this.url)
        .then(
          function (response) {
            this.actualites = response.data.actualites;
            this.metiers = response.data.metiers;
            this.villes = response.data.villes;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    deleteActualite(id) {
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
    saveActualite() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.actualite, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.clearForm();
          $("#modal_form_actualite").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addActualite() {
      this.clearForm();
      this.validationErrors = null;
    },
    editActualite(actualite) {
      $("#modal_form_actualite").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.actualite,
        function (key, value) {
          this.actualite[key] = actualite[key];
        }.bind(this)
      );
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.actualite,
        function (key, value) {
          this.actualite[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.actualite.image = e[0];
    },
  },
};
</script>
