<template>
  <!--begin::Footer-->
  <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div
      class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between"
    >
      <!--begin::Copyright-->
      <div class="text-dark order-2 order-md-1">
        <span class="text-muted font-weight-bold mr-2">2020©</span>
        <a
          href="http://dromen.agency"
          target="_blank"
          class="text-dark-75 text-hover-primary"
        >Dromen Agency</a>
      </div>
      <!--end::Copyright-->
      <!--begin::Nav-->
      <div class="nav nav-dark">
        <a :href="about_link" target="_blank" class="nav-link pl-0 pr-5">A propos</a>
        <a :href="cgu_link" target="_blank" class="nav-link pl-0 pr-5">CGU</a>
        <a href="#" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
      </div>
      <!--end::Nav-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Footer-->
</template>

<script>
export default {
  data() {
    return {
      about_link: `${process.env.MIX_APP_URL}/about`,
      cgu_link: `${process.env.MIX_APP_URL}/cgu`,
    };
  },
};
</script>
