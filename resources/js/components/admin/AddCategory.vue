<template>
  <div class="container">
    <div class="bg_move">
      <i class="fas fa-palette"></i>
      <h1>ADD Category</h1>
    </div>
    <form
      v-on:submit.prevent="addCategory"
      :class="['form-group', allerros.label ? 'has-error' : '']"
    >
      <div class="form-group">
        <div class="row m-5">
          <div class="col-1" ms-2>
            <label
              for="Name"
              style="font-weight: bold; font-size: 20px; color: #b44b4b"
              >Category</label
            >
          </div>
          <div class="col-3">
            <input
              type="text"
              name="label"
              class="form-control"
              id="Name"
              style="height: 40px; border-radius: 20"
              aria-describedby="emailHelp"
              placeholder="Enter Categoryname"
              v-model="form.label"
            />
          </div>
        </div>
      </div>
      <button
        type="submit"
        class="ms-5 btn btn-info m-3"
        style="height: 50px; width: 10%"
      >
        Submit
      </button>

      <br />
      <span
        v-if="allerros.label"
        :class="[' alert alert-danger ms-5']"
        style="height: 50px; width: 10%"
      >
        {{ allerros.label[0] }}</span
      >
    </form>
  </div>
</template>

<script>
import { apiBase } from "@helpers/urls.js";
export default {
  mounted() {},
  data() {
    return {
      apiBase: apiBase,
      form: {
        label: "",
      },
      allerros: [],
      success: false,
    };
  },
  methods: {
    addCategory() {
      axios
        .post(apiBase + "addCategory", this.form)
        .then((resp) => {
          this.allerros = [];
          this.success = true;
          //reset form
          this.form.label = "";
          if (resp.status === 200) {
            this.$router.push({ name: "AdminCreateProduct" });
          }
        })
        .catch((e) => {
          this.onFailure(e.response.data);
        });
    },
    onFailure(errorData) {
      this.allerros = errorData.errors;
      this.success = false;
    },
  },
  created() {},
};
</script>

<style scoped lang="scss">
.styling {
  background-color: aliceblue;
}

//********************start of heading style**************************************
* {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

html {
  font-size: 16px;
}

body {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  min-height: 100vh;
  background: #111;
}

.bg_move {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  background: repeating-radial-gradient(
      circle at 100% 100%,
      rgba(255, 190, 11, 0.5) 4%,
      rgba(255, 190, 11, 0.5) 8%,
      rgba(251, 86, 7, 0.5) 8%,
      rgba(251, 86, 7, 0.5) 12%,
      rgba(255, 0, 110, 0.5) 12%,
      rgba(255, 0, 110, 0.5) 16%,
      rgba(131, 56, 236, 0.5) 16%,
      rgba(131, 56, 236, 0.8) 20%,
      rgba(58, 134, 255, 0.5) 20%,
      rgba(58, 134, 255, 0.5) 24%
    ),
    repeating-radial-gradient(
      circle at 0% 100%,
      rgba(255, 190, 11, 0.7) 4%,
      rgba(255, 190, 11, 0.9) 8%,
      rgba(251, 86, 7, 0.7) 8%,
      rgba(251, 86, 7, 0.9) 12%,
      rgba(255, 0, 110, 0.7) 12%,
      rgba(255, 0, 110, 0.9) 16%,
      rgba(131, 56, 236, 0.8) 16%,
      rgba(131, 56, 236, 0.8) 20%,
      rgba(58, 134, 255, 0.8) 20%,
      rgba(58, 134, 255, 0.8) 24%
    );
  background-size: 250px 250px;
  background-position: 0 0;
  -webkit-animation: stripes 3s linear infinite;
  animation: stripes 3s linear infinite;
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
}

.bg_move h1 {
  font-size: 3rem;
  font-family: sans-serif;
}

.bg_move i {
  font-size: 3rem;
}

@media only screen and (max-width: 900px) {
  html {
    font-size: 10px;
  }
}

@media only screen and (max-width: 500px) {
  html {
    font-size: 6px;
  }
}

@-webkit-keyframes stripes {
  100% {
    background-position: 250px 0, 250px 0, 100px 0;
  }
}

@keyframes stripes {
  100% {
    background-position: 250px 0, 250px 0, 100px 0;
  }
}

//********************* end of syling header******************************************
</style>
