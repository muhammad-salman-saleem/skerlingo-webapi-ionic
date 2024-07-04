<template>
  <div>
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">B2B Meeting</h5>
          <!--end::Title-->
          <!--begin::Separator-->
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
          <ul
            class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 mr-3 font-size-sm"
          >
            <li class="breadcrumb-item">
              <router-link to="/meetings" class="text-muted">b2b meetings</router-link>
            </li>
          </ul>
          <!--end::Separator-->
          <!--begin::Search Form-->
          <div class="d-flex align-items-center" id="kt_subheader_search" v-if="meeting">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">#{{meeting.id}}</span>
          </div>
          <!--end::Search Form-->
        </div>
        <!--end::Details-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid" v-if="meeting">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
          <div class="col-xl-5">
            <!--begin::Card-->
            <div class="card card-custom gutter-b" v-if="$auth.user()['role_id'] == 1">
              <div class="card-body">
                <div class="d-flex">
                  <!--begin::Pic-->
                  <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-80 symbol-light-success mr-2">
                      <img v-bind:src="meeting.importer_image" alt />
                    </div>
                  </div>
                  <!--end::Pic-->
                  <!--begin: Info-->
                  <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                      <!--begin::User-->
                      <div class="mr-3">
                        <div class="d-flex align-items-center mr-3">
                          <!--begin::Name-->
                          <a
                            href="#"
                            class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"
                          >{{meeting.importer_label}}</a>
                          <!--end::Name-->
                        </div>
                        <!--begin::Contacts-->
                        <div class="my-2">
                          <a
                            href="#"
                            class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"
                          >
                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                              <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
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
                                    d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z"
                                    fill="#000000"
                                    opacity="0.3"
                                  />
                                  <path
                                    d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
                                    fill="#000000"
                                  />
                                </g>
                              </svg>
                              <!--end::Svg Icon-->
                            </span>
                            {{meeting.importer_company}}
                          </a>
                          <br />
                          <a
                            href="#"
                            class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2 mt-2"
                          >
                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                              <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
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
                                    d="M8.43296491,7.17429118 L9.40782327,7.85689436 C9.49616631,7.91875282 9.56214077,8.00751728 9.5959027,8.10994332 C9.68235021,8.37220548 9.53982427,8.65489052 9.27756211,8.74133803 L5.89079566,9.85769242 C5.84469033,9.87288977 5.79661753,9.8812917 5.74809064,9.88263369 C5.4720538,9.8902674 5.24209339,9.67268366 5.23445968,9.39664682 L5.13610134,5.83998177 C5.13313425,5.73269078 5.16477113,5.62729274 5.22633424,5.53937151 C5.384723,5.31316892 5.69649589,5.25819495 5.92269848,5.4165837 L6.72910242,5.98123382 C8.16546398,4.72182424 10.0239806,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 L6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C10.6885336,6 9.44767246,6.42282109 8.43296491,7.17429118 Z"
                                    fill="#000000"
                                    fill-rule="nonzero"
                                  />
                                </g>
                              </svg>
                              <!--end::Svg Icon-->
                            </span>
                            {{meeting.subscriptions_count}} Subscribers
                          </a>
                          <br />
                          <a
                            href="#"
                            class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2 mt-2"
                          >
                            <b>FROM :</b>
                            {{meeting.date_debut}}
                          </a>
                          <br />
                          <a
                            href="#"
                            class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2 mt-2"
                          >
                            <b>TO :</b>
                            {{meeting.date_fin}}
                          </a>
                        </div>
                        <!--end::Contacts-->
                      </div>
                      <!--begin::User-->
                    </div>
                    <!--end::Title-->
                  </div>
                  <!--end::Info-->
                </div>
              </div>
            </div>
            <!--end::Card-->
          </div>
          <div class="col-xl-7">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
              <!--begin::Header-->
              <div class="card-header align-items-center px-4 py-3">
                <div class="text-left flex-grow-1" style="width: 66%;">
                  <div class="text-dark-75 w-70 font-weight-bold font-size-h5 mb-2">
                    {{ meeting.sujet }}
                    <span
                      v-if="!meeting.published"
                      class="label label-danger label-inline font-weight-lighter mr-2"
                    >UNPUBLISHED</span>
                    <span
                      v-if="meeting.published"
                      class="label label-primary label-inline font-weight-lighter mr-2"
                    >PUBLISHED</span>
                  </div>
                </div>

                <div class="text-right flex-grow-1" v-if="meeting">
                  <!--begin::Dropdown Menu-->
                  <div class="dropdown dropdown-inline">
                    <button
                      type="button"
                      class="btn btn-clean btn-sm btn-icon-md"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      Actions
                      <i class="ml-2 ki ki-bold-more-hor icon-md"></i>
                    </button>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md">
                      <!--begin::Navigation-->
                      <ul class="navi navi-hover py-5 pl-0">
                        <li class="navi-item" v-if="!meeting.published">
                          <a @click="publier_meeting()" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-share"></i>
                            </span>
                            <span class="navi-text">Publier sur le site</span>
                          </a>
                        </li>
                        <li class="navi-item" v-if="meeting.published">
                          <a @click="retirer_meeting()" class="navi-link">
                            <span class="navi-icon">
                              <i class="flaticon-circle"></i>
                            </span>
                            <span class="navi-text">Retirer de la plateforme</span>
                          </a>
                        </li>
                      </ul>
                      <!--end::Navigation-->
                    </div>
                  </div>
                  <!--end::Dropdown Menu-->
                </div>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body" v-html="meeting.message"></div>
              <!--end::Body-->
            </div>
            <!--end::Card-->
          </div>
        </div>
        <!--end::Row-->

        <!--begin::Card-->
        <div class="card card-custom">
          <!--begin::Header-->
          <div class="card-header h-auto py-4">
            <div class="card-title">
              <h3 class="card-label">Subscribers</h3>
            </div>
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
              <form class="ml-5">
                <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                  <input
                    type="text"
                    v-model="search"
                    class="form-control"
                    placeholder="Recherche..."
                  />
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
            <!--end::Toolbar-->
          </div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body p-0">
            <v-card style="box-shadow: none;">
              <v-data-table class="table" :headers="headers" :items="inscriptions" :search="search">
                <template v-slot:item.entreprise_label="{ item }">
                  <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-50 symbol-light-success mr-2">
                      <img v-bind:src="item.entreprise_image" alt />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1">
                      <a
                        href="#"
                        class="text-dark text-hover-primary font-size-sm font-weight-bold"
                      >{{item.entreprise_label}}</a>
                    </div>
                    <!--end::Text-->
                  </div>
                </template>
                <template v-slot:item.label="{ item }">
                  <span class="font-weight-bold">{{ item.label }}</span>
                </template>
                <template v-slot:item.statut_label="{ item }">
                  <span class="label label-warning label-inline font-weight-lighter mb-1">PENDING</span>
                </template>
              </v-data-table>
            </v-card>
          </div>
          <!--end::Body-->
        </div>
        <!--end::Card-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "meetings/" + this.$route.params.id,
      search: "",
      headers: [
        {
          text: "Exportateur",
          align: "middle",
          value: "entreprise_label",
        },
        {
          text: "Subscription date",
          align: "middle",
          value: "date",
        },
        {
          text: "Subscription status",
          align: "middle",
          value: "statut_label",
        },
      ],
      search: "",
      validationErrors: null,
      meeting: [],
      trakings: [],
      entreprises: [],
      inscriptions: [],
      meeting: null,
      traking: {
        id: null,
        meeting_id: null,
        entite_id: null,
        commentaire: null,
      },
      edit: false,
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch() {
      axios
        .get(this.url)
        .then(
          function (response) {
            this.meeting = response.data.meeting;
            this.trakings = response.data.trakings;
            this.entreprises = response.data.entreprises;
            this.inscriptions = response.data.inscriptions;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    publier_meeting() {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de publier ce b2b Meeting sur le site !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Publier",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.meeting.id;
              params["publish"] = true;
              axios
                .post("meetings/published", params)
                .then((response) => {
                  swal.fire(
                    "Le b2b meeting est maintenant publié sur le site.",
                    "",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    retirer_meeting() {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de retirer ce b2b meeting de la plateforme !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Retirer",
        })
        .then(
          function (result) {
            if (result.value) {
              let params = {};
              params["id"] = this.meeting.id;
              axios
                .post("meetings/published", params)
                .then((response) => {
                  swal.fire(
                    "Le b2b meeting à été retiré de la plateforme.",
                    "",
                    "success"
                  );
                  this.fetch();
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
    trakingForm() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      this.traking.meeting_id = this.meeting.id;

      let formData = new FormData();
      $.each(this.traking, function (key, value) {
        formData.append(key, value);
      });

      axios
        .post("meetings/traking_form", formData, config)
        .then((response) => {
          this.clearForm();
          this.fetch();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }
        });
    },
    clearForm() {
      this.edit = false;
      $.each(
        this.traking,
        function (key, value) {
          this.traking[key] = null;
        }.bind(this)
      );
    },
    deleteEntite(id) {
      swal
        .fire({
          title: "Êtes-vous sûr ?",
          text: "Vous êtes sur le point de désaffecter cette entité !",
          type: "question",
          showCancelButton: true,
          confirmButtonText: "Désaffecter",
          cancelButtonText: "Annuler",
        })
        .then(
          function (result) {
            if (result.value) {
              axios
                .get("meetings/delete_entite/" + id)
                .then((response) => {
                  this.fetch();
                  swal.fire(
                    "Entité désaffectée !",
                    "L'entité a été désaffectée avec succés.",
                    "success"
                  );
                })
                .catch((error) => console.log(error));
            }
          }.bind(this)
        );
    },
  },
};
</script>
