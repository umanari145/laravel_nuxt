<template>
  <div style="margin:0 0 0 40px;">
    <h1>サンプルページ</h1>
      <button style="background-color:blue;" @click="add_locations">
        ロケ追加
      </button>
      <ul>
        <li v-for=" (location, index) in locations" :key="index">
          <select v-model="location.city">
             <option value = ""></option>
            <option :value="city_val" v-for="(city_label, city_val) in city_list" :key="city_val">
              {{city_label}}
            </option>
          </select>
          <select v-model="location.town" style="margin-left: 20px;">
             <option value = "" ></option>
            <option :value="town_val" v-for="(town_label, town_val) in town_list[location.city]" :key="town_val">
              {{town_label}}
            </option>
          </select>
          <button @click="delete_locations(index)" v-show="locations.length > 1">
            削除
          </button>
        </li>
      </ul>
  </div>
</template>
<script>
export default {
  name: 'example',
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