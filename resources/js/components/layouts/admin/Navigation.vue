<template>
  <div class="">
    <nav class="row navbar navbar-expand-lg navbar-light bg-light p-4">
      <div class="collapse navbar-collapse col-6 m-auto">
        <div class="navbar-nav">
          <router-link :to="{ name: 'AdminHome' }" class="nav-item nav-link"
            >Home</router-link
          >
          <router-link :to="{ name: 'AdminProducts' }" class="nav-item nav-link"
            >Products</router-link
          >
          <router-link :to="{ name: 'AdminUsers' }" class="nav-item nav-link"
            >Users</router-link
          >
          <router-link :to="{ name: 'AdminOrder' }" class="nav-item nav-link"
            >Manual Order</router-link
          >
          <router-link :to="{ name: 'AdminChecks' }" class="nav-item nav-link"
            >Checks</router-link
          >
        </div>
      </div>
      <div class="dropdown col-1">
        <a
          href="#"
          class="d-block link-dark text-decoration-none dropdown-toggle"
          id="dropdownUser1"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            :src="currentUser.avatar"
            alt="avatar"
            width="32"
            height="32"
            class="rounded-circle"
          />
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
          <li>
            <router-link :to="{ name: 'UserView' }" class="dropdown-item"
              >User View</router-link
            >
          </li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li>
            <form action="/logout" method="post">
              <input type="hidden" name="_token" :value="csrf" />
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>



<script>
import * as currentUser from "@helpers/currentUser.js";
import { csrf } from "@services/authenticationService.js";

export default {
  data() {
    return {
      csrf: csrf,
      currentUser: currentUser,
    };
  },

  methods: {},
};
</script>
