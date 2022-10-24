<template>
  <section class="section no-top-pad">
    <div id="js_capture_ref">
      <span class="your-mesage">
        あなたのメッセージ
        <span v-if="message !== ''">
          {{message}}
        </span>
        <span v-else class="no-input">
          入力エリアにメッセージを入れてください
        </span>
      </span>
    </div>
    <div class="field">
      <div class="control">
        <client-only placeholder='Loading・・・'>
          <div @click="handleGenerateOGP">
            <GenerateOGPButton /> 
          </div>
        </client-only>      
      </div>
    </div>
    <div class="column">
      <form action="">
        <div class="field">
          <label for="" class="label">
            あなたのメッセージ
          </label>
          <input type="text" v-model="message">
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import GenerateOGPButton from '@/components/Generator';
export default {
  components: {
    GenerateOGPButton
  },
  name: 'IndexPage',
  data() {
    return {
      message: ''
    }
  },
  methods: {
    handleGenerateOGP(e) {
      this.$store.dispatch('setMessage', {
        message: this.message,
        Image: e
      });
    }
  }
}
</script>
