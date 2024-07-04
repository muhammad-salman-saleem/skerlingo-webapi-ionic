<script>
import NavBar from "../components_web/NavBar";
import SideBar from "../components_web/SideBar";
import FooterBar from "../components_web/FooterBar";

export default {
  components: {
    NavBar,
    SideBar,
    FooterBar,
  },
};
</script>

<template>
  <div id="app_web">
    <side-bar />

    <div id="wrapper">
      <slot />

      <footer-bar />
    </div>
  </div>
</template>
