<template>
  <div style="margin:0 0 0 40px;">
    <h1>金額計算</h1>
      <div v-for = "(price, index) in prices" :key="index">
        <div class="col-8" id="search">
          <h2>
            {{price.shop_name}}
          </h2>
          <div class="d-flex align-items-center mt-2">
            <div class="col-3">定価: </div>
            <div class="col-9">
              <div class="col-1">{{price.constant_price | number_format}}</div>
            </div>
          </div>
          <Price
            label='セール価格1'
            :label_id = index
            :constant_price="price.constant_price"
            :p_discount_type.sync="price.discount_type1"
            :p_discount_price.sync="price.discount_price1"
            :p_discount_rate.sync="price.discount_rate1"
          >
          </Price>
        </div>
      </div>
  </div>
</template>
<script>
import Price from '@/components/Price';
export default {
  name: 'pricelist',
  components: {
    Price
  },
  async asyncData({ app }) {
    let prices = [];
    let price = {
      'shop_name': '山田商店',
      'constant_price': '10000',
      'discount_type1':'',
      'is_discount_price_disabled': false,
      'is_discount_rate_disabled': false,
      'discount_price1':'',
      'discount_rate1': '',
      'price': 0,
      'discount': 0,
      'rate': 0
    };
    prices.push(price);
    price = {
      'shop_name': '鈴木商店',
      'constant_price': '20000',
      'discount_type1':'',
      'is_discount_price_disabled': false,
      'is_discount_rate_disabled': false,
      'discount_price1':'',
      'discount_rate1': '',
      'price': 0,
      'discount': 0,
      'rate': 0
    };
    prices.push(price);
    return {
      'prices': prices
    }
  },
  computed: {
  },
  methods: {
  },
  mounted() {

  },
  filters: {
    number_format(num) {
      return num.toLocaleString();
    }
  },
}
</script>
<style scoped>
  h1 {
    color: red
  }
</style>