<template>
  <div>
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container kt-container--fluid">
        <div class="kt-subheader__main">
          <h3 class="kt-subheader__title">Notifications</h3>
          <span class="kt-subheader__separator kt-subheader__separator--v"></span>
          <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total"></span>
          </div>
        </div>
        <div class="kt-subheader__toolbar">
          <a href="#" class></a>
          <a
            @click="addNotification()"
            data-toggle="modal"
            href="#modal_form_notification"
            class="btn btn-label-brand btn-bold"
          >Envoyer une notification</a>
        </div>
      </div>
    </div>

    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Notifications</h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-dialog
                  ref="dialog"
                  v-model="modal"
                  :return-value.sync="date"
                  persistent
                  width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      v-model="date"
                      label="Mois"
                      prepend-icon="event"
                      readonly
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" type="month" scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="filtreNotification()">OK</v-btn>
                  </v-date-picker>
                </v-dialog>
              </v-col>
              <v-spacer></v-spacer>
            </v-row>
          </div>
        </div>
        <div class="kt-portlet__body">
          <!--begin::Section-->
          <div class="kt-section">
            <div class="kt-section__content">
              <v-card style="box-shadow: none;">
                <v-data-table class="table table-striped" :headers="headers" :items="notifications">
                  <template v-slot:item.sujet="{ item }">
                    <span class="kt-font-bold">{{ item.sujet }}</span>
                  </template>
                  <template v-slot:item.message="{ item }">
                    <span class="kt-font-bold">{{ item.message }}</span>
                  </template>
                  <template v-slot:item.nombre_done="{ item }">
                    <span
                      class="btn btn-bold btn-sm btn-font-sm btn-label-info"
                    >{{ item.nombre_done }}</span>
                  </template>
                </v-data-table>
              </v-card>
            </div>
          </div>

          <!--end::Section-->
        </div>

        <!--end::Form-->
      </div>
    </div>

    <div
      class="modal fade"
      id="modal_form_notification"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Envoyer une notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="saveNotification" class="mb-3">
            <div class="modal-body">
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Titre :</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  placeholder="Titre"
                  v-model="notification.sujet"
                />
              </div>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Message :</label>
                <textarea
                  class="form-control"
                  required
                  placeholder="Message"
                  v-model="notification.message"
                ></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="clearForm()"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Fermer</button>
              <button
                type="submit"
                :disabled="!enable_submit"
                class="btn btn-primary"
              >Envoyer la notification</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueDropify from "vue-dropify";

export default {
  components: {
    "vue-dropify": VueDropify,
  },
  data() {
    return {
      url: "notifications",
      headers: [
        {
          text: "Titre",
          align: "start",
          value: "sujet",
        },
        {
          text: "Message",
          align: "start",
          value: "message",
        },
        {
          text: "Notification envoyées",
          align: "start",
          value: "nombre_done",
        },
      ],
      date: new Date().toISOString().substr(0, 7),
      modal: false,
      validationErrors: null,
      notifications: [],
      notification: {
        id: null,
        sujet: null,
        message: null,
      },
      edit: false,
      enable_submit: true,
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch() {
      let params = {};
      if (this.date) {
        params["date"] = this.date;
      }
      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            this.notifications = response.data.data;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    filtreNotation() {
      this.$refs.dialog.save(this.date);
      this.fetch();
    },
    deleteNotification(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de supprimer cette enregistrement.",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Oui !",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .post(this.url + "/" + id, { _method: "DELETE" })
                .then((response) => {
                  swal.fire(
                    "Supprimé !",
                    "La suppression a été effectuée avec succés",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    saveNotification() {
      this.enable_submit = false;

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      $.each(this.notification, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post(this.url, formData, config)
        .then((response) => {
          this.enable_submit = true;
          this.clearForm();
          $("#modal_form_notification").modal("toggle");
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    addNotification() {
      this.clearForm();
      this.validationErrors = null;
    },
    editNotification(notification) {
      $("#modal_form_notification").modal("toggle");
      this.validationErrors = null;
      this.edit = true;
      $.each(
        this.notification,
        function (key, value) {
          this.notification[key] = notification[key];
        }.bind(this)
      );
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.notification,
        function (key, value) {
          this.notification[key] = null;
        }.bind(this)
      );
    },
    onImageChange(e) {
      this.notification.image = e[0];
    },
  },
};
</script>
