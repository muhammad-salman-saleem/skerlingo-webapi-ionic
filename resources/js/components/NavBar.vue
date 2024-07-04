<template>
  <!--begin::Header-->
  <div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
      <!--begin::Header Menu Wrapper-->
      <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        <!--begin::Header Menu-->
        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default"></div>
        <!--end::Header Menu-->
      </div>
      <!--end::Header Menu Wrapper-->
      <!--begin::Topbar-->
      <div class="topbar">
        <div class="topbar-item">
          <a
            :href="url_website"
            style="color: #3699FF; background-color: #F3F6F9; border-color: transparent;"
            target="_blank"
            class="btn btn-clean btn-dropdown btn-sm font-weight-bold mr-1"
          >
            <span class="svg-icon svg-icon-xl svg-icon-primary">
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
                    d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                    fill="#000000"
                    fill-rule="nonzero"
                  />
                  <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                </g>
              </svg>
            </span> Aller à skerlingo.ma
          </a>
        </div>
        <!--begin::User-->
        <div class="topbar-item" v-if="$auth.check()">
          <div
            class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
            id="kt_quick_user_toggle"
          >
            <span class="text-dark-50 font-weight-500 font-size-base d-none d-md-inline mr-3">
              {{
              $auth.user()["prenom"]
              }}
            </span>
            <span class="symbol symbol-lg-30 symbol-25 symbol-circle symbol-light-success">
              <img alt="Pic" :src="$auth.user()['image_url']" />
            </span>
          </div>
        </div>
        <!--end::User-->
      </div>
      <!--end::Topbar-->
    </div>
    <!--end::Container-->

    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
      <!--begin::Header-->
      <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">My account</h3>
        <a
          href="#"
          class="btn btn-xs btn-icon btn-light btn-hover-primary"
          id="kt_quick_user_close"
        >
          <i class="ki ki-close icon-xs text-muted"></i>
        </a>
      </div>
      <!--end::Header-->
      <!--begin::Content-->
      <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5" v-if="$auth.check()">
          <div class="symbol symbol-100 mr-5">
            <div
              class="symbol-label"
              v-bind:style="{ 'background-image': 'url(' + $auth.user()['image_url'] + ')' }"
            ></div>
            <i class="symbol-badge bg-success"></i>
          </div>
          <div class="d-flex flex-column">
            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
              {{
              $auth.user()["prenom"] +
              " " +
              $auth.user()["nom"]
              }}
            </a>
            <div class="navi mt-2">
              <a href="#" class="navi-item">
                <span class="navi-link p-0 pb-2">
                  <span class="navi-icon mr-1">
                    <span class="svg-icon svg-icon-lg svg-icon-primary">
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
                            d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                            fill="#000000"
                          />
                          <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </span>
                  <span class="navi-text text-muted text-hover-primary">{{ $auth.user()["email"]}}</span>
                </span>
              </a>
              <button
                @click.prevent="log_out()"
                class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
              >Logout</button>
            </div>
          </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
          <!--begin::Item-->

          <router-link to="/profile" class="navi-item d-none">
            <div class="navi-link">
              <div class="symbol symbol-40 bg-light mr-3">
                <div class="symbol-label">
                  <span class="svg-icon svg-icon-md svg-icon-success">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                    <i class="flaticon2-user-1"></i>
                    <!--end::Svg Icon-->
                  </span>
                </div>
              </div>
              <div class="navi-text">
                <div class="font-weight-bold">Edit my profile</div>
                <div class="text-muted">Edit my profile</div>
              </div>
            </div>
          </router-link>
          <!--end:Item-->
          <!--begin::Item-->
          <router-link to="/profile?password=password" class="navi-item d-none">
            <div class="navi-link">
              <div class="symbol symbol-40 bg-light mr-3">
                <div class="symbol-label">
                  <span class="svg-icon svg-icon-md svg-icon-warning">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg-->
                    <i class="flaticon-cogwheel-2"></i>
                    <!--end::Svg Icon-->
                  </span>
                </div>
              </div>
              <div class="navi-text">
                <div class="font-weight-bold">Password</div>
                <div class="text-muted">Change my password</div>
              </div>
            </div>
          </router-link>
          <!--end:Item-->
        </div>
        <!--end::Nav-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-7"></div>
        <!--end::Separator-->
      </div>
      <!--end::Content-->
    </div>
    <!-- end::User Panel-->
  </div>
  <!--end::Header-->
</template>

<script>
export default {
  data() {
    return {
      open: false,
      agences: [],
      url_website: `${process.env.MIX_APP_URL}`,
      agence: null,
    };
  },
  created() {
    if (this.$auth.user()["role_id"] == 1) this.fetch();
  },
  methods: {
    setCookie(name, value, days) {
      var expires = "";
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "") + expires + "; path=/";
    },
    log_out() {
      this.$auth.logout();
      this.setCookie("auth_token_default", "", 0);
    },
    fetch() {
      let params = {};
      axios
        .get("header_admin", {
          params: params,
        })
        .then(
          function (response) {
            this.agences = response.data.agences;
            this.agence = response.data.agence;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
    change_agence(agence_id) {
      let params = {};
      params["agence_id"] = agence_id;
      axios
        .post("change_agence", params)
        .then(
          function (response) {
            window.location.href = `${process.env.MIX_APP_URL}/app`;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
  },
};
</script>
