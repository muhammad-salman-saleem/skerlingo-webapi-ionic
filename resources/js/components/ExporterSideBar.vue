<template>
  <!--begin::Aside-->
  <div
    v-if="$auth.check()"
    class="aside aside-left aside-fixed d-flex flex-column flex-row-auto"
    id="kt_aside"
  >
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
      <!--begin::Logo-->
      <a :href="url_base" class="brand-logo">
        <img style="width: 100px;;" alt="Logo" src="/../assets/media/logos/asmex_logo.png" />
      </a>
      <!--end::Logo-->
      <!--begin::Toggle-->
      <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
        <span class="svg-icon svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
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
              <path
                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                fill="#000000"
                fill-rule="nonzero"
                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"
              />
              <path
                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                fill="#000000"
                fill-rule="nonzero"
                opacity="1"
                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"
              />
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>
      </button>
      <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
      <!--begin::Menu Container-->
      <div
        id="kt_aside_menu"
        class="aside-menu my-4"
        data-menu-vertical="1"
        data-menu-scroll="1"
        data-menu-dropdown-timeout="500"
      >
        <!--begin::Menu Nav-->
        <ul class="menu-nav pb-20">
          <li class="menu-section">
            <h4 class="menu-text">RFQS</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
          </li>

          <li
            class="menu-item"
            v-bind:class="{ 'menu-item-active': $route.fullPath == '/rfqs?product=p' }"
            aria-haspopup="true"
          >
            <router-link to="/rfqs?product=p" class="menu-link">
              <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
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
                    <path
                      d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                      fill="#000000"
                      fill-rule="nonzero"
                    />
                    <path
                      d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                      fill="#000000"
                      opacity="1"
                    />
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="menu-text">RFQ - From your Catalog</span>
            </router-link>
          </li>

          <li
            class="menu-item"
            v-bind:class="{ 'menu-item-active': $route.fullPath == '/rfqs' }"
            aria-haspopup="true"
          >
            <router-link to="/rfqs" class="menu-link">
              <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
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
                    <path
                      d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                      fill="#000000"
                      fill-rule="nonzero"
                    />
                    <path
                      d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                      fill="#000000"
                      opacity="1"
                    />
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>
              <span class="menu-text">RFQ - From skerlingo</span>
            </router-link>
          </li>

          <li class="menu-section">
            <h4 class="menu-text">PRODUCTS & SERVICES</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
          </li>

          <li
            class="menu-item"
            v-bind:class="{ 'menu-item-active': $route.fullPath == '/produits' }"
            aria-haspopup="true"
          >
            <router-link to="/produits" class="menu-link">
              <span class="svg-icon menu-icon">
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
                      d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                      fill="#000000"
                    />
                    <path
                      d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                      fill="#000000"
                      opacity="1"
                    />
                  </g>
                </svg>
              </span>
              <span class="menu-text">Our products</span>
            </router-link>
          </li>

          <li class="menu-section">
            <h4 class="menu-text">COMPTE</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
          </li>

          <li
            class="menu-item"
            v-bind:class="{ 'menu-item-active': $route.fullPath == '/profile' }"
            aria-haspopup="true"
          >
            <router-link to="/profile" class="menu-link">
              <span class="svg-icon menu-icon">
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
                    <path
                      d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                      fill="#000000"
                      fill-rule="nonzero"
                      opacity="1"
                    />
                    <path
                      d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                      fill="#000000"
                      fill-rule="nonzero"
                    />
                  </g>
                </svg>
              </span>
              <span class="menu-text">My account</span>
            </router-link>
          </li>

          <li class="menu-item d-none" aria-haspopup="true">
            <router-link to="/profile?password=password" class="menu-link">
              <span class="svg-icon menu-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  width="24px"
                  height="24px"
                  viewBox="0 0 24 24"
                  version="1.1"
                >
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <mask fill="white">
                      <use xlink:href="#path-1" />
                    </mask>
                    <g />
                    <path
                      d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z"
                      fill="#000000"
                    />
                  </g>
                </svg>
              </span>
              <span class="menu-text">Change Password</span>
            </router-link>
          </li>
        </ul>
        <!--end::Menu Nav-->
      </div>
      <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
  </div>
  <!--end::Aside-->
</template>



<script>
export default {
  data() {
    return {
      url_base: `${process.env.MIX_APP_URL}/app`,
      url_website: `${process.env.MIX_APP_URL}`,
      open: false,
      agences: [],
      clients_en_attente: 0,
      professeurs_en_attente: 0,
      bl_en_attente_arrives: 0,
      bl_en_attente_ramassage: 0,
    };
  },
  created() {
    this.$root.$refs.AdminSideBar = this;
    if (this.$auth.user()["role_id"] == 1 && false) this.fetch();
  },
  mounted() {
    KTLayoutAsideMenu.init("kt_aside_menu");
    KTLayoutAsideToggle.init("kt_aside_toggle");
    KTLayoutHeaderMenu.init("kt_header_menu", "kt_header_menu_wrapper");
    KTLayoutQuickUser.init("kt_quick_user");
    KTLayoutAside.init("kt_aside");
  },
  methods: {
    fetch() {
      let params = {};
      axios
        .get("menu_admin", {
          params: params,
        })
        .then(
          function (response) {
            this.clients_en_attente = response.data.clients_en_attente;
            this.professeurs_en_attente = response.data.professeurs_en_attente;
            this.bl_en_attente_arrives = response.data.bl_en_attente_arrives;
            this.bl_en_attente_ramassage =
              response.data.bl_en_attente_ramassage;
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
  },
};
</script>