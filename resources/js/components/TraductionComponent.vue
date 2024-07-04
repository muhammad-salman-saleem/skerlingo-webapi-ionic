<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Traductions</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span
              class="text-dark-50 font-weight-bold"
              id="kt_subheader_total"
            >{{types.length}} rubriques</span>
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
                  <h3 class="card-label">Traductions</h3>
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
                      <span>{{ item.rubrique_label }} : {{ item.label }} - {{ item.id }}</span>
                    </div>
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
            <form class="mb-3">
              <div class="card card-custom card-sticky" id="kt_page_sticky_card_">
                <div class="card-header">
                  <div class="card-title">
                    <h3 v-if="!traduction.id" class="card-label">Ajouter une rubrique</h3>
                    <h3 v-if="traduction.id" class="card-label">Modifier une rubrique</h3>
                  </div>
                  <div class="card-toolbar">
                    <a
                      href="#"
                      v-if="traduction.id"
                      @click="clearForm()"
                      class="btn btn-light-primary mr-2"
                    >
                      <i class="ki ki-long-arrow-back icon-sm"></i>
                      Retour
                    </a>
                    <div class="btn-group">
                      <button
                        type="submit"
                        :disabled="!traduction.text"
                        @click="saveStatut($event)"
                        class="btn btn-primary spinner-light-success spinner-right"
                      >
                        <i class="ki ki-check icon-sm"></i>
                        Enregistrer
                      </button>
                      <button
                        type="button"
                        :disabled="!traduction.text"
                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      ></button>
                      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav nav-hover flex-column pl-0">
                          <li
                            class="nav-item"
                            v-if="traduction.id && traduction.children.length == 0"
                          >
                            <a href="#" @click="deleteStatut(traduction.id)" class="nav-link">
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
                    <div class="tab-content mt-5" id="myTabContent">
                      <div class>
                        <h4 class="text-dark font-weight-bold mb-4">Informations :</h4>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>Rubrique</label>
                              <v-autocomplete
                                :items="rubriques"
                                v-model="traduction.rubrique_id"
                                clearable
                                dense
                                solo
                              ></v-autocomplete>
                            </div>
                            <div class="row">
                              <div class="col-md-12 pt-0">
                                <div class="form-group mb-0">
                                  <label for="recipient-name" class="form-control-label">Titre</label>
                                  <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Titre"
                                    v-model="traduction.text"
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Type</label>
                              <v-autocomplete
                                :items="types"
                                v-model="traduction.type"
                                clearable
                                dense
                                solo
                              ></v-autocomplete>
                            </div>
                          </div>
                        </div>
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
      url: "traductions",
      dataTree: [],
      times: [],
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
      validationErrors: null,
      types: [],
      listes: [],
      rubriques: [],
      traduction: {
        id: null,
        rubrique_id: null,
        text: null,
        enable: null,
        type: null,
        children: [],
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
      this.edit = true;
      $.each(
        this.traduction,
        function (key, value) {
          this.traduction[key] = item[key];
        }.bind(this)
      );
      this.get_questions();
    },
    itemClick(node) {
      this.edit = true;
      $.each(
        this.traduction,
        function (key, value) {
          this.traduction[key] = node.model[key];
        }.bind(this)
      );
    },
    saveOrder(without_popup = false) {
      this.overlay = true;
      let params = {};
      params["dataTree"] = this.dataTree;
      axios
        .post("traductions/save_order", params)
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
            if (saveOrder) this.saveOrder(true);
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    get_questions() {
      let params = {};
      params["rubrique_id"] = this.traduction.id;
      axios
        .get("questions", {
          params: params,
        })
        .then(
          function (response) {
            this.traduction.questions = response.data.questions;
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
                  let item = this.traduction.questions.find(
                    (item) => item.id === id
                  );
                  let index = this.traduction.questions.indexOf(item);
                  this.traduction.questions.splice(index, 1);
                  this.traduction.questions = [...this.traduction.questions];
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
      $.each(this.traduction, function (key, value) {
        formData.append(key, value);
      });
      formData.append("questions", JSON.stringify(this.traduction.questions));

      axios
        .post(this.url, formData, config)
        .then((response) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          this.clearForm();
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
      console.log(this.traduction.questions);
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
    clearForm() {
      this.edit = false;
      $.each(
        this.traduction,
        function (key, value) {
          this.traduction[key] = null;
        }.bind(this)
      );
      this.traduction["questions"] = [];
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
      this.traduction.icon = e.target.files[0];
    },
    onImageChangeModele(e) {
      this.traduction.image = e.target.files[0];
    },
  },
};
</script>
