<template>
    <div>
        <div id="core" class="core-bg-1">
            <!-- PAGE HEADER : begin -->
            <div id="page-header" style="margin-bottom: 30px;">
                <div class="container">
                    <h1>{{ agence_name }}</h1>
                </div>
            </div>
            <!-- PAGE HEADER : begin -->

            <div class="container">
                <!-- PAGE CONTENT : begin -->
                <div id="page-content">
                    <div class="various-content">
                        <p>
                            Télécharger notre Application mobile. Disponible sur
                            :
                        </p>
                        <div class="download-area">
                            <a
                                v-bind:href="app_store"
                                class="bttn-icon wow fadeIn"
                            >
                                <span class="bttn-content">
                                    <span class="icon">
                                        <img
                                            src="/../assets/web/images/app-store.png"
                                            alt
                                        />
                                    </span>
                                    <small>Get It From</small>
                                    <strong>App Store</strong>
                                </span>
                            </a>
                            <a
                                v-bind:href="play_store"
                                class="bttn-icon wow fadeIn"
                            >
                                <span class="bttn-content">
                                    <span class="icon">
                                        <img
                                            src="/../assets/web/images/play-store.png"
                                            alt
                                        />
                                    </span>
                                    <small>Get It From</small>
                                    <strong>Play Store</strong>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- PAGE CONTENT : end -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            date: null,
            services: null,
            categories: [],
            prestations: [],
            alias: this.$route.params.alias,
            banner: null,
            agence_name: null,
            app_store: null,
            play_store: null,
            url: "services"
        };
    },
    metaInfo() {
        return {
            title: `${(this.agence_name ? this.agence_name + " :" : "") +
                " Téléchargeable sur iPhone, iPad ou sur les appareils Android"}`,
            meta: [
                {
                    property: "og:title",
                    content: `${(this.agence_name
                        ? this.agence_name + " :"
                        : "") +
                        " Téléchargeable sur iPhone, iPad ou sur les appareils Android"}`
                }
            ]
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
                    params: params
                })
                .then(
                    function(response) {
                        this.categories = response.data.categories;
                        this.prestations = response.data.prestations;
                        this.agence_name = response.data.agence_name;
                        this.app_store = response.data.app_store;
                        this.play_store = response.data.play_store;
                        setTimeout(function() {
                            CVCustom.init();
                        }, 1000);
                    }.bind(this)
                )
                .catch(error => console.log(error));
        }
    }
};
</script>
