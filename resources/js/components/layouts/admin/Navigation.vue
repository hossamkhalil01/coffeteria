<template>
  <div class="">
    <nav
      class="row navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5"
    >
      <div class="container-fluid align-items-baseline me-auto">
        <router-link :to="{ name: 'AdminHome' }" class="nav-item nav-link me-4">
          <img src="/images/logo.png" width="100" height="50" />
        </router-link>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'AdminHome' }" class="nav-item nav-link"
                >Home
              </router-link>
            </li>
            <li class="nav-item ms-4">
              <router-link
                :to="{ name: 'AdminProducts' }"
                class="nav-item nav-link"
                >Products</router-link
              >
            </li>
            <li class="nav-item ms-4">
              <router-link
                :to="{ name: 'AdminUsers' }"
                class="nav-item nav-link"
                >Users</router-link
              >
            </li>
            <li class="nav-item ms-4">
              <router-link
                :to="{ name: 'AdminOrder' }"
                class="nav-item nav-link"
                >Manual Order</router-link
              >
            </li>
            <li class="nav-item ms-4">
              <router-link
                :to="{ name: 'AdminChecks' }"
                class="nav-item nav-link"
                >Checks</router-link
              >
            </li>
          </ul>
        </div>
        <!-- Right Side Of Navbar -->
        <div class="dropdown col-1">
          <a
            href="#"
            class="d-block link-dark text-decoration-none dropdown-toggle"
            id="dropdownUser1"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              :src="getUserAvatar(currentUser)"
              alt="avatar"
              width="32"
              height="32"
              class="rounded-circle"
            />
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li>
              <router-link :to="{ name: 'AdminProfile' }" class="dropdown-item"
                >Profile</router-link
              >
            </li>
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
      </div>
    </nav>
  </div>
</template>



<script>
import * as currentUser from "@helpers/currentUser.js";
import { getUserAvatar } from "@services/usersService.js";
import { publicBase } from "@helpers/urls.js";
import { csrf } from "@services/authenticationService.js";

export default {
  data() {
    return {
      csrf: csrf,
      getUserAvatar: getUserAvatar,
      currentUser: currentUser,
      publicBase: publicBase,
    };
  },

  methods: {},
};
</script>
