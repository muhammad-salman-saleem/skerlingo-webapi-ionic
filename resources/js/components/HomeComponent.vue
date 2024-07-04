<template>
  <div class="home-dash" v-if="false">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div
        class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"
      >
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Page Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tableau de bord</h5>
          <!--end::Page Title-->
          <!--begin::Actions-->
          <!--end::Actions-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flexs align-items-center d-none">
          <!--begin::Actions-->
          <!--end::Actions-->
          <span class="btn btn-clean btn-sm font-size-base mr-1">Filtre par période :</span>
          <!--begin::Daterange-->
          <a
            href="#"
            class="btn btn-sm btn-light font-weight-bold mr-2"
            id="kt_dashboard_daterangepicker"
            data-toggle="tooltip"
            title="Select dashboard daterange"
            data-placement="left"
          >
            <span
              class="text-muted font-size-base font-weight-bold mr-2"
              id="kt_dashboard_daterangepicker_title"
            >Today</span>
            <span
              class="text-primary font-size-base font-weight-bolder"
              id="kt_dashboard_daterangepicker_date"
            >Aug 16</span>
          </a>
          <!--end::Daterange-->
        </div>
        <!--end::Toolbar-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid" v-if="$auth.user() && $auth.user()['role_id'] == 1">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Dashboard-->

        <!--begin::Row-->
        <div class="row">
          <div
            class="col-sm-6 col-md"
            v-for="top_statistic in top_statistics"
            v-bind:key="top_statistic"
          >
            <router-link :to="top_statistic.link">
              <div class="card card-custom bgi-no-repeat card-stretch">
                <div class="card-body text-center">
                  <span
                    class="card-title font-weight-bolder text-fast-blue mb-0 mt-0 d-block"
                    style="font-size: 4rem !important; line-height: 4rem;"
                  >{{ top_statistic.count }}</span>
                  <span
                    class="font-weight-bold text-slate-blue font-size-h6 text-uppercase"
                  >{{ top_statistic.label }}</span>
                </div>
              </div>
            </router-link>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md" v-for="chart in progress_charts" v-bind:key="chart">
            <div class="card card-custom">
              <div class="card-body py-4">
                <p class="mb-5 text-dark font-weight-bold">
                  {{ chart.label }}
                  <span
                    class="text-dark font-roboto"
                    style="float: right;"
                  >{{ chart.pct }}%</span>
                </p>
                <div class="progress h-20px" style="border-radius: 20px;">
                  <div
                    :class="'progress-bar ' +chart.bg"
                    role="progressbar"
                    v-bind:style="{'width':chart.pct + '%' }"
                    aria-valuenow="75"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  >
                    <span class="font-size-md">{{ chart.pct }} %</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-if="all_statistics.length > 0">
          <hr style="border-top: 4px solid rgb(0 0 0 / 48%);border-radius: 19px;" class="mb-5" />
          <h5 class="text-dark font-weight-bold font-size-h6 font-roboto">KPI :</h5>
        </div>
        <div class="row">
          <div
            class="col-sm-6 col-md"
            v-for="all_statistic in all_statistics"
            v-bind:key="all_statistic"
          >
            <div class="card card-custom bgi-no-repeat card-stretch">
              <div class="card-body px-0 py-4 text-center">
                <span
                  class="card-title font-weight-bolder text-slate-blue mb-0 mt-0 d-block"
                  style="font-size: 2.5rem !important; line-height: 2.5rem;"
                >{{ all_statistic.count }}</span>
                <span
                  class="font-weight-500 text-dark font-size-sm text-uppercase"
                >{{ all_statistic.label }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row" v-if="all_statistics.length > 0">
          <div class="col-sm-6 col-md">
            <div class="card card-custom">
              <div class="card-header" style="min-height: 53px;">
                <div class="card-title">
                  <h3 class="card-label text-slate-blue font-weight-bolder">Top Products requested</h3>
                </div>
              </div>
              <div class="card-body">
                <div
                  v-for="product in top_products"
                  v-bind:key="product.id"
                  class="d-flex align-items-center mb-5"
                >
                  <!--begin::Symbol-->
                  <div class="symbol symbol-40 symbol-light-success mr-3">
                    <span class="symbol-label">
                      <img
                        style="border-radius: 0.42rem;"
                        v-bind:src="product.image_url"
                        class="h-100 align-self-center"
                        alt
                      />
                    </span>
                  </div>
                  <!--end::Symbol-->
                  <!--begin::Text-->
                  <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                    <span class="d-block text-dark font-size-sm">{{ product.label }}</span>
                    <span class="text-muted font-size-xs">{{ product.entreprise_label }}</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div
                    class="ml-2 font-weight-bolder font-size-h5 text-dark"
                  >{{ product.rfqs_count }}</div>
                  <!--end::Dropdown-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md">
            <div class="card card-custom">
              <div class="card-header" style="min-height: 53px;">
                <div class="card-title">
                  <h3 class="card-label text-slate-blue font-weight-bolder">Top Companies contacted</h3>
                </div>
              </div>
              <div class="card-body">
                <div
                  v-for="entreprise in top_entreprises"
                  v-bind:key="entreprise.id"
                  class="d-flex align-items-center mb-5"
                >
                  <!--begin::Symbol-->
                  <div class="symbol symbol-40 symbol-light-success mr-3">
                    <span class="symbol-label">
                      <img
                        style="border-radius: 0.42rem;"
                        v-bind:src="entreprise.image_url"
                        class="h-100 align-self-center"
                        alt
                      />
                    </span>
                  </div>
                  <!--end::Symbol-->
                  <!--begin::Text-->
                  <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                    <span class="d-block text-dark font-size-sm">{{ entreprise.label }}</span>
                    <span class="text-muted font-size-xs">{{ entreprise.secteur_label }}</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div
                    class="ml-2 font-weight-bolder font-size-h5 text-dark"
                  >{{ entreprise.product_rfqs_count }}</div>
                  <!--end::Dropdown-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md">
            <div class="card card-custom">
              <div class="card-header" style="min-height: 53px;">
                <div class="card-title">
                  <h3 class="card-label text-slate-blue font-weight-bolder">Top 5 sectors</h3>
                </div>
              </div>
              <div class="card-body">
                <div
                  v-for="secteur in top_secteurs"
                  v-bind:key="secteur.id"
                  class="d-flex align-items-center mb-5"
                >
                  <!--begin::Symbol-->
                  <div class="symbol symbol-40 symbol-light-success mr-3">
                    <span class="symbol-label">
                      <img
                        style="border-radius: 0.42rem;"
                        v-bind:src="secteur.image_url"
                        class="h-100 align-self-center"
                        alt
                      />
                    </span>
                  </div>
                  <!--end::Symbol-->
                  <!--begin::Text-->
                  <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                    <span class="d-block text-dark font-size-sm">{{ secteur.label }}</span>
                  </div>
                  <!--end::Text-->
                  <!--begin::Dropdown-->
                  <div
                    class="ml-2 font-weight-bolder font-size-h5 text-dark"
                  >{{ secteur.rfqs_count }}</div>
                  <!--end::Dropdown-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end::Row-->
        <!--end::Dashboard-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->

    <div class="d-flex flex-column-fluid" v-if="$auth.user() && $auth.user()['role_id'] == 3">
      <!--begin::Container-->
      <div class="container-fluid"></div>
    </div>

    <div class="d-flex flex-column-fluid" v-if="$auth.user() && $auth.user()['role_id'] == 2">
      <!--begin::Container-->
      <div class="container-fluid"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      date:
        new Date().toISOString().substr(0, 10) +
        " - " +
        new Date().toISOString().substr(0, 10),
      top_statistics: [],
      all_statistics: [],
      top_products: [],
      top_entreprises: [],
      top_secteurs: [],
      progress_charts: [],
      rfqs: [],
      url: "dashboard",
    };
  },
  created() {
    //this.fetch();
  },
  mounted() {
    this.$router.push({ path: "/lecons" });
    if (this.$auth.user()["role_id"] == 2)
      this.$router.push({ path: "/rfqs?product=p" });
    if (this.$auth.user()["role_id"] == 3) this.$router.push({ path: "/rfqs" });
    //this.$auth.logout();
    console.log("Component mounted.");
    this.daterangepickerInit();
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
            this.top_statistics = response.data.top_statistics;
            this.all_statistics = response.data.all_statistics;
            this.top_products = response.data.top_products;
            this.top_entreprises = response.data.top_entreprises;
            this.top_secteurs = response.data.top_secteurs;
            this.progress_charts = response.data.progress_charts;
            this.rfqs = response.data.rfqs;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    actualiteDetails(actualite) {
      this.actualite_item = actualite;
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

      this.date = input;
      this.fetch();
    },
    daterangepickerInit() {
      if ($("#kt_dashboard_daterangepicker").length == 0) {
        return;
      }

      var picker = $("#kt_dashboard_daterangepicker");
      var start = moment().subtract(6, "days");
      var end = moment();

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
