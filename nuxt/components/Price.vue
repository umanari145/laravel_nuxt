<template>
  <div style="margin:0 0 0 40px;">
    <div class="d-flex align-items-center mt-2">
        <div class="col-3">{{label}}</div>

        <div class="col-9">

        <span class="col-1">{{ discounted_price | number_format}} </span> <span class="text-danger">{{discount_message}}</span>

        <div class="d-flex align-items-center mt-2">
            <span class="col-3">
            <input type="radio" v-model="discount_type" id="discount_type_price" value="price" @change="input_is_valid()">
            <label for="discount_type_price" class="ml-1">値引き</label>
            </span>
            <b-form-input type="number" v-model="discount_price" class="text-right col-2 ml-2" :disabled="is_discount_price_disabled"></b-form-input>
        </div>

        <div class="d-flex align-items-center mt-2">
            <span class="col-3">
            <input type="radio" v-model="discount_type" id="discount_type_rate" value="rate" @change="input_is_valid()">
            <label for="discount_type_rate" class="ml-1">割合</label>
            </span>
            <b-form-input type="number" v-model="discount_rate" class="text-right col-2 ml-2" :disabled="is_discount_rate_disabled"></b-form-input>
        </div>

        <div class="d-flex align-items-center mt-2">
            <span class="col-3">
            <input type="radio" v-model="discount_type" id="discount_type_none" value="none" @change="input_is_valid()">
            <label for="discount_type_none" class="ml-1">割引なし</label>
            </span>
        </div>
        </div>
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
  props: {
    label:{
      type:String,
      required:true,
      default:''
    },
    constant_price:{
      type:String,
      required:true,
      default:''
    },
    p_discount_type:{
      type:String,
      required:true,
      default:''
    },
    p_discount_price:{
      type:String,
      required:true,
      default:''
    },
    p_discount_rate:{
      type:String,
      required:true,
      default:''
    }
  },
  computed: {
    discounted_price() {
      let discounted_price = this.constant_price;
      if (this.discount_type === 'price') {
        if (this.discount_price !=='') {
          discounted_price = (this.constant_price - this.discount_price);
        }
      } else if (this.discount_type === 'rate') {
        if (this.discount_rate > 0) {
          discounted_price = (this.constant_price * this.discount_rate/100);
        }
      }
      return discounted_price;
    },
    discount_message() {
      let message = '';
      let calculate_discount_price = '';
      let calculate_discount_rate = '';
      if (this.discount_type === 'price' || this.discount_type === 'rate') {
        if (this.discount_type === 'price') {
          calculate_discount_price = this.discount_price;
          calculate_discount_rate = parseInt(this.discount_price / this.constant_price * 100);
        } else if (this.discount_type === 'rate') {
          calculate_discount_price = parseInt(this.constant_price * this.discount_rate / 100);
          calculate_discount_rate = this.discount_rate
        }
        if (calculate_discount_price > 0 && calculate_discount_rate > 0) {
          calculate_discount_price = calculate_discount_price.toLocaleString();
          message =`(-${calculate_discount_price} ${calculate_discount_rate}%OFF)`;
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
      if (this.discount_type ==='price') {
        this.is_discount_price_disabled = false;
        this.discount_rate = '';
      } else if(this.discount_type ==='rate') {
        this.is_discount_rate_disabled = false;
        this.discount_price = '';
      } else if (this.discount_type === 'none') {
        this.discount_price = '';
        this.discount_rate = '';
      }
    }
  },
  created() {
      this.discount_type = this.p_discount_type;
      this.discount_price = this.p_discount_price;
      this.discount_rate = this.p_discount_rate;
  },
  data() {
    return {
      is_discount_price_disabled: false,
      is_discount_rate_disabled: false,
      discount_type: '',
      discount_price: '',
      discount_rate:''
    }
  }
}
</script>