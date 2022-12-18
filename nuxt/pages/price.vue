<template>
  <div style="margin:0 0 0 40px;">
    <h1>金額計算</h1>
      <div class="col-8" id="search">
        <div class="d-flex align-items-center mt-2">
          <div class="col-3">定価: </div>
          <div class="col-9">
            <div class="col-1">{{constant_price | number_format}}</div>
          </div>
        </div>
        
        <Price
          label='セール価格1'
          constant_price=10000
          :p_discount_type.sync="this.discount_type1"
          :p_discount_price.sync="this.discount_price1"
          :p_discount_rate.sync="this.discount_rate1"
        >
        </Price>
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
  data() {
    return {
      'constant_price': 10000,
      'discount_type1':'',
      'is_discount_price_disabled': false,
      'is_discount_rate_disabled': false,
      'discount_price1':'',
      'discount_rate1': '',
      'price': 0,
      'discount': 0,
      'rate': 0
    }
  },
  computed: {

  },
  methods: {
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