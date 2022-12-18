<template>
  <b-container style="margin:0 0 0 40px;">
    <h1>動的なプルダウン＋プルダウン追加</h1>
      <h2>一括ロケ</h2>
      <b-button style="background-color:blue;" @click="copy_locations">
        コピーロケーション
      </b-button>

      <span class="ml-2 text-danger">
        {{copy_error_msg}}
      </span>

      <TemplateCityTown 
        :location.sync="template_location"
      >
      </TemplateCityTown>      

      <div class="mt-3">
        <h2>第一ロケ</h2>
        <CityTown 
          :locations="first_locations"
        >
        </CityTown>

        <h2>第2ロケ</h2>
        <CityTown 
          :locations="second_locations"
        >
        </CityTown>
      </div>
  </b-container>
</template>
<script>
import CityTown from '@/components/CityTown';
import TemplateCityTown from '@/components/TemplateCityTown';
export default {
  name: 'pulldown',
  components: {
    CityTown,
    TemplateCityTown
  },
  data() {
    return {
      copy_error_msg:'',
      template_location: {
          'city': '',
          'town': ''
      },
      first_locations: [
        {
          'city': '',
          'town': ''
        }
      ],
      second_locations: [
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
    copy_locations() {
      this.copy_error_msg = ''
      if (this.template_location.city !== '' && this.template_location.town !== '') {
        this.first_locations.push(
          this.template_location
        );
        
        this.second_locations.push(
          this.template_location
        );
      } else {
        this.copy_error_msg = '入力が不完全です。';
      }
    },
  }
}
</script>
<style scoped>
  h1 {
    color: red
  }
</style>