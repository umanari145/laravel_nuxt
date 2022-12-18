<template>
    <div>
      <div class="mt-3">
        <b-form-select v-model="location.city" class="col-2">
            <option value=""></option>
            <option :value="city_val" v-for="(city_label, city_val) in city_list" :key="city_val">
            {{city_label}}
            </option>
        </b-form-select>
        <b-form-select v-model="location.town" class="ml-2 col-2">
            <option value=""></option>
            <option :value="town_val" v-for="(town_label, town_val) in town_list[location.city]" :key="town_val">
            {{town_label}}
            </option>
        </b-form-select>
      </div>
    </div>
</template>
<script>
export default {
  name: 'pulldown',
  props: {
    location:{
      type:Object,
      required:true,
      default:{}
    }
  },
  created() {
  },
  data() {
    return {
      city_list: {
        '1': '東京',
        '2': '千葉'
      },
      town_list: {
        '1': {
          '0a': '港区',
          '0b': '世田谷区'
        },
        '2': {
          '0x': '市川',
          '0y': '船橋'
        }
      }
    }
  },
  methods: {
  }
}
</script>
<style scoped>
  h1 {
    color: red
  }
</style>