<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Cards</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{rubriques.length}} Cards</span>
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
          <div class="dropdown dropdown-inline ml-3 mb-3">
            <button
              type="button"
              class="btn btn-dark btn-nice dropdown-toggle font-weight-bold"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >Actions</button>
            <!--begin::Dropdown Menu-->
            <div
              style="min-width: 270px;"
              class="dropdown-menu dropdown-menu-sm dropdown-menu-right font-weight-normal"
            >
              <!--begin::Navigation-->
              <ul class="navi flex-column navi-hover py-2 pl-0">
                <li class="navi-item">
                  <a
                    @click="updateDescriptions('title_hiragana')"
                    href="javascript:void(0)"
                    class="navi-link"
                  >
                    <span class="navi-icon mr-2">
                      <i class="far fa-file-excel icon-md text-dark"></i>
                    </span>
                    <span class="navi-text font-size-sm font-weight-bold">Update hiragana Title</span>
                  </a>
                </li>
                <li class="navi-item">
                  <a
                    @click="updateDescriptions('description_hiragana')"
                    href="javascript:void(0)"
                    class="navi-link"
                  >
                    <span class="navi-icon mr-2">
                      <i class="far fa-file-excel icon-md text-dark"></i>
                    </span>
                    <span
                      class="navi-text font-size-sm font-weight-bold"
                    >Update hiragana descriptions</span>
                  </a>
                </li>
                <li class="navi-item">
                  <a
                    @click="updateDescriptions('exemples_hiragana')"
                    href="javascript:void(0)"
                    class="navi-link"
                  >
                    <span class="navi-icon mr-2">
                      <i class="far fa-file-excel icon-md text-dark"></i>
                    </span>
                    <span class="navi-text font-size-sm font-weight-bold">Update hiragana examples</span>
                  </a>
                </li>
                <li class="navi-item">
                  <a
                    @click="updateDescriptions('exemples_katakana')"
                    href="javascript:void(0)"
                    class="navi-link"
                  >
                    <span class="navi-icon mr-2">
                      <i class="far fa-file-excel icon-md text-dark"></i>
                    </span>
                    <span class="navi-text font-size-sm font-weight-bold">Update katakana examples</span>
                  </a>
                </li>
              </ul>
              <!--end::Navigation-->
            </div>
            <!--end::Dropdown Menu-->
          </div>
        </div>
        <div v-if="false" class="d-flex align-items-center">
          <a
            @click="addRubrique()"
            data-toggle="modal"
            href="#modal_form_rubrique"
            class="btn btn-nice d-none btn-primary btn-sm"
          >
            <i class="ki ki-plus icon-1x"></i> Ajouter une leçon
          </a>
        </div>
        <!--end::Toolbar-->
      </div>
    </div>

    <div class="d-flex flex-column-fluid">
      <input
        type="file"
        style="display:none;"
        name="profile_avatar"
        id="profile_avatar_input"
        v-on:change="onUploadFileDescription"
        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
      />
      <div class="container-fluid">
        <div class="card card-custom gutter-b">
          <div class="card-body py-2">
            <div class="form-group mb-0">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <label for="recipient-name" class="form-control-label">Type :</label>
                  <v-autocomplete v-model="type" @change="fetch()" :items="types" dense filled></v-autocomplete>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-custom gutter-b">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Cards</h3>
            </div>
          </div>
          <div class="card-body p-5 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table class="table" :headers="headers" :items="rubriques" :search="search">
                <template v-slot:item.text="{ item }">
                  <div class="d-flex align-items-center">
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <a
                        href="#"
                        class="text-dark text-hover-primary font-weight-bold"
                      >{{item.text}}</a>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.actions="{ item }">
                  <a
                    @click="editRubrique(item)"
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
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
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
                    @click="deleteCategorie(item.id)"
                    class="btn btn-icon d-none btn-light btn-hover-primary btn-sm"
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
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
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
                </template>
              </v-data-table>
            </v-card>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_rubrique"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!rubrique.id" class="modal-title" id="exampleModalLabel">Ajouter une leçon.</h5>
            <h5 v-if="rubrique.id" class="modal-title" id="exampleModalLabel">Modifier une leçon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i aria-hidden="true" class="ki ki-close"></i>
            </button>
          </div>
          <form @submit.prevent="saveRubrique" class="mb-3">
            <div class="modal-body">
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

              <div class="form-group mt-2">
                <label for="recipient-name" class="form-control-label">Romaji</label>
                <input
                  type="text"
                  class="form-control"
                  :placeholder="'Romaji'"
                  v-model="rubrique.romaji"
                />
              </div>

              <div class="form-group mt-2">
                <label for="recipient-name" class="form-control-label">Kana</label>
                <input
                  type="text"
                  class="form-control"
                  :placeholder="'Kana'"
                  v-model="rubrique.kana"
                />
              </div>

              <div
                v-for="l in langues"
                v-bind:key="l.value"
                v-bind:class="{ 'd-none': langue != l.value  }"
              >
                <div class="form-group mt-2">
                  <label for="recipient-name" class="form-control-label">Card title</label>
                  <input
                    type="text"
                    class="form-control"
                    :placeholder="'Card title '+l.value "
                    v-model="rubrique['text_'+l.value]"
                  />
                </div>
              </div>

              <div
                v-for="l in langues"
                v-bind:key="l.value"
                v-bind:class="{ 'd-none': langue != l.value  }"
              >
                <div class="form-group mt-2">
                  <label for="recipient-name" class="form-control-label">Sub title</label>

                  <ckeditor
                    :editor="editor"
                    :config="editorConfig"
                    v-model="rubrique['description_'+l.value]"
                  ></ckeditor>
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
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
      url: "lettres",
      search: "",
      headers: [
        {
          text: "Romaji",
          align: "middle",
          value: "romaji",
        },
        {
          text: "Kana",
          align: "middle",
          value: "kana",
        },
        {
          text: "Card",
          align: "middle",
          value: "label",
        },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      rubriques: [],
      langues: [],
      langue: "en",
      types: [],
      type: "hiragana",
      rubrique: {
        id: null,
        text: null,
        romaji: null,
        kana: null,
        text_en: null,
        text_fr: null,
        description_fr: null,
        description_en: null,
        show_menu: null,
        image_url: null,
        icon: null,
      },
      edit: false,
      upload_type: "",
    };
  },
  mounted() {
    var avatar = new KTImageInput("kt_user_edit_avatar");
  },
  created() {
    this.fetch();
  },
  methods: {
    uploader(editor) {
      editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
        return new UploadAdapter(loader);
      };
    },
    fetch() {
      let params = {};

      params["type"] = this.type;

      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            this.rubriques = response.data.rubriques;
            this.langues = response.data.langues;
            this.types = response.data.types;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    updateDescriptions(type) {
      this.upload_type = type;
      $("#profile_avatar_input").trigger("click");
    },
    onUploadFileDescription(e) {
      this.overlay = true;

      let image = e.target.files[0];

      $(".overlay-upload").removeClass("d-none");

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();

      formData.append("file", image);
      formData.append("upload_type", this.upload_type);

      axios
        .post("lettres/update_descriptions", formData, config)
        .then((response) => {
          $(".overlay-upload").addClass("d-none");
          this.fetch();

          swal.fire("Update done !", "Update done successfully.", "success");

          $("#profile_avatar_input").val(null);

          $("#kt_user_edit_avatar_version_image .remove_photo").trigger(
            "click"
          );
          $("#kt_user_edit_avatar_version_image input").val("");
          $("#kt_user_edit_avatar_version_image .image-input-wrapper").css(
            "background-image",
            "url(https://via.placeholder.com/300/004c68/FFF?text=New Version)"
          );

          this.overlay = false;
        })
        .catch((error) => {
          $(".overlay-upload").addClass("d-none");
          this.overlay = false;
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    deleteCategorie(id) {
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
                  this.fetch();
                  swal.fire(
                    "Catégorie supprimée !",
                    "La Catégorie a été supprimée avec succés.",
                    "success"
                  );
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveRubrique() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.rubrique, function (key, value) {
        formData.append(key, value ? value : "");
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.clearForm();
          $("#modal_form_rubrique").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addRubrique() {
      this.clearForm();
      this.validationErrors = null;
    },
    editRubrique(rubrique) {
      $("#modal_form_rubrique").modal("toggle");
      var avatar = new KTImageInput("kt_user_edit_avatar");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = rubrique[key];
        }.bind(this)
      );
    },
    clearForm() {
      $("#kt_user_edit_avatar .remove_photo").trigger("click");
      $("#kt_user_edit_avatar input").val("");
      $("#kt_user_edit_avatar .image-input-wrapper").css(
        "background-image",
        "url(https://via.placeholder.com/300/004c68/FFF?text=Upload)"
      );
      this.edit = false;
      $.each(
        this.rubrique,
        function (key, value) {
          this.rubrique[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.rubrique.image_url = "";
      this.rubrique.icon = e.target.files[0];
    },
    changeLang(l) {
      this.langue = l.value;
    },
  },
};
</script>
