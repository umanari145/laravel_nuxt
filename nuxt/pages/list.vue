<template>
  <div style="margin:0 0 0 40px;">
    <h1>検索とフィルタリング</h1>
      <div class="col-8" id="search">
        <div class="d-flex align-items-center">
          <span class="col-1">総合点</span><span class="ml-1 col-1 strong text-right">{{total_score | number_format}}</span>
        </div>
        <div class="d-flex align-items-center mt-2">
          <span class="col-1">スコア: </span>
          <b-form-input type="number" v-model="target_score" class="text-right col-1 ml-1"></b-form-input>
          <span class="ml-1">以上</span> 
        </div>
        <div class="d-flex align-items-center mt-2">
          <span class="col-1">年齢: </span>
          <b-form-input type="number" v-model="target_age" class="text-right col-1 ml-1"></b-form-input>
          <span class="ml-1">歳以上</span>
        </div>
      </div>

      <div class="d-flex col-8 justify-content-end">
        <b-button id="show-btn" variant="primary" @click="showModal">追加</b-button>
        <b-modal ref="my-modal" class="custom_modal" hide-footer title="メンバー追加">
          <div class="d-block text-center col-10">
            <div class="d-flex align-items-center">
              <span class="col-3">名前: </span>
              <b-form-input v-model="input_name" class="col-8 ml-1"></b-form-input>
            </div>
            <div class="d-flex align-items-center mt-2">
              <span class="col-3">年齢: </span>
              <b-form-input type="number" v-model="input_age" class="col-3 ml-1"></b-form-input>
            </div>
            <div class="d-flex align-items-center mt-2">
              <span class="col-3">スコア: </span>
              <b-form-input type="number" v-model="input_score" class="col-3 ml-1"></b-form-input>
            </div>
          </div>
          <b-button class="mt-3" variant="outline-danger" block @click="hideModal">閉じる</b-button>
          <b-button class="mt-2" variant="outline-warning" block @click="addMember">追加</b-button>
          <div class="modal_spinner" v-if="is_loading === 1">
            <b-spinner type="grow" label="Loading..."></b-spinner>
          </div>
        </b-modal>
      </div>
      <table class="mt-2 table b-table table-hover col-8">
        <thead>
          <tr>
            <th> </th>
            <th>ID</th>
            <th>名前</th>
            <th>年齢</th>
            <th>スコア</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for=" (member, index) in selected_members" :key="index">
            <td>
              <input type="checkbox">
            </td>
            <td>
              {{member.id}}
            </td>
            <td>
              {{member.name}}
            </td>
            <td>
              {{member.age}}
            </td>
            <td>
              {{member.score}}
            </td>
            <th>
              <b-button variant="primary">
              編集
              </b-button>
            </th>
          </tr>
        </tbody>
      </table>
      <div class="mt-4">
        カスタマイズテーブル
        <b-table hover :items="selected_members"></b-table>
      </div>
  </div>
</template>
<script>
export default {
  name: 'list',
  data() {
    return {
      target_score:'',
      target_age: '',
      input_name: '',
      input_age: '',
      input_score: '',
      is_loading: 0,
      members: [
        {
          'id': '1',
          'name': 'yamada',
          'age': 22,
          'score': 650
        },
        {
          'id': '2',
          'name': 'tanaka',
          'age': 34,
          'score': 700
        },
        {
          'id': '3',
          'name': 'watanabe',
          'age': 19,
          'score': 900
        },                
      ]
    }
  },
  computed: {
    total_score() {
      let summed_score = 0;
      this.selected_members.forEach((member) => {
        summed_score += member.score;
      });
      return summed_score;
    },
    selected_members() {
      // 検索条件を対象にする
      return this.members.filter((member) => {
        return member.score >= this.target_score &&
          member.age > this.target_age
      });
    }
  },
  filters: {
    number_format(num) {
      return num.toLocaleString();
    }
  },
  methods: {
    showModal() {
      this.$refs['my-modal'].show()
    },
    hideModal() {
      this.$refs['my-modal'].hide()
    },
    addMember() {
      this.is_loading = 1
      // 入力 (APIの代わり)
      setTimeout(() => {
        alert('登録しました。')
        this.is_loading = 0;
        let member = {};
        member = {
          'id': this.members.length + 1,
          'name': this.input_name,
          'age': parseInt(this.input_age),
          'score': parseInt(this.input_score)
        },
        this.members.push(member);
        this.$refs['my-modal'].hide();
        this.input_name = '';
        this.input_age = '';
        this.input_score = '';
      }, 1500)
    }
  }
}
</script>
<style scoped>
  h1 {
    color: red
  }
  .modal-content {
    position: relative;
  }
  .modal_spinner {
    /** 計算めんどいので暫定的に **/
    position: absolute;
    top: 70px;
    left: 234px;
  }
</style>