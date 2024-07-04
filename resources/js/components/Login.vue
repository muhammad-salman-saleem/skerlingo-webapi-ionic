<template>
  <div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div
      class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
      id="kt_login"
    >
      <!--begin::Aside-->
      <div
        class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden m-auto"
        style="height: 100vh !important;"
      >
        <!--begin: Aside Container-->
        <div
          class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35"
        >
          <!--begin::Logo-->
          <a href="#" class="text-center pt-2">
            <img src="/../assets/media/logos/logo.svg" class="max-h-70px" alt />
          </a>
          <!--end::Logo-->
          <!--begin::Aside body-->
          <div class="d-flex flex-column-fluid flex-column flex-center">
            <!--begin::Signin-->
            <div class="login-form login-signin py-11">
              <!--begin::Form-->
              <form
                class="form"
                novalidate="novalidate"
                id="kt_login_signin_forms"
                autocomplete="off"
                @submit.prevent="login"
                method="post"
              >
                <!--begin::Title-->
                <div class="text-center pb-8">
                  <h2
                    class="font-weight-bolder text-dark font-size-h1 font-size-h1-lg"
                    style="font-weight: 700 !important;"
                  >Se connecter</h2>
                </div>
                <!--end::Title-->
                <div
                  class="alert alert-custom alert-light-danger fade show mb-5 p-4"
                  v-if="has_error"
                  role="alert"
                >
                  <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                  </div>
                  <div class="alert-text">{{ has_error }}</div>
                  <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                      </span>
                    </button>
                  </div>
                </div>
                <!--begin::Form group-->
                <div class="form-group">
                  <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                    v-model="email"
                    placeholder="Email"
                    name="email"
                    autocomplete="off"
                    required
                    type="text"
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                  <div class="d-flex justify-content-between mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Mot de passe</label>
                    <router-link
                      to="/forgot-password"
                      class="d-none text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                      id="kt_login_forgot"
                    >Mot de passe oublié ?</router-link>
                  </div>
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                    type="password"
                    v-model="password"
                    placeholder="Mot de passe"
                    name="password"
                    autocomplete="off"
                    required
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Action-->
                <div class="text-center pt-2">
                  <button
                    id="kt_login_signin_submit"
                    type="submit"
                    class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3"
                  >Se connecter</button>
                </div>
                <!--end::Action-->
              </form>
              <!--end::Form-->
            </div>
            <!--end::Signin-->
            <!--begin::Signup-->
            <div class="login-form login-signup pt-11">
              <!--begin::Form-->
              <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                <!--begin::Title-->
                <div class="text-center pb-8">
                  <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign Up</h2>
                  <p
                    class="text-muted font-weight-bold font-size-h4"
                  >Enter your details to create your account</p>
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    type="text"
                    placeholder="Fullname"
                    name="fullname"
                    autocomplete="off"
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    type="email"
                    placeholder="Email"
                    name="email"
                    autocomplete="off"
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    type="password"
                    placeholder="Password"
                    name="password"
                    autocomplete="off"
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    type="password"
                    placeholder="Confirm password"
                    name="cpassword"
                    autocomplete="off"
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group">
                  <label class="checkbox mb-0">
                    <input type="checkbox" name="agree" />I Agree the
                    <a href="#">terms and conditions</a>.
                    <span></span>
                  </label>
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                  <button
                    type="button"
                    id="kt_login_signup_submit"
                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                  >Submit</button>
                  <button
                    type="button"
                    id="kt_login_signup_cancel"
                    class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                  >Cancel</button>
                </div>
                <!--end::Form group-->
              </form>
              <!--end::Form-->
            </div>
            <!--end::Signup-->
            <!--begin::Forgot-->
            <div class="login-form login-forgot pt-11">
              <!--begin::Form-->
              <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                <!--begin::Title-->
                <div class="text-center pb-8">
                  <h2
                    class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"
                  >Forgotten Password ?</h2>
                  <p
                    class="text-muted font-weight-bold font-size-h4"
                  >Enter your email to reset your password</p>
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                  <input
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    type="email"
                    placeholder="Email"
                    name="email"
                    autocomplete="off"
                  />
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                  <button
                    type="button"
                    id="kt_login_forgot_submit"
                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                  >Submit</button>
                  <button
                    type="button"
                    id="kt_login_forgot_cancel"
                    class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                  >Cancel</button>
                </div>
                <!--end::Form group-->
              </form>
              <!--end::Form-->
            </div>
            <!--end::Forgot-->
          </div>
          <!--end::Aside body-->
        </div>
        <!--end: Aside Container-->
      </div>
      <!--begin::Aside-->
    </div>
    <!--end::Login-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      has_error: false,
      link_inscription: `${process.env.MIX_APP_URL}/inscription`,
      link_forgotpassword: `${process.env.MIX_APP_URL}/app/forgot-password`,
    };
  },

  created() {
    this.$root.$refs.loginPage = this;
  },
  mounted() {
    //
  },

  methods: {
    login() {
      // get the redirect object
      var redirect = this.$auth.redirect();
      var app = this;
      this.$auth
        .login({
          params: {
            email: app.email,
            password: app.password,
          },
          success: function (result) {
            app.setCookie("auth_token_default", result.data.token, 365);
            app.has_error = null;
            // handle redirection
            //const redirectTo = redirect ? redirect.from.nom : app.$auth.user().role_id === 2 ? 'admin.dashboard' : 'dashboard'
            //console.log(app.$router);
          },
          error: function (error) {
            app.has_error = error.response.data.error;
          },
          rememberMe: true,
          fetchUser: true,
        })
        .then(function (response) {
          let searchParams = new URLSearchParams(window.location.search);

          if (searchParams.has("redirect")) {
            window.location.href =
              `${process.env.MIX_APP_URL}/admin0619` +
              searchParams.get("redirect");
          } else {
            window.location.href = `${process.env.MIX_APP_URL}/admin0619`;
          }
        });
    },
    setCookie(name, value, days) {
      var expires = "";
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "") + expires + "; path=/";
    },
  },
};
</script>
