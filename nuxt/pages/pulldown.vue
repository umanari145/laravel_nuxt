<template>
  <b-container style="margin:0 0 0 40px;">
    <h1>動的なプルダウン＋プルダウン追加</h1>
      <b-button style="background-color:blue;" @click="add_locations">
        ロケ追加
      </b-button>
      <ul>
        <li v-for=" (location, index) in locations" :key="index" class="d-flex mt-2">
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
            <b-button variant="danger" @click="delete_locations(index)" v-show="locations.length > 1" class="ml-2 col-1">
              削除
            </b-button>
        </li>
      </ul>
  </b-container>
</template>
<script>
export default {
  name: 'pulldown',
  data() {
    return {
      locations: [
        {
          'city': '',
          'town': ''
        }
      ],
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
    add_locations() {
      const location = {
        'city': '',
        'town': ''
      };
      this.locations.push(location);
    },
    delete_locations(index) {
      this.locations.splice(index, 1)
    }
  }
}
</script>
<style scoped>
  h1 {
    color: red
  }
</style>