<template>
    <div>
        <!-- HEADER : begin -->
        <header id="header" class="m-animated">
            <div class="header-bg">
                <div class="header-inner">
                    <!-- HEADER BRANDING : begin -->
                    <div class="header-branding" style="margin-bottom: 35px;">
                        <a href="#">
                            <img
                                v-if="agence"
                                v-bind:src="agence.image_url"
                                alt="BeautySpot"
                            />
                        </a>
                    </div>
                    <!-- HEADER BRANDING : end -->

                    <!-- HEADER NAVIGATION : begin -->
                    <div class="header-navigation" v-if="false">
                        <!-- HEADER MENU : begin -->
                        <nav class="header-menu">
                            <button class="header-menu-toggle" type="button">
                                <i class="fa fa-bars"></i>MENU
                            </button>
                            <ul>
                                <li class="m-active">
                                    <span>
                                        <a href="#">Accueil</a>
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        <a href="contact.html">Boutique</a>
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        <a href="contact.html">Contact</a>
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        <a href="contact.html">Profil</a>
                                    </span>
                                </li>
                            </ul>
                        </nav>
                        <!-- HEADER MENU : end -->

                        <!-- HEADER CART : begin -->
                        <div class="header-cart">
                            <div class="header-cart-inner">
                                <a href="shop-cart.html">
                                    <i class="cart-ico fa fa-shopping-cart"></i>
                                    <span class="cart-label">Panier</span>
                                    <span class="cart-count">(3 items)</span>
                                </a>
                            </div>
                        </div>
                        <!-- HEADER CART : end -->
                    </div>
                    <!-- HEADER NAVIGATION : end -->

                    <!-- HEADER PANEL : begin -->
                    <div class="header-panel">
                        <button class="header-panel-toggle" type="button">
                            <i class="fa"></i>
                        </button>

                        <!-- HEADER CONTACT : begin -->
                        <div class="header-contact">
                            <ul>
                                <!-- PHONE : begin -->
                                <li>
                                    <div class="item-inner">
                                        <i class="ico fa fa-phone"></i>
                                        <strong v-if="agence">{{
                                            agence.tel
                                        }}</strong>
                                    </div>
                                </li>
                                <!-- PHONE : end -->

                                <!-- EMAIL : begin -->
                                <li>
                                    <div class="item-inner">
                                        <i class="ico fa fa-envelope-o"></i>
                                        <a href="#" v-if="agence">{{
                                            agence.email
                                        }}</a>
                                    </div>
                                </li>
                                <!-- EMAIL : end -->

                                <!-- ADDRESS : begin -->
                                <li>
                                    <div class="item-inner">
                                        <i class="ico fa fa-map-marker"></i>
                                        <strong v-if="agence">{{
                                            agence.label
                                        }}</strong>
                                        <br />
                                        <span v-if="agence">{{
                                            agence.adresse
                                        }}</span>
                                    </div>
                                </li>
                                <!-- ADDRESS : end -->
                            </ul>
                        </div>
                        <!-- HEADER CONTACT : end -->

                        <!-- HEADER SOCIAL : begin -->
                        <div class="header-social">
                            <ul>
                                <li>
                                    <a href="#" title="Facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Instagram">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- HEADER SOCIAL : end -->
                    </div>
                    <!-- HEADER PANEL : end -->
                </div>
            </div>
        </header>
        <!-- HEADER : end -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            agence: null,
            url: "sidebare"
        };
    },
    created() {},
    mounted() {
        console.log("Component mounted.");
    },
    watch: {
        "$route.params.alias": {
            handler: function(search) {
                this.fetch(search);
            },
            deep: true,
            immediate: true
        }
    },
    methods: {
        fetch(alias) {
            let params = {};
            if (this.date) {
                params["date"] = this.date;
            }
            params["alias"] = alias;
            axios
                .get(this.url, {
                    params: params
                })
                .then(
                    function(response) {
                        this.agence = response.data.agence;
                    }.bind(this)
                )
                .catch(error => console.log(error));
        }
    }
};
</script>
