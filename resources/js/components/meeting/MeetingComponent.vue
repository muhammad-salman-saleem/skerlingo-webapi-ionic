<template>
  <div v-if="$auth.user()['role_id'] == 1">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">B2B Meetings</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{ meetings.length }} B2B Meetings</span>
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
            @click="addMeeting()"
            data-toggle="modal"
            href="#modal_form_meeting"
            class="btn btn-primary btn-sm"
          >
            <i class="ki ki-plus icon-1x"></i>New b2b Meeting
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
              <div class="col-xl-3">
                <div class="form-group mb-0">
                  <label>Secteur</label>
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
              <div class="col-xl-3">
                <div class="form-group mb-0">
                  <label>Importateur</label>
                  <v-autocomplete
                    :items="importateurs"
                    v-model="filter.entreprise"
                    clearable
                    dense
                    filled
                  ></v-autocomplete>
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
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">B2B Meetings</h3>
            </div>
          </div>
          <div class="card-body p-5 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table
                class="table overflow-initial"
                :headers="_headers"
                :items="meetings"
                :search="search"
              >
                <template v-slot:item.importer_label="{ item }">
                  <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-2">
                      <img v-if="item.importer_pays_flag" v-bind:src="item.importer_pays_flag" alt />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <router-link
                        :to="{ name: 'rfq_item', params: { id: item.id } }"
                        class="text-dark text-hover-primary font-size-sm font-weight-bold"
                      >{{item.importer_label}}</router-link>
                      <span
                        class="text-muted font-size-xs"
                      >{{ item.importer_company }} - {{ item.importer_pays_label }}</span>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.date="{ item }">
                  <span class="font-size-sm font-roboto">{{ item.date }}</span>
                </template>
                <template v-slot:item.sujet="{ item }">
                  <span class="font-size-sm font-weight-bold">{{ item.sujet }}</span>
                </template>
                <template v-slot:item.subscriptions_count="{ item }">
                  <span
                    class="label label-lg label-inline font-weight-normal"
                  >{{ item.subscriptions_count }}</span>
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
                          <router-link
                            :to="{ name: 'meeting_item', params: { id: item.id } }"
                            class="navi-link"
                          >
                            <span class="navi-icon">
                              <i class="flaticon-eye"></i>
                            </span>
                            <span class="navi-text">détails</span>
                          </router-link>
                        </li>
                        <li class="navi-item">
                          <a @click="editMeeting(item)" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon2-edit"></i>
                            </span>
                            <span class="navi-text">Modifier</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a @click="deleteMeeting(item.id)" class="navi-link">
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
      id="modal_form_meeting"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!meeting.id" class="modal-title" id="exampleModalLabel">New b2b Meeting</h5>
            <h5 v-if="meeting.id" class="modal-title" id="exampleModalLabel">Modifier un meeting</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="saveMeeting" class="mb-3">
            <div class="modal-body p-0">
              <div class="card gutter-b mb-0">
                <div class="card-body">
                  <div
                    class="tab-pane fade show active"
                    id="kt_tab_pane_1_4"
                    role="tabpanel"
                    aria-labelledby="kt_tab_pane_1_4"
                  >
                    <div class="row">
                      <div class="col-md-6 pt-0">
                        <div class="form-group mb-0 pb-0">
                          <label for="recipient-name" class="form-control-label">Secteur :</label>
                          <v-autocomplete
                            v-model="meeting.secteur_id"
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
                      <div class="col-md-6 pt-0">
                        <div class="form-group mb-0">
                          <label for="recipient-name" class="form-control-label">Importer :</label>
                          <v-autocomplete
                            v-model="meeting.importer_id"
                            :items="importateurs"
                            clearable
                            dense
                            filled
                          ></v-autocomplete>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 pt-0">
                        <div class="form-group mb-0">
                          <label for="recipient-name" class="form-control-label">Sujet :</label>
                          <input
                            type="text"
                            autocomplete="off"
                            class="form-control"
                            placeholder="Meeting"
                            v-model="meeting.sujet"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="form-group mb-1">
                      <label for="recipient-name" class="form-control-label">Request :</label>
                      <!-- Use the component in the right place of the template -->
                      <tiptap-vuetify :extensions="extensions" v-model="meeting.message" />
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group mb-0">
                          <label for="recipient-name" class="form-control-label">From :</label>
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
                                v-model="meeting.date_debut"
                                persistent-hint
                                v-bind="attrs"
                                @blur="meeting.date_debut = meeting.date_debut"
                                v-on="on"
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="meeting.date_debut"
                              no-title
                              @input="menu1 = false"
                            ></v-date-picker>
                          </v-menu>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group mb-0">
                          <label for="recipient-name" class="form-control-label">To :</label>
                          <v-menu
                            ref="menu2"
                            v-model="menu2"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="290px"
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                class="date_picker_text"
                                v-model="meeting.date_fin"
                                persistent-hint
                                v-bind="attrs"
                                @blur="meeting.date_fin = meeting.date_fin"
                                v-on="on"
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="meeting.date_fin"
                              no-title
                              @input="menu2 = false"
                            ></v-date-picker>
                          </v-menu>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="form-control-label">Keywords :</label>
                      <v-combobox
                        v-model="meeting.keywords"
                        chips
                        clearable
                        label="Keywords"
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
                  <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
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
              <button type="submit" class="btn btn-primary">Enregistrer</button>
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
      url: "meetings",
      search: "",
      headers: [
        {
          text: "Importer",
          align: "middle",
          value: "importer_label",
        },
        { text: "Sujet", align: "middle", value: "sujet", width: "280px" },
        {
          text: "Subscriptions",
          align: "middle",
          value: "subscriptions_count",
        },
        { text: "Date", align: "middle", value: "date" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      filter: {
        type: null,
        secteur: null,
        entreprise: null,
        validation_skerlingo: null,
        validation_exporteur: null,
      },
      validationErrors: null,
      meetings: [],
      importateurs: [],
      rubriques: [],
      types: [],
      meeting: {
        id: null,
        sujet: null,
        message: null,
        image: null,
        image_url: null,
        secteur_id: null,
        importer_id: null,
        date_debut: null,
        date_fin: null,
        keywords: [],
        images: [],
      },
      edit: false,
      menu1: false,
      menu2: false,
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
            if (response.data.importateurs)
              this.importateurs = response.data.importateurs;
            this.types = response.data.types;
            this.rubriques = response.data.rubriques;
            this.meetings = response.data.meetings;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    saveMeeting() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.meeting, function (key, value) {
        formData.append(key, value ? value : "");
      });
      formData.append("keywords", JSON.stringify(this.meeting.keywords));

      axios
        .post(this.url, formData, config)
        .then((response) => {
          swal.fire(response.data.title, response.data.message, "success");
          this.clearForm();
          $("#modal_form_meeting").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addMeeting() {
      this.clearForm();
      this.meeting.image_url =
        "https://via.placeholder.com/300/004c68/FFF?text=Image";
      this.validationErrors = null;
      var avatar = new KTImageInput("kt_user_edit_avatar_meeting");
      var avatar = new KTImageInput("kt_user_edit_avatar_meeting_image");
    },
    editMeeting(meeting) {
      meeting = _.cloneDeep(meeting);

      $("#modal_form_meeting").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      var avatar = new KTImageInput("kt_user_edit_avatar_meeting");
      var avatar = new KTImageInput("kt_user_edit_avatar_meeting_image");
      $.each(
        this.meeting,
        function (key, value) {
          this.meeting[key] = meeting[key];
        }.bind(this)
      );
    },
    valider_meeting(id, type) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de valider ce meeting !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Valider",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = id;
              params["type"] = type;
              axios
                .get("meetings/valider_meeting", {
                  params: params,
                })
                .then((response) => {
                  this.$root.$refs.AdminSideBar.fetch();
                  swal.fire(
                    "Meeting Validé",
                    "Le meeting a été validé avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    annuler_meeting(id, type) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point d'annuler la validation du meeting !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Annuler la validation",
          cancelButtonText: "Fermer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = id;
              params["type"] = type;
              axios
                .get("meetings/annuler_meeting", {
                  params: params,
                })
                .then((response) => {
                  this.$root.$refs.AdminSideBar.fetch();
                  swal.fire(
                    "Validation annulé",
                    "La validation a été annulée avec succés.",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    deleteMeeting(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer ce meeting !",
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
                    "Meeting supprimé !",
                    "Le Meeting a été supprimé avec succés.",
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
      this.meeting.keywords.splice(this.meeting.keywords.indexOf(item), 1);
      this.meeting.keywords = [...this.meeting.keywords];
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.meeting,
        function (key, value) {
          this.meeting[key] = null;
        }.bind(this)
      );
    },
    onImageChangeMeeting(e) {
      this.meeting.image = e.target.files[0];
    },
    onImageChangeMeetingImage(e) {
      let image = e.target.files[0];

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();

      formData.append("image", image);
      if (this.meeting.id) formData.append("meeting", this.meeting.id);

      axios
        .post("meetings/upload_photo", formData, config)
        .then((response) => {
          if (response.data.image)
            this.meeting.images.push(response.data.image);

          $("#kt_user_edit_avatar_meeting_image .remove_photo").trigger(
            "click"
          );
          $("#kt_user_edit_avatar_meeting_image input").val("");
          $("#kt_user_edit_avatar_meeting_image .image-input-wrapper").css(
            "background-image",
            "url(https://via.placeholder.com/300/004c68/FFF?text=Upload)"
          );
        })
        .catch((error) => {
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
                  this.meeting.images = this.meeting.images.filter(function (
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
  },
};
</script>
