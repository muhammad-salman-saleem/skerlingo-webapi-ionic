<template>
  <div>
    <!-- MAIN SLIDER : begin -->
    <div id="main-slider" data-interval="8000">
      <div class="slide-list">
        <!-- SLIDE 1 : begin -->
        <div
          class="slide slide-1"
          data-label="Welcome to BEAUTYSPOT"
          v-bind:style="{ 'background-image': 'url(' + banner + ')' }"
        >
          <div class="slide-bg">
            <div class="container">
              <div class="slide-inner">
                <div class="slide-content various-content textalign-left valign-middle">
                  <h1>
                    <span>Cher(e)s client(e)s</span>
                    <br />
                    {{ agence_name }}
                  </h1>
                  <h3>
                    HTML Template for Beauty Agences,
                    <br />Hairdressers, Wellness or Spa
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- SLIDE 1 : end -->

        <!-- SLIDE 2 : begin -->
        <div
          class="slide slide-2"
          data-label="20% off All Massages"
          v-bind:style="{ 'background-image': 'url(' + banner + ')' }"
        >
          <div class="slide-bg">
            <div class="container">
              <div class="slide-inner">
                <div class="slide-content various-content textalign-right valign-middle">
                  <h2>
                    20% Off
                    <br />All Massages
                  </h2>
                  <h3>
                    This Friday Only!
                    <br />
                    <a
                      href="ajax/reservation-form.html"
                      class="m-open-ajax-modal"
                    >Make a Reservation</a>
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- SLIDE 2 : end -->

        <!-- SLIDE 3 : begin -->
        <div
          class="slide slide-3"
          data-label="Eshop Launched"
          v-bind:style="{ 'background-image': 'url(' + banner + ')' }"
        >
          <div class="slide-bg">
            <div class="container">
              <div class="slide-inner">
                <div class="slide-content various-content textalign-left valign-middle">
                  <h2>
                    Eshop
                    <br />Launched
                  </h2>
                  <h3>
                    <a href="shop-list.html">Take a Look</a>
                    at Our Products
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- SLIDE 3 : end -->
      </div>
    </div>
    <!-- MAIN SLIDER : end -->

    <!-- CORE : begin -->
    <div id="core">
      <!-- PAGE CONTENT : begin -->
      <div id="page-content">
        <div class="various-content">
          <!-- SERVICES SECTION : begin -->
          <section>
            <!-- SECTION HEADER : begin -->
            <header>
              <div class="container">
                <h2>Nos Services</h2>
                <p class="subtitle">We offer a wide range of beauty services</p>
                <p class="more">
                  <a href="services.html" class="c-button m-type-2">See all Services</a>
                </p>
              </div>
            </header>
            <!-- SECTION HEADER : end -->

            <!-- SERVICE LIST : begin -->
            <div
              class="c-service-list m-paginated"
              data-items="4"
              data-items-desktop="4"
              data-items-desktop-small="3"
              data-items-tablet="2"
              data-items-mobile="1"
            >
              <div class="container">
                <div class="service-list-inner">
                  <div
                    class="service-list-item"
                    v-for="prestationcategorie in prestationcategories"
                    v-bind:key="prestationcategorie.id"
                  >
                    <!-- SERVICE : begin -->
                    <div class="c-service">
                      <router-link :to="alias + '/services'">
                        <div
                          class="service-image"
                          v-bind:style="{
                                                        'background-image':
                                                            'url(' +
                                                            prestationcategorie.image_url +
                                                            ')'
                                                    }"
                        >
                          <div class="service-infos">
                            <span class="service-title">
                              {{
                              prestationcategorie.label
                              }}
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                    <!-- SERVICE : end -->
                  </div>
                  <div
                    class="service-list-item"
                    v-for="prestation in prestations"
                    v-bind:key="prestation.id"
                  >
                    <!-- SERVICE : begin -->
                    <div class="c-service">
                      <router-link :to="alias + '/services'">
                        <div
                          class="service-image"
                          v-bind:style="{
                                                        'background-image':
                                                            'url(' +
                                                            prestation.image_url +
                                                            ')'
                                                    }"
                        >
                          <div class="service-infos">
                            <span class="service-title">
                              {{
                              prestation.label
                              }}
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                    <!-- SERVICE : end -->
                  </div>
                </div>
              </div>
            </div>
            <!-- SERVICE LIST : end -->
          </section>
          <!-- SERVICES SECTION : end -->

          <!-- GALLERY SECTION : begin -->
          <section>
            <!-- SECTION HEADER : begin -->
            <header>
              <div class="container">
                <h2>Gallery</h2>
                <p class="subtitle">See how it looks inside our studio</p>
                <p class="more">
                  <a href="gallery.html" class="c-button m-type-2">Enter Gallery</a>
                </p>
              </div>
            </header>
            <!-- SECTION HEADER : end -->

            <!-- GALLERY : begin -->
            <div
              class="c-gallery m-paginated"
              data-items="4"
              data-items-desktop="4"
              data-items-desktop-small="3"
              data-items-tablet="2"
              data-items-mobile="1"
            >
              <div class="thumb-list">
                <div class="thumb">
                  <a href="images/gallery_01.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_01.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_02.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_02.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_03.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_03.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_04.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_04.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_05.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_05.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_06.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_06.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_07.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_07.jpg" alt />
                  </a>
                </div>
                <div class="thumb">
                  <a href="images/gallery_08.jpg" class="lightbox" data-lightbox-group="gallery">
                    <img src="images/gallery_08.jpg" alt />
                  </a>
                </div>
              </div>
            </div>
            <!-- GALLERY : end -->
          </section>
          <!-- GALLERY SECTION : end -->

          <!-- BLOG SECTION : begin -->
          <section>
            <!-- SECTION HEADER : begin -->
            <header>
              <div class="container">
                <h2>Blog</h2>
                <p class="subtitle">Read about latest health trends</p>
                <p class="more">
                  <a href="blog.html" class="c-button m-type-2">Read Blog</a>
                </p>
              </div>
            </header>
            <!-- SECTION HEADER : end -->

            <div class="container">
              <div class="row">
                <div class="col-sm-3">
                  <!-- ARTICLE : begin -->
                  <article class="c-article">
                    <div class="article-image">
                      <a href="blog-image.html">
                        <img src="images/article_thumb_01.jpg" alt />
                      </a>
                    </div>
                    <h3 class="article-title">
                      <a href="blog-image.html">
                        Far far away, behind the word
                        mountains
                      </a>
                    </h3>
                  </article>
                  <!-- ARTICLE : end -->
                </div>
                <div class="col-sm-3">
                  <!-- ARTICLE : begin -->
                  <article class="c-article">
                    <div class="article-image">
                      <a href="blog-image.html">
                        <img src="images/article_thumb_02.jpg" alt />
                      </a>
                    </div>
                    <h3 class="article-title">
                      <a href="blog-image.html">
                        The Big Oxmox advised her not to
                        do so
                      </a>
                    </h3>
                  </article>
                  <!-- ARTICLE : end -->
                </div>
                <div class="col-sm-3">
                  <!-- ARTICLE : begin -->
                  <article class="c-article">
                    <div class="article-image">
                      <a href="blog-image.html">
                        <img src="images/article_thumb_03.jpg" alt />
                      </a>
                    </div>
                    <h3 class="article-title">
                      <a href="blog-image.html">
                        A small river named Duden flows
                        by their place
                      </a>
                    </h3>
                  </article>
                  <!-- ARTICLE : end -->
                </div>
                <div class="col-sm-3">
                  <!-- ARTICLE : begin -->
                  <article class="c-article">
                    <div class="article-image">
                      <a href="blog-image.html">
                        <img src="images/article_thumb_04.jpg" alt />
                      </a>
                    </div>
                    <h3 class="article-title">
                      <a href="blog-image.html">
                        Right at the coast of the
                        Semantics
                      </a>
                    </h3>
                  </article>
                  <!-- ARTICLE : end -->
                </div>
              </div>
            </div>
          </section>
          <!-- BLOG SECTION : end -->

          <!-- TESTIMONIALS SECTION : begin -->
          <section>
            <!-- SECTION HEADER : begin -->
            <header>
              <div class="container">
                <h2>Our Entreprises</h2>
                <p class="subtitle">Read why they love us so much</p>
                <p class="more">
                  <a href="contact.html" class="c-button m-type-2">Become Our Client</a>
                </p>
              </div>
            </header>
            <!-- SECTION HEADER : end -->

            <!-- TESTIMONIAL LIST : begin -->
            <div class="c-testimonial-list m-paginated">
              <div class="container">
                <div class="testimonial-list-inner">
                  <div class="testimonial-list-item">
                    <!-- TESTIMONIAL : begin -->
                    <div class="c-testimonial m-has-portrait">
                      <div class="testimonial-inner">
                        <p class="testimonial-portrait">
                          <span>
                            <img src="images/client_01.jpg" alt />
                          </span>
                        </p>
                        <blockquote>
                          <p>
                            Quisque rutrum. Aenean
                            imperdiet. Etiam
                            ultricies nisi vel
                            augue. Curabitur
                            ullamcorper ultricies
                            nisi. Nam eget dui.
                            Etiam rhoncus. Maecenas
                            tempus, tellus eget
                            condimentum rhoncus, sem
                            quam semper libero.
                          </p>
                          <footer>
                            <strong>
                              Floor
                              Simons
                            </strong>, Startup CEO
                          </footer>
                        </blockquote>
                      </div>
                    </div>
                    <!-- TESTIMONIAL : end -->
                  </div>
                  <div class="testimonial-list-item">
                    <!-- TESTIMONIAL : begin -->
                    <div class="c-testimonial m-has-portrait">
                      <div class="testimonial-inner">
                        <p class="testimonial-portrait">
                          <span>
                            <img src="images/client_02.jpg" alt />
                          </span>
                        </p>
                        <blockquote>
                          <p>
                            In enim justo, rhoncus
                            ut, imperdiet a,
                            venenatis vitae, justo.
                            Nullam dictum felis eu
                            pede mollis pretium.
                            Integer tincidunt. Cras
                            dapibus. Vivamus
                            elementum semper nisi.
                            Aenean vulputate
                            eleifend tellus. Aenean
                            imperdiet.
                          </p>
                          <footer>
                            <strong>Nikki Neil</strong>, Blogger
                          </footer>
                        </blockquote>
                      </div>
                    </div>
                    <!-- TESTIMONIAL : end -->
                  </div>
                  <div class="testimonial-list-item">
                    <!-- TESTIMONIAL : begin -->
                    <div class="c-testimonial m-has-portrait">
                      <div class="testimonial-inner">
                        <p class="testimonial-portrait">
                          <span>
                            <img src="images/client_03.jpg" alt />
                          </span>
                        </p>
                        <blockquote>
                          <p>
                            Aenean leo ligula,
                            porttitor eu, consequat
                            vitae, eleifend ac,
                            enim. Aliquam lorem
                            ante, dapibus in,
                            viverra quis, feugiat a,
                            tellus. Aenean
                            imperdiet. Phasellus
                            viverra nulla ut metus
                            varius laoreet. Quisque
                            rutrum. Nam quam nunc.
                          </p>
                          <footer>
                            <strong>Tarja Lee</strong>, Writer
                          </footer>
                        </blockquote>
                      </div>
                    </div>
                    <!-- TESTIMONIAL : end -->
                  </div>
                </div>
              </div>
            </div>
            <!-- TESTIMONIAL LIST : end -->
          </section>
          <!-- TESTIMONIALS SECTION : end -->

          <!-- BRANDS SECTION : begin -->
          <section>
            <!-- SECTION HEADER : begin -->
            <header>
              <div class="container">
                <h2>Our Favourite brands</h2>
                <p class="subtitle">
                  We use only the high quality original
                  products
                </p>
              </div>
            </header>
            <!-- SECTION HEADER : end -->

            <div class="container">
              <div class="row">
                <div class="col-sm-3">
                  <p class="textalign-center">
                    <!-- BRAND LOGO : begin -->
                    <a href="#" class="no-border">
                      <img src="images/brand_01.png" alt />
                    </a>
                    <!-- BRAND LOGO : end -->
                  </p>
                </div>
                <div class="col-sm-3">
                  <p class="textalign-center">
                    <!-- BRAND LOGO : begin -->
                    <a href="#" class="no-border">
                      <img src="images/brand_02.png" alt />
                    </a>
                    <!-- BRAND LOGO : end -->
                  </p>
                </div>
                <div class="col-sm-3">
                  <p class="textalign-center">
                    <!-- BRAND LOGO : begin -->
                    <a href="#" class="no-border">
                      <img src="images/brand_03.png" alt />
                    </a>
                    <!-- BRAND LOGO : end -->
                  </p>
                </div>
                <div class="col-sm-3">
                  <p class="textalign-center">
                    <!-- BRAND LOGO : begin -->
                    <a href="#" class="no-border">
                      <img src="images/brand_04.png" alt />
                    </a>
                    <!-- BRAND LOGO : end -->
                  </p>
                </div>
              </div>
            </div>
          </section>
          <!-- BRANDS SECTION : end -->
        </div>
      </div>
      <!-- PAGE CONTENT : end -->
    </div>
    <!-- CORE : end -->

    <!-- BOTTOM PANEL : begin -->
    <div id="bottom-panel">
      <div class="bottom-panel-inner">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <!-- BOTTOM TEXT : begin -->
              <div class="bottom-text various-content">
                <h3>About Beautyspot</h3>
                <p>
                  <strong>BEAUTYSPOT</strong> is an ideal
                  template for
                  <strong>
                    beauty agence, hairdressers, wellness or
                    spa
                  </strong>. Clean code and top-notch web design
                  techniques are wrapped with
                  <strong>several gorgeous color schemes</strong>
                  to choose from.
                </p>
                <p>
                  You can buy this responsive HTML5/CSS3
                  template on
                  <a
                    href="https://themeforest.net/user/lsvrthemes/portfolio?ref=LSVRthemes"
                  >ThemeForest</a>.
                </p>
              </div>
              <!-- BOTTOM TEXT : end -->
            </div>
            <div class="col-md-6">
              <!-- BOTTOM SUBSCRIBE : begin -->
              <div class="bottom-subscribe various-content">
                <h3>Newsletter</h3>
                <p>BEAUTYSPOT supports MailChimp integration.</p>
                <form
                  id="subscribe-form"
                  action="http://lsvr.us14.list-manage.com/subscribe/post-json?u=8291218baaf54ddfd7dbc6016&amp;id=f3e5d696dc&amp;c=?"
                  method="get"
                >
                  <!-- VALIDATION ERROR MESSAGE : begin -->
                  <p style="display: none;" class="c-alert-message m-warning m-validation-error">
                    <i class="ico fa fa-exclamation-circle"></i>Email address is required.
                  </p>
                  <!-- VALIDATION ERROR MESSAGE : end -->

                  <!-- SENDING REQUEST ERROR MESSAGE : begin -->
                  <p style="display: none;" class="c-alert-message m-warning m-request-error">
                    <i class="ico fa fa-exclamation-circle"></i>There was a connection problem. Try
                    again later.
                  </p>
                  <!-- SENDING REQUEST ERROR MESSAGE : end -->

                  <!-- SUCCESS MESSAGE : begin -->
                  <p style="display: none;" class="c-alert-message m-success">
                    <i class="ico fa fa-check-circle"></i>
                    <strong>Sent successfully.</strong>
                  </p>
                  <!-- SUCCESS MESSAGE : end -->

                  <div class="form-fields">
                    <input
                      class="m-required m-email"
                      name="EMAIL"
                      type="text"
                      data-placeholder="Your email address"
                      title="Your email address"
                    />
                    <button
                      class="c-button submit-btn"
                      type="submit"
                      data-label="Subscribe"
                      data-loading-label="Sending..."
                    >Subscribe</button>
                  </div>
                </form>
              </div>
              <!-- BOTTOM SUBSCRIBE : end -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- BOTTOM PANEL : end -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      date: "test",
      services: null,
      prestationcategories: [],
      prestations: [],
      alias: this.$route.params.alias,
      banner: null,
      agence_name: null,
      url: "home",
    };
  },
  metaInfo() {
    return {
      title: `${
        (this.agence_name ? this.agence_name + " :" : "") +
        " Téléchargeable sur iPhone, iPad ou sur les appareils Android"
      }`,
    };
  },
  created() {
    this.fetch();
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    fetch() {
      let params = {};
      if (this.date) {
        params["date"] = this.date;
      }
      params["alias"] = this.alias;
      axios
        .get(this.url, {
          params: params,
        })
        .then(
          function (response) {
            console.log("test", response);
            //this.services = response.data.services;
            this.banner = response.data.banner;
            this.agence_name = response.data.agence_name;
            this.prestationcategories = response.data.categories;
            this.prestations = response.data.prestations;
            setTimeout(function () {
              CVCustom.init();
            }, 1000);
          }.bind(this)
        )
        .catch((error) => console.log(error));
    },
  },
};
</script>
