<template>
  <div id="app">
    <component :is="layout">
      <router-view :key="$route.fullPath" />
    </component>
  </div>
</template>

<script>
var default_layout = "default";

export default {
  metaInfo: {
    title: "",
    titleTemplate: "%s | skerlingo",
  },
  computed: {
    layout() {
      let user = this.$auth.user();
      if (user) {
        if (user && user["role_id"] == 1) default_layout = "admin";
        if (user && user["role_id"] == 2) default_layout = "exporter";
        if (user && user["role_id"] == 3) default_layout = "importer";

        return (this.$route.meta.layout || default_layout) + "-layout";
      }
      return "no-sidebar-layout";
    },
  },

  created() {
    // nothing defined here (when this.$route.path is other than "/")
    console.log(this.$route, this.$route.meta.layout);
  },

  updated() {
    // something defined here whatever the this.$route.path
    console.log(this.$route, this.$route.meta.layout);
  },
};
</script>