<template>
  <div>
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ page_title }}</h5>
          <!--end::Page Title-->
          <!--begin::Actions-->
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{rfqs.length}} rfqs</span>
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
          <!--end::Actions-->
        </div>
        <!--end::Info-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center" v-if="$auth.user()['role_id'] == 3">
          <a
            target="_blank"
            :href="url_website+'/requests/new-rfq'"
            class="btn btn-fast-blue btn-pill px-5"
          >
            <i class="ki ki-plus icon-1x text-white"></i> Add a new RFQ
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
                  <label>Période</label>
                  <a
                    href="#"
                    style="padding: 11px 20px; background-color: #ebedf3;"
                    class="btn btn-sm btn-light font-weight-bold d-block"
                    id="kt_dashboard_daterangepicker"
                    data-toggle="tooltip"
                    title="Select dashboard daterange"
                    data-placement="left"
                  >
                    <span
                      class="text-dark font-size-base"
                      id="kt_dashboard_daterangepicker_title"
                    >Today</span>
                    <span
                      class="text-dark font-size-base"
                      id="kt_dashboard_daterangepicker_date"
                    >Aug 16</span>
                  </a>
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

        <div class="row" v-if="$auth.user()['role_id'] == 3">
          <div class="col-md" v-bind:class="{ 'pb-0': !$route.query.product }">
            <router-link to="/rfqs" v-bind:class="{ 'active': !$route.query.product }">
              <div
                class="card card-custom bgi-no-repeat card-stretch bg-slate-blue py-4"
                style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;"
              >
                <i
                  class="fas fa-paper-plane d-block text-white"
                  style="font-size: 14rem; position: absolute; bottom: 0; left: 3px; line-height: 1; opacity: .1;"
                ></i>
                <div class="card-body text-center">
                  <i
                    class="fas fa-paper-plane d-block text-white"
                    style="font-size: 5rem; line-height: 1;"
                  ></i>
                  <span
                    class="font-weight-500 text-white font-size-h6 text-uppercase mt-5 d-block"
                  >RFQ Direct</span>
                </div>
              </div>
            </router-link>
          </div>
          <div class="col-md" v-bind:class="{ 'pb-0': $route.query.product }">
            <router-link to="/rfqs?product=p" v-bind:class="{ 'active': $route.query.product }">
              <div
                class="card card-custom bgi-no-repeat card-stretch bg-slate-blue py-4"
                style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;"
              >
                <i
                  class="flaticon-shopping-basket d-block text-white"
                  style="font-size: 14rem; position: absolute; bottom: 0; left: 3px; line-height: 1; opacity: .1;"
                ></i>
                <div class="card-body text-center">
                  <i
                    class="flaticon-shopping-basket d-block text-white"
                    style="font-size: 5rem; line-height: 1;"
                  ></i>
                  <span
                    class="font-weight-bolder text-white font-size-h6 text-uppercase mt-5 d-block"
                  >RFQ from skerlingo catalog</span>
                </div>
              </div>
            </router-link>
          </div>
        </div>

        <div class="card card-custom gutter-b">
          <div class="card-header card-header-nob">
            <div class="card-title">
              <h3 class="card-label">{{ page_title }}</h3>

              <ul
                v-if="$auth.user()['role_id'] == 3 && false"
                class="nav nav-pills pl-0"
                id="myTab1"
                role="tablist"
              >
                <li class="nav-item">
                  <router-link
                    to="/rfqs"
                    class="nav-link"
                    v-bind:class="{ 'active': !$route.query.product }"
                    id="home-tab-1"
                    data-toggle="tab"
                    href="#direct-1"
                  >
                    <span class="nav-icon">
                      <i class="flaticon-notes"></i>
                    </span>
                    <span class="nav-text">RFQ Direct</span>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link
                    to="/rfqs?product=p"
                    class="nav-link"
                    v-bind:class="{ 'active': $route.query.product }"
                    id="home-tab-1"
                    data-toggle="tab"
                    href="#product-1"
                  >
                    <span class="nav-icon">
                      <i class="flaticon2-open-box"></i>
                    </span>
                    <span class="nav-text">RFQ from skerlingo catalog</span>
                  </router-link>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body p-5 pt-0">
            <v-card style="box-shadow: none;">
              <v-data-table class="table" :headers="_headers" :items="rfqs" :search="search">
                <template v-slot:item.importer_label="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
                    class="text-dark font-size-sm font-weight-bold"
                  >
                    <div class="d-flex align-items-center">
                      <!--begin::Symbol-->
                      <div class="symbol symbol-40 symbol-light-success mr-2">
                        <img
                          v-if="item.importer_pays_flag"
                          v-bind:src="item.importer_pays_flag"
                          alt
                        />
                      </div>
                      <!--end::Symbol-->
                      <!--begin::Text-->
                      <div class="d-flex flex-column flex-grow-1">
                        <span
                          class="text-dark font-size-sm font-weight-bold"
                        >{{item.importer_label}}</span>
                        <span
                          class="text-muted font-size-xs"
                        >{{ item.importer_company }} - {{ item.importer_pays_label }}</span>
                      </div>
                      <!--end::Text-->
                    </div>
                  </router-link>
                </template>
                <template v-slot:item.importer_company="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
                    class="text-dark font-size-sm font-weight-bold"
                  >
                    <span class="font-size-sm">{{ item.importer_company }}</span>
                  </router-link>
                </template>
                <template v-slot:item.importer_pays_label="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
                    class="text-dark font-size-sm font-weight-bold"
                  >
                    <div class="d-flex align-items-center">
                      <!--begin::Symbol-->
                      <div class="symbol symbol-30 symbol-light-success mr-2">
                        <img
                          v-if="item.importer_pays_flag"
                          v-bind:src="item.importer_pays_flag"
                          alt
                        />
                      </div>
                      <!--end::Symbol-->
                      <!--begin::Text-->
                      <div class="d-flex flex-column flex-grow-1">
                        <span
                          class="text-dark font-size-sm font-weight-bold"
                        >{{item.importer_pays_label}}</span>
                      </div>
                      <!--end::Text-->
                    </div>
                  </router-link>
                </template>
                <template v-slot:item.produit_label="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
                    class="text-dark font-size-sm font-weight-bold"
                  >
                    <div class="d-flex align-items-center">
                      <!--begin::Symbol-->
                      <div class="symbol symbol-50 symbol-light-success mr-2">
                        <img v-bind:src="item.produit_image" alt />
                      </div>
                      <!--end::Symbol-->
                      <!--begin::Text-->
                      <div class="d-flex flex-column flex-grow-1">
                        <span class="text-dark font-size-sm font-weight-bold">{{item.produit_label}}</span>
                        <span class="text-muted font-size-sm">{{item.entreprise_label}}</span>
                      </div>
                      <!--end::Text-->
                    </div>
                  </router-link>
                </template>
                <template v-slot:item.secteur_label="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
                    class="text-dark font-size-sm font-weight-bold"
                  >
                    <div class="d-flex align-items-center">
                      <!--begin::Symbol-->
                      <div class="symbol symbol-30 symbol-light-success mr-2">
                        <img v-bind:src="item.secteur_image" alt />
                      </div>
                      <!--end::Symbol-->
                      <!--begin::Text-->
                      <div class="d-flex flex-column flex-grow-1">
                        <a
                          href="#"
                          class="text-dark font-size-sm font-weight-bold"
                        >{{item.secteur_label}}</a>
                      </div>
                      <!--end::Text-->
                    </div>
                  </router-link>
                </template>
                <template v-slot:item.published="{ item }">
                  <span
                    class="label label-inline font-weight-normal"
                    v-bind:style="{
                                color: '#fff',
                                'background-color':
                                'rgb(' + item.statut_color + ')'
                              }"
                  >{{ item.statut_label }}</span>
                </template>
                <template v-slot:item.closed="{ item }">
                  <span
                    v-if="!item.closed"
                    style="background-color: #006266"
                    class="label label-warning label-inline font-weight-lighter mr-1"
                  >Ouverte</span>
                  <span
                    v-if="item.closed"
                    style="background-color: #1B1464"
                    class="label label-dark label-inline font-weight-lighter mr-1"
                  >Clôturée</span>
                </template>
                <template v-slot:item.sujet="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
                    class="text-dark font-size-sm font-weight-bold"
                  >
                    <span class="d-block font-size-sm">{{ item.sujet }}</span>
                  </router-link>
                </template>
                <template v-slot:item.date="{ item }">
                  <span class="d-block font-roboto">{{ item.date }}</span>
                </template>

                <template v-slot:item.actions="{ item }">
                  <router-link
                    :to="{ name: 'rfq_item', params: { id: item.id } }"
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
              </v-data-table>
            </v-card>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "rfqs",
      url_website: `${process.env.MIX_APP_URL}`,
      search: "",
      page_title: "",
      searchItem: null,
      headers: [
        {
          text: "Importateur",
          align: "middle",
          value: "importer_label",
          hide: this.$auth.user()["role_id"] != 1,
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "Product" : "Produit",
          align: "middle",
          value: "produit_label",
          hide: !this.$route.query.product,
        },
        {
          text: "Nom & Prénom",
          align: "middle",
          value: "importer_company",
          hide: this.$auth.user()["role_id"] != 2 || this.$route.query.product,
        },
        {
          text: "Nom entreprise",
          align: "middle",
          value: "importer_company",
          hide: this.$auth.user()["role_id"] != 2 || !this.$route.query.product,
        },
        {
          text: "Pays",
          align: "middle",
          value: "importer_pays_label",
          hide: this.$auth.user()["role_id"] != 2,
        },
        {
          text: "Sector",
          align: "middle",
          value: "secteur_label",
          hide: this.$route.query.product || true,
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "Subject" : "Sujet",
          align: "middle",
          value: "sujet",
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "Status" : "Statut",
          align: "middle",
          value: "published",
          hide: this.$auth.user()["role_id"] == 2,
        },
        {
          text: this.$auth.user()["role_id"] == 3 ? "State" : "Etat",
          align: "middle",
          value: "closed",
          hide: this.$auth.user()["role_id"] == 2 || this.$route.query.product,
        },
        { text: "Date", align: "middle", value: "date" },
        { text: "", align: "right", value: "actions", sortable: false },
      ],
      validationErrors: null,
      rfqs: [],
      villes: [],
      partenaires: [],
      clients: [],
      statuts: [],
      filter: {
        date:
          moment().startOf("year").format("Y-MM-DD") +
          " - " +
          moment().endOf("year").format("Y-MM-DD"),
        rfq_product: null,
        statut: null,
        partenaire: null,
      },
      quartier: {
        id: null,
        ville_id: null,
        label: null,
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
    if (this.$route.query.statut) {
      this.filter.statut = parseInt(this.$route.query.statut);
    }

    this.fetch();
  },
  mounted() {
    this.daterangepickerInit();
  },
  methods: {
    fetch() {
      if (this.$auth.user()["role_id"] == 3) {
        if (this.$route.query.product) {
          this.filter.rfq_product = true;
        }
        this.page_title = "My Requests for Quotation";
      } else if (this.$route.query.product) {
        this.filter.rfq_product = true;
        if (this.$auth.user()["role_id"] == 2) {
          this.page_title = "RFQ - From your Catalog";
        } else {
          this.page_title = "Product/service requests";
        }
      } else {
        if (this.$auth.user()["role_id"] == 2) {
          this.page_title = "RFQ - From skerlingo";
        } else {
          this.page_title = "Direct requests";
        }
      }

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
            this.rfqs = response.data.rfqs;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    deleteRfq(id) {
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
    cb(start, end, label) {
      var title = "";
      var range = "";
      var input = "";

      if (end - start < 100 || label == "Aujourd'hui") {
        title = "Aujourd'hui :";
        range = start.format("D MMM Y");
        input = start.format("Y-MM-DD") + " - " + start.format("Y-MM-DD");
      } else if (label == "Hier") {
        title = "Hier :";
        range = start.format("D MMM Y");
        input = start.format("Y-MM-DD") + " - " + start.format("Y-MM-DD");
      } else {
        range = start.format("D MMM Y") + " - " + end.format("D MMM Y");
        input = start.format("Y-MM-DD") + " - " + end.format("Y-MM-DD");
      }

      $("#kt_dashboard_daterangepicker_date").html(range);
      $("#kt_dashboard_daterangepicker_title").html(title);
      $("#kt_dashboard_daterangepicker_input").val(input);

      this.filter.date = input;
    },
    daterangepickerInit() {
      if ($("#kt_dashboard_daterangepicker").length == 0) {
        return;
      }

      var picker = $("#kt_dashboard_daterangepicker");
      var start = moment().startOf("year");
      var end = moment().endOf("year");

      picker.daterangepicker(
        {
          direction: KTUtil.isRTL(),
          startDate: start,
          endDate: end,
          opens: "left",
          ranges: {
            "Aujourd'hui": [moment(), moment()],
            Hier: [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Derniers 7 jours": [moment().subtract(6, "days"), moment()],
            "Derniers 30 jours": [moment().subtract(29, "days"), moment()],
            "Ce mois": [moment().startOf("month"), moment().endOf("month")],
            "Mois précédent": [
              moment().subtract(1, "month").startOf("month"),
              moment().subtract(1, "month").endOf("month"),
            ],
            "Cette année": [moment().startOf("year"), moment().endOf("year")],
          },
        },
        this.cb
      );
      this.cb(start, end, "");
    },
  },
};
</script>
