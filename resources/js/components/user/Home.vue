<template>
  <div class="">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <router-link to="/" class="nav-item nav-link">Home</router-link>
          <router-link to="/order" class="nav-item nav-link"
            >Orders</router-link
          >
            <router-link to="/admin" class="nav-item nav-link"
            >Admin view</router-link
          >
        </div>
      </div>
      <div class="navbar-nav">
        <form action="/logout" method="post">
          <input type="hidden" name="_token" :value="csrf" />
          <button type="submit" class="btn btn-primary">Logout</button>
        </form>
      </div>
    </nav>
    <router-view />
  </div>
</template>

