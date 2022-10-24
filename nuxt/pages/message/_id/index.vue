<template>
  <section class="section no-top-pad">
    <div class="columns is-centered is-mobile">
      <div class="column is-half-desktop is-full-mobile is-full-tablet">
        {{title}}
        <div class="column is-half-desktop is-full-mobile is-full-tablet">
          <h2 class="subtitle">{{ogpData.message}}</h2>
          <img :src="ogpData.url" alt="">
        </div>  
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data () {
    return {
      title: 'Hello World!'
    }
  },
  // 静的コンテンツをディフォルト表示する
  head() {
    return {
      title: this.title,
      meta: [
        // `hid` は一意の識別子として使用されます。 `vmid` は動作しないので使わないでください。
        { hid: 'description', name: 'description', content: 'My custom description' }
      ]
    }    
  },
  computed: {
    ogpData() {
      return this.$store.getters["ogpData"];
    }
  },
  // nuxtの標準機能っぽい
  // 初期状態で画面表示する
  async fetch({app, store, route }) {
    const id = route.params.id;
    await store.dispatch("getOPG", id);
    return;
  }
}
</script>
