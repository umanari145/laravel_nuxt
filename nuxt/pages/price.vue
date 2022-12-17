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

        <div class="d-flex align-items-center mt-2">
          <div class="col-3">セール価格1 </div>

          <div class="col-9">

            <span class="col-1">{{ discounted_price | number_format}} </span> <span class="text-danger">{{discount_message}}</span>

            <div class="d-flex align-items-center mt-2">
              <span class="col-3">
                <input type="radio" v-model="discount_type1" id="discount1_type_price" value="price" @change="input_is_valid()">
                <label for="discount1_type_price" class="ml-1">値引き</label>
              </span>
              <b-form-input type="number" v-model="discount_price1" class="text-right col-2 ml-2" :disabled="is_discount_price_disabled"></b-form-input>
            </div>

            <div class="d-flex align-items-center mt-2">
              <span class="col-3">
                <input type="radio" v-model="discount_type1" id="discount1_type_rate" value="rate" @change="input_is_valid()">
                <label for="discount1_type_rate" class="ml-1">割合</label>
              </span>
              <b-form-input type="number" v-model="discount_rate1" class="text-right col-2 ml-2" :disabled="is_discount_rate_disabled"></b-form-input>
            </div>

            <div class="d-flex align-items-center mt-2">
              <span class="col-3">
                <input type="radio" v-model="discount_type1" id="discount1_type_none" value="none" @change="input_is_valid()">
                <label for="discount1_type_none" class="ml-1">割引なし</label>
              </span>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>
<script>
export default {
  name: 'price',
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
    discounted_price() {
      let discounted_price = this.constant_price;
      if (this.discount_type1 === 'price') {
        if (this.discount_price1 !=='') {
          discounted_price = (this.constant_price - this.discount_price1);
        }
      } else if (this.discount_type1 === 'rate') {
        if (this.discount_rate1 > 0) {
          discounted_price = (this.constant_price * this.discount_rate1/100);
        }
      }
      return discounted_price;
    },
    discount_message() {
      let message = '';
      let calculate_discount_price1 = '';
      let calculate_discount_rate1 = '';
      if (this.discount_type1 === 'price' || this.discount_type1 === 'rate') {
        if (this.discount_type1 === 'price') {
          calculate_discount_price1 = this.discount_price1;
          calculate_discount_rate1 = parseInt(this.discount_price1 / this.constant_price * 100);
        } else if (this.discount_type1 === 'rate') {
          calculate_discount_price1 = parseInt(this.constant_price * this.discount_rate1 / 100);
          calculate_discount_rate1 = this.discount_rate1
        }
        if (calculate_discount_price1 > 0 && calculate_discount_rate1 > 0) {
          calculate_discount_price1 = calculate_discount_price1.toLocaleString();
          message =`(-${calculate_discount_price1} ${calculate_discount_rate1}%OFF)`;
        }
      }
      return message;
    }
  },
  filters: {
    number_format(num) {
      return num.toLocaleString();
    }
  },
  methods: {
    input_is_valid() {
      this.is_discount_price_disabled = true;
      this.is_discount_rate_disabled = true;
      if (this.discount_type1 ==='price') {
        this.is_discount_price_disabled = false;
        this.discount_rate1 = '';
      } else if(this.discount_type1 ==='rate') {
        this.is_discount_rate_disabled = false;
        this.discount_price1 = '';
      } else if (this.discount_type1 === 'none') {
        this.discount_price1 = '';
        this.discount_rate1 = '';
      }
    }
  }
}
</script>
<style scoped>
  h1 {
    color: red
  }
</style>