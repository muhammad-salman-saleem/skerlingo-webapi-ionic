<template>
  <div>
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container kt-container--fluid">
        <div class="kt-subheader__main">
          <h3 class="kt-subheader__title">Statistiques</h3>
          <span class="kt-subheader__separator kt-subheader__separator--v"></span>
          <div class="kt-subheader__group" id="kt_subheader_search">
            <span class="kt-subheader__desc" id="kt_subheader_total"></span>
          </div>
        </div>

        <div class="kt-subheader__toolbar">
          <div class="kt-subheader__wrapper">
            <a
              href="#"
              class="btn kt-subheader__btn-daterange"
              id="kt_dashboard_daterangepicker"
              data-toggle="kt-tooltip"
              title="Select dashboard daterange"
              data-placement="left"
            >
              <input
                type="hidden"
                v-model="date"
                @change="fetch"
                id="kt_dashboard_daterangepicker_input"
              />
              <span
                class="kt-subheader__btn-daterange-title"
                id="kt_dashboard_daterangepicker_title"
              >Aujourd\'hui</span>&nbsp;
              <span
                class="kt-subheader__btn-daterange-date"
                id="kt_dashboard_daterangepicker_date"
              >Aug 16</span>
              <i class="flaticon2-calendar-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
      <!--Begin::Dashboard 1-->

      <!--Begin::Row-->
      <div class="row">
        <div class="col-md-8 col-lg-6 order-lg-3 order-xl-1">
          <!--begin:: Widgets/Best Sellers-->
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
              <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Les prestations les plus demandées</h3>
              </div>
            </div>
            <div class="kt-portlet__body">
              <div class="tab-content">
                <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                  <div class="kt-widget5">
                    <div
                      class="kt-widget5__item"
                      v-for="prestation in prestations"
                      v-bind:key="prestation.id"
                    >
                      <div class="kt-widget5__content">
                        <div class="kt-widget5__pic">
                          <img
                            class="kt-widget7__img"
                            style="width: 100px;;"
                            v-bind:src="
                                                            prestation.image_url
                                                        "
                            alt
                          />
                        </div>
                        <div class="kt-widget5__section">
                          <a href="#" class="kt-widget5__title">
                            {{
                            prestation.label
                            }}
                          </a>
                          <p class="kt-widget5__desc">
                            {{
                            prestation.label_categorie
                            }}
                          </p>
                        </div>
                      </div>
                      <div class="kt-widget5__content">
                        <div class="kt-widget5__stats">
                          <span class="kt-widget5__number">
                            {{
                            prestation.reservations_count
                            }}
                          </span>
                          <span class="kt-widget5__sales">réservations</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--end:: Widgets/Best Sellers-->
        </div>
        <div class="col-md-4 col-lg-6 order-lg-3 order-xl-1">
          <!--begin:: Widgets/New Users-->
          <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
            <div class="kt-portlet__head">
              <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Nombre de visites par collaborateur</h3>
              </div>
            </div>
            <div class="kt-portlet__body">
              <div class="tab-content">
                <div class="tab-pane active" id="kt_widget4_tab1_content">
                  <div class="kt-widget4">
                    <div
                      class="kt-widget4__item"
                      v-for="professeur in professeurs"
                      v-bind:key="professeur.id"
                    >
                      <div class="kt-widget4__pic kt-widget4__pic--pic">
                        <img v-bind:src="professeur.image_url" alt />
                      </div>
                      <div class="kt-widget4__info">
                        <a href="#" class="kt-widget4__username">
                          {{
                          professeur.nom +
                          " " +
                          professeur.prenom
                          }}
                        </a>
                      </div>
                      <a href="#" class="btn btn-sm btn-label-brand btn-bold">
                        {{
                        professeur.reservations_count
                        }} clients -
                        {{
                        professeur.paid_sum_count
                        }} DHS
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--end:: Widgets/New Users-->
        </div>
        <div class="col-md-4 col-lg-4 order-lg-2 order-xl-1">
          <!--begin:: Widgets/Daily Sales-->
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
              <div class="kt-widget14__header kt-margin-b-30">
                <h3 class="kt-widget14__title">Visites clients</h3>
                <span class="kt-widget14__desc">Nombre de visites de clients</span>
              </div>
              <div class="kt-widget14__chart" id="dash_visites_content" style="height:120px;">
                <canvas id="dash_visites"></canvas>
              </div>
            </div>
          </div>

          <!--end:: Widgets/Daily Sales-->
        </div>
        <div class="col-md-4 col-lg-4 order-lg-2 order-xl-1">
          <!--begin:: Widgets/Profit Share-->
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
              <div class="kt-widget14__header">
                <h3 class="kt-widget14__title">Statut réservations</h3>
                <span class="kt-widget14__desc">Taux d'annulation, de confirmation..</span>
              </div>
              <div class="kt-widget14__content">
                <div class="kt-widget14__chart" id="dash_statuts_content">
                  <div class="kt-widget14__stat">45</div>
                  <canvas id="dash_statuts" style="height: 140px; width: 140px;"></canvas>
                </div>
                <div class="kt-widget14__legends" v-if="statuts">
                  <div
                    class="kt-widget14__legend"
                    v-for="(label, index) in statuts.labels"
                    v-bind:key="label"
                  >
                    <span
                      class="kt-widget14__bullet kt-bg-success"
                      v-bind:style="{
                                                'background-color':
                                                    statuts.colors[index] +
                                                    ' !important'
                                            }"
                    ></span>
                    <span class="kt-widget14__stats">
                      {{ statuts.pcts[index] }}%
                      {{ label }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--end:: Widgets/Profit Share-->
        </div>
        <div class="col-md-4 col-lg-4 order-lg-2 order-xl-1">
          <!--begin:: Widgets/Revenue Change-->
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
              <div class="kt-widget14__header">
                <h3 class="kt-widget14__title">Fidélisation</h3>
                <span class="kt-widget14__desc">Taux de fidélisation</span>
              </div>
              <div class="kt-widget14__content">
                <div class="kt-widget14__chart" id="dash_stars_content">
                  <div id="dash_stars" style="height: 150px; width: 150px;"></div>
                </div>
                <div class="kt-widget14__legends" v-if="stars">
                  <div
                    class="kt-widget14__legend"
                    v-for="(star, index) in stars.data"
                    v-bind:key="star.label"
                  >
                    <span
                      class="kt-widget14__bullet kt-bg-success"
                      v-bind:style="{
                                                'background-color':
                                                    stars.colors[index] +
                                                    ' !important'
                                            }"
                    ></span>
                    <span class="kt-widget14__stats">
                      {{ star.value }}% :
                      {{ star.label }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--end:: Widgets/Revenue Change-->
        </div>
      </div>

      <!--End::Row-->

      <!--End::Dashboard 1-->
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.daterangepickerInit();
    //KTDashboard.init();
  },
  data() {
    return {
      date: null,
      url: "statistics",
      statuts: [],
      stars: [],
      professeurs: [],
      prestations: [],
    };
  },
  created() {
    //this.fetch();
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
            this.professeurs = response.data.professeurs;
            this.prestations = response.data.prestations;
            this.statuts = response.data.charts.statuts;
            this.stars = response.data.charts.stars;
            KTDashboard.init(response.data.charts);
          }.bind(this)
        )
        .catch((error) => console.log(error));
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
