<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Articles</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{articles.length}} articles</span>
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
            v-if="$auth.user()['role_id'] == 1"
            @click="addArticle()"
            data-toggle="modal"
            href="#modal_form_article"
            class="btn btn-nice btn-primary btn-sm"
          >
            <i class="ki ki-plus icon-1x"></i>Ajouter un article
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
              <h3 class="card-label">Liste des Articles</h3>
            </div>
          </div>
          <div class="card-body p-2 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table class="table" :headers="_headers" :items="articles" :search="search">
                <template v-slot:item.label="{ item }">
                  <div class="d-flex align-items-center" style="max-width:200px">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50 symbol-light-success mr-2">
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
                <template v-slot:item.couleur_label="{ item }">
                  <span>{{ item.couleur_label?item.couleur_label:'-' }}</span>
                </template>
                <template v-slot:item.taille_label="{ item }">
                  <span>{{ item.taille_label?item.taille_label:'-' }}</span>
                </template>
                <template v-slot:item.client_label="{ item }">
                  <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-2">
                      <img v-bind:src="item.client_image" alt />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <a
                        href="#"
                        class="text-dark text-hover-primary font-weight-bold"
                      >{{item.client_label}}</a>
                      <span class="text-muted">{{item.client_tel}}</span>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.longueur="{ item }">
                  <span>{{ item.longueur }} / {{ item.largeur }} / {{ item.hauteur }} cm</span>
                </template>
                <template v-slot:item.poids="{ item }">
                  <span
                    class="label label-lg label-light-primary label-inline font-weight-normal"
                  >{{ item.poids }} KG</span>
                </template>
                <template v-slot:item.prix="{ item }">
                  <span
                    class="label label-lg label-primary label-inline font-weight-normal"
                  >{{ item.prix }} MAD</span>
                </template>
                <template v-slot:item.stock_interne="{ item }">
                  <span
                    class="label label-lg label-warning label-inline font-weight-normal"
                  >{{ item.stock_interne }}</span>
                </template>
                <template v-slot:item.stock="{ item }">
                  <span
                    class="label label-lg label-danger bg-gray-600 label-inline font-weight-normal"
                  >{{ item.stock }}</span>
                </template>
                <template v-slot:item.actions="{ item }">
                  <a :href="item.url_page" target="_blank" class="btn btn-icon btn-light btn-sm">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                      <i class="flaticon-eye"></i>
                      <!--end::Svg Icon-->
                    </span>
                  </a>
                  <a href="#" @click="editArticle(item)" class="btn btn-icon btn-light btn-sm">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                      <i class="flaticon-edit"></i>
                      <!--end::Svg Icon-->
                    </span>
                  </a>
                  <a href="#" @click="deleteArticle(item.id)" class="btn btn-icon btn-light btn-sm">
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
      id="modal_form_article"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!article.id" class="modal-title" id="exampleModalLabel">Ajouter un article</h5>
            <h5 v-if="article.id" class="modal-title" id="exampleModalLabel">Modifier un article</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form @submit.prevent="saveArticle" class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>

              <div class="row">
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group mb-0">
                        <label for="recipient-name" class="form-control-label">Rubrique :</label>
                        <v-autocomplete
                          :items="types"
                          v-model="article.type_id"
                          clearable
                          dense
                          solo
                        ></v-autocomplete>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group mb-0">
                        <label for="recipient-name" class="form-control-label">Titre</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Titre"
                          v-model="article.label"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-2">
                    <label for="recipient-name" class="form-control-label">Introduction</label>
                    <textarea
                      class="form-control"
                      :placeholder="'Introduction'"
                      v-model="article.intro"
                      rows="3"
                    ></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="d-block mb-3">Photo</label>
                    <div>
                      <div
                        style="width: 100%;"
                        class="image-input image-input-empty image-input-outline"
                        id="kt_user_edit_avatar"
                        v-bind:style="{ 'background-image': 'url(' + article.image_url + ')' }"
                      >
                        <div style="width: 100%; height: 170px;" class="image-input-wrapper"></div>
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
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Article</label>
                <ckeditor :editor="editor" :config="editorConfig" v-model="article.contenu"></ckeditor>
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
class UploadAdapter {
  constructor(loader) {
    // The file loader instance to use during the upload.
    this.loader = loader;
  }

