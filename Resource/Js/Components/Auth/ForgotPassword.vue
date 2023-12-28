<template>
<div class="shadow rounded-4">

  <h3 class="text-center bg-primary text-light p-4 mb-0 rounded-top-4">Forgot Password</h3>

  <div class="rounded-bottom-4 p-4">

    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <div class="form-floating mb-4">
      <input :value="email" @input="email = $event.target.value" type="email" name="email" class="form-control" id="floatingInput">
      <label for="floatingInput">Email address</label>
    </div>

    <div v-if="message" class="form-floating mb-4">
      <input :value="otp" @input="otp = $event.target.value" type="text" name="otp" class="form-control" id="floatingInputOTP">
      <label for="floatingInputOTP">OTP</label>
    </div>

    <div v-if="message" class="form-floating mb-4">
        <input :value="password" @input="password = $event.target.value" type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>

    <div class="form-floating">
      <button v-if="!message" @click="sendOTP" type="submit" class="btn btn-primary">Send OTP</button>
      <button v-if="message" @click="checkOTPUpdate" type="submit" class="btn btn-primary">Check and Update</button>
      <a class="d-inline-block btn btn-link" href="/login">Sign In Here</a>
    </div>
      
  </div>

</div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      email: "",
      otp: "",
      password: "",
      error: "",
      message: "",
    };
  },

  methods: {
    async sendOTP() {
      this.error = "";
      this.message = "";

      let fd = new FormData();
      fd.append("email", this.email);

      let res = await axios.post("/mail", fd).then((res) => res.data);
      if (res.error) {
        this.error = res.error;
      }
      if (res.message) {
        this.message = res.message;
      }
    },

    async checkOTPUpdate(){
      this.error = "";

      let fd = new FormData();
      fd.append("email", this.email);
      fd.append("otp", this.otp);
      fd.append("password", this.password);

      let res = await axios.post("/update_password", fd).then((res) => res.data);

      if (res.error) {
        this.error = res.error;
      }

      if (res.message) {
        window.location = "/login";
      }

    }
  },
};
</script>