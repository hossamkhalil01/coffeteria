<template>
  <nav v-if="links.length > 0" aria-label="">
    <ul class="pagination justify-content-center">
      <li :class="[links[0].url == null ? 'disabled' : '']" class="page-item">
        <a
          class="page-link"
          href="#"
          @click.prevent="paginate(links[0].url)"
          aria-label="Previous"
        >
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li
        v-for="(link, index) in links.slice(1, links.length - 1)"
        :key="index"
        :class="[link.active == true ? 'active' : '']"
        class="page-item"
      >
        <a class="page-link" @click.prevent="paginate(link.url)">{{
          link.label
        }}</a>
      </li>
      <li
        :class="[links[links.length - 1].url == null ? 'disabled' : '']"
        class="page-item"
      >
        <a
          class="page-link"
          href="#"
          @click.prevent="paginate(links[links.length - 1].url)"
          aria-label="Next"
        >
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</template>



<script>
export default {
  data() {
    return {};
  },
  props: {
    links: {
      type: Array,
      required: true,
    },
  },

  methods: {
    paginate: function (url) {
      this.$emit("paginate", url);
    },
  },
};
</script>


<style scoped>
li {
  cursor: pointer;
}
</style>
