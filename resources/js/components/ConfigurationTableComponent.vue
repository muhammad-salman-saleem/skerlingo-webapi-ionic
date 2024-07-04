<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Configuration</h5>
          <div class="d-flex align-items-center" id="kt_subheader_search"></div>
        </div>
        <!--end::Info-->
      </div>
    </div>

    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="card card-custom gutter-b" v-bind:class="{ 'overlay overlay-block': overlay }">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Configuration</h3>
            </div>
          </div>

          <div class="overlay-wrapper">
            <div class="card-body p-2 pt-0">
              <div class="table-responsive">
                <table
                  class="table table-head-custom table-vertical-center"
                  id="kt_advance_table_widget_1"
                >
                  <thead>
                    <tr class="text-left">
                      <th style="width:400px;">Configuration</th>
                      <th>Valeur</th>
                      <th style="width:200px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="configuration in configurations" v-bind:key="configuration.id">
                      <td class="text-right">
                        <span class="font-weight-bold">{{configuration.label}}</span>
                      </td>
                      <td class>
                        <input
                          type="text"
                          v-if="configuration.type == 'input'"
                          class="form-control"
                          :placeholder="configuration.label"
                          v-model="configuration.value"
                        />
                        <textarea
                          class="form-control"
                          v-if="configuration.type == 'textarea'"
                          v-model="configuration.value"
                          rows="2"
                        ></textarea>
                        <tiptap-vuetify
                          v-if="configuration.type == 'editor'"
                          :extensions="extensions"
                          v-model="configuration.value"
                        />
                      </td>
                      <td class>
                        <button
                          @click="saveTraduction($event,configuration)"
                          class="btn btn-sm btn-light-info mr-2 spinner-darker-info spinner-right"
                        >
                          <span class="svg-icon svg-icon-info svg-icon-lg">
                            <i class="la la-check"></i>
                          </span>
                          Enregistrer
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="overlay-layer bg-dark-o-10" v-if="overlay">
            <div class="spinner spinner-primary"></div>
          </div>
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
      url: "configurations/table",
      search: "",
      validationErrors: null,
      overlay: null,
      configurations: [],
      rubriques: [],
      filter: {
        rubrique: null,
        service: null,
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
    var avatar = new KTImageInput("kt_user_edit_avatar");
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch() {
      this.overlay = true;

      let params = {};
      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            this.configurations = response.data.configurations;
            this.overlay = false;
          }.bind(this)
        )
        .catch((error) => {
          // code here when an upload is not valid
          this.overlay = false;
          console.log("check error: ", this.error);
        });
    },
    saveTraduction(e, configuration) {
      e.target.disabled = true;
      e.target.classList.toggle("spinner");

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(configuration, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post("configurations/save_partie", formData, config)
        .then((response) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          this.fetch();
        })
        .catch((error) => {
          e.target.disabled = false;
          e.target.classList.toggle("spinner");
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