  // Starts the upload process.
  upload() {
    return this.loader.file.then(
      (file) =>
        new Promise((resolve, reject) => {
          this._initRequest();
          this._initListeners(resolve, reject, file);
          this._sendRequest(file);
        })
    );
  }

  // Aborts the upload process.
  abort() {
    if (this.xhr) {
      this.xhr.abort();
    }
  }

  // Initializes the XMLHttpRequest object using the URL passed to the constructor.
  _initRequest() {
    const xhr = (this.xhr = new XMLHttpRequest());

    xhr.open(
      "POST",
      `${process.env.MIX_APP_URL}/api/blog_articles/ckeditor_upload`,
      true
    );
    xhr.responseType = "json";
  }

  // Initializes XMLHttpRequest listeners.
  _initListeners(resolve, reject, file) {
    const xhr = this.xhr;
    const loader = this.loader;
    const genericErrorText = `Couldn't upload file: ${file.name}.`;

    xhr.addEventListener("error", () => reject(genericErrorText));
    xhr.addEventListener("abort", () => reject());
    xhr.addEventListener("load", () => {
      const response = xhr.response;

      if (!response || response.error) {
        return reject(
          response && response.error ? response.error.message : genericErrorText
        );
      }

      resolve({
        default: response.url,
      });
    });

    if (xhr.upload) {
      xhr.upload.addEventListener("progress", (evt) => {
        if (evt.lengthComputable) {
          loader.uploadTotal = evt.total;
          loader.uploaded = evt.loaded;
        }
      });
    }
  }

  // Prepares the data and sends the request.
  _sendRequest(file) {
    // Prepare the form data.
    const data = new FormData();

    data.append("upload", file);

    // Send the request.
    this.xhr.send(data);
  }
}
import VueDropify from "vue-dropify";

import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  components: {
    "vue-dropify": VueDropify,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        extraPlugins: [this.uploader],
        mediaEmbed: {
          previewsInData: true,
        },
        alignment: {
          options: ["left", "right", "center", "justify"],
        },
      },
      url: "blog_articles",
      search: "",
      headers: [
        { text: "Titre", align: "middle", value: "label" },
        { text: "Rubrique", align: "middle", value: "type_label" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      articles: [],
      types: [],
      article: {
        id: null,
        label: null,
        image: null,
        intro: null,
        contenu: null,
        image_url: null,
        type_id: null,
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
    this.article.image_url =
      "https://via.placeholder.com/300/004c68/FFF?text=Image";
    this.validationErrors = null;
    var avatar = new KTImageInput("kt_user_edit_avatar");
    this.fetch();
  },
  mounted() {
    if (this.$route.query.add) {
      $("#modal_form_article").modal("toggle");
      var avatar = new KTImageInput("kt_user_edit_avatar");
    }
  },
  methods: {
    uploader(editor) {
      editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
        return new UploadAdapter(loader);
      };
    },
    fetch(current) {
      axios
        .get(this.url)
        .then(
          function (response) {
            this.articles = response.data.articles;
            this.types = response.data.types;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    deleteArticle(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer cet article !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Supprimer",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post("articles/" + id, {
                  _method: "DELETE",
                })
                .then((response) => {
                  this.fetch();
                  swal.fire(
                    "Article supprimé !",
                    "Le article a été supprimé avec succés.",
                    "success"
                  );
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveArticle() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.article, function (key, value) {
        formData.append(key, value ? value : "");
      });
      if (this.variantes) {
        formData.append("variantes", JSON.stringify(this.variantes));
      }

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.clearForm();
          $("#modal_form_article").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addArticle() {
      this.clearForm();
      var avatar = new KTImageInput("kt_user_edit_avatar");
      this.validationErrors = null;
    },
    editArticle(article) {
      $("#modal_form_article").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.article,
        function (key, value) {
          this.article[key] = article[key];
        }.bind(this)
      );
    },
    clearForm() {
      this.edit = false;
      this.variantes = [];
      $.each(
        this.article,
        function (key, value) {
          if (key != "contenu") {
            this.article[key] = null;
          }
          if (key == "contenu") this.article[key] = "";
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.article.image = e.target.files[0];
    },
  },
};
</script>
