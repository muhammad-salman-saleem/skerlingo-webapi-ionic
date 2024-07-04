<template>
    <div>
        <div id="core" class="core-bg-1">
            <!-- PAGE HEADER : begin -->
            <div id="page-header">
                <div class="container">
                    <h1>Nos Services</h1>
                    <ul class="breadcrumbs">
                        <li>
                            <router-link :to="'/' + alias">Accueil</router-link>
                        </li>
                        <li>Nos Services</li>
                    </ul>
                </div>
            </div>
            <!-- PAGE HEADER : begin -->

            <div class="container">
                <!-- PAGE CONTENT : begin -->
                <div id="page-content">
                    <div class="various-content">
                        <!-- CATEGORY SECTION : begin -->
                        <section
                            id="hairdressing"
                            v-for="categorie in categories"
                            v-bind:key="categorie.id"
                        >
                            <h2>{{ categorie.categorie.label }}</h2>

                            <div class="row">
                                <div class="col-sm-2">
                                    <!-- CATEGORY IMAGE : begin -->
                                    <p
                                        class="textalign-center margin-sides-auto max-width-180 service-categorie-img"
                                        v-bind:style="{
                                            'background-image':
                                                'url(' +
                                                categorie.categorie.image_url +
                                                ')'
                                        }"
                                    ></p>
                                    <!-- CATEGORY IMAGE : end -->
                                </div>
                                <div class="col-sm-10">
                                    <!-- SERVICES : begin -->
                                    <ul
                                        class="c-accordion c-accordion-services"
                                    >
                                        <li
                                            v-for="prestation in categorie.prestations"
                                            v-bind:key="prestation.id"
                                        >
                                            <h3 class="accordion-title">
                                                {{ prestation.label }}
                                            </h3>
                                            <p class="accordion-price">
                                                {{ prestation.prix }} MAD
                                            </p>
                                            <div class="accordion-content">
                                                <div
                                                    v-html="
                                                        prestation.description
                                                    "
                                                ></div>
                                            </div>
                                            <a href="#" class="c-button"
                                                >Réserver</a
                                            >
                                        </li>
                                    </ul>
                                    <!-- SERVICES : end -->
                                </div>
                            </div>
                        </section>
                        <!-- CATEGORY SECTION : end -->
                        <!-- CATEGORY SECTION : begin -->
                        <section
                            id="hairdressing"
                            v-for="prestation in prestations"
                            v-bind:key="prestation.id"
                        >
                            <h2>{{ prestation.label }}</h2>

                            <div class="row">
                                <div class="col-sm-2">
                                    <!-- CATEGORY IMAGE : begin -->
                                    <p
                                        class="textalign-center margin-sides-auto max-width-180 service-categorie-img"
                                        v-bind:style="{
                                            'background-image':
                                                'url(' +
                                                prestation.image_url +
                                                ')'
                                        }"
                                    ></p>
                                    <!-- CATEGORY IMAGE : end -->
                                </div>
                                <div class="col-sm-10">
                                    <!-- SERVICES : begin -->
                                    <ul
                                        class="c-accordion c-accordion-services"
                                    >
                                        <li>
                                            <h3 class="accordion-title">
                                                {{ prestation.label }}
                                            </h3>
                                            <p class="accordion-price">
                                                {{ prestation.prix }} MAD
                                            </p>
                                            <div class="accordion-content">
                                                <div
                                                    v-html="
                                                        prestation.description
                                                    "
                                                ></div>
                                            </div>
                                            <a href="#" class="c-button"
                                                >Réserver</a
                                            >
                                        </li>
                                    </ul>
                                    <!-- SERVICES : end -->
                                </div>
                            </div>
                        </section>
                        <!-- CATEGORY SECTION : end -->
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
            url: "services"
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
