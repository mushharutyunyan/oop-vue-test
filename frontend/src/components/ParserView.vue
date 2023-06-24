<template>
  <div class="main">
    <div v-if="loading" class="loader">
      <img src="../assets/loading.gif" width="100" height="100">
    </div>
    <div class="row">
      <span v-if="errorMessage" style="color: red">{{ errorMessage }}</span>
      <form class="wrapp" @submit="parseUrl">
        <div class="item-1"><input v-model="url" placeholder="enter url for parsing" type="url" id="url-for-parse" name="homepage"><br><br></div>
        <div class="item-2"><button class="btn">Parse</button></div>
      </form>
    </div>
    <div class="table-wrapper" style="margin-top: 15px">
      <div class="table-container">
        <table>
          <thead>
          <tr>
            <th>Tags</th>
            <th>Quantity</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(result, index) in results" :key="index">
            <td>{{ result.tag }}</td>
            <td>{{ result.qty }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<style scoped>
::-webkit-input-placeholder {
  color: #ccc;
  text-align: left;
  text-indent: 1rem;
  font-size: .9rem;
  letter-spacing: .05rem;
}

:-moz-placeholder {
  color: #ccc;
  text-align: left;
  text-indent: 1rem;
  font-size: .9rem;
  letter-spacing: .05rem;
}

::-moz-placeholder {
  color: #ccc;
  text-align: left;
  text-indent: 1rem;
  font-size: .9rem;
  letter-spacing: .05rem;
}

:-ms-input-placeholder {
  color: #ccc;
  text-align: left;
  text-indent: 1rem;
  font-size: .9rem;
  letter-spacing: .05rem;
}

input, button {
  height: 3rem;
  box-sizing: border-box;
  width: 100%;
}

input {
  border: 1px solid #ddd;;
  background: #fafafa;
  text-indent: 1rem;
  font-size: 1rem;
}

.btn {
  color: #FFFFFF;
  background-color: #2196F3;
  border: 1px solid #127ACD;
  padding: 0 1rem;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
}

.btn:hover {
  background-color: #127ACD;
}

.wrapp {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 0;
  padding: 1rem;
  width: 80%;
  min-width: 480px;
  margin: 0 auto;
}

.item-1 {
  flex: 1;
}

.item-2, .item-3 {
  min-width: 50px;
}

.loader{
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
}
</style>
<script>
import axios from "axios";

export default {
  name: 'ParserView',
  components: {},
  data() {
    return {
      url: null,
      results: [],
      errorMessage: null,
      loading: false
    }
  },
  methods: {
    async parseUrl(e) {
      e.preventDefault();
      let self = this;
      self.errorMessage = null;
      self.loading = true;
      await axios.post("http://172.20.0.10/home/parse", {
        url: self.url
      }).then(function (response) {
        self.results = response.data.data
        self.loading = false;
      }).catch((error) => {
        self.errorMessage = error.response.data.message;
        self.loading = false;
      });
    }
  },
  mounted() {
  }
}
</script>

