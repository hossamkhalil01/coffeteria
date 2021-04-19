<template>
    <div class="">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link text-white"
                        >Home</router-link
                    >
                    <router-link
                        to="/order"
                        class="nav-item nav-link text-white"
                        >Orders</router-link
                    >
                </div>
            </div>
            <div class="navbar-nav align-items-baseline">
                <div class="nav-item me-3">
                    <img class="profile-img" :src="getAvatar()" />
                </div>
                <form action="/logout" method="post">
                    <input type="hidden" name="_token" :value="csrf" />
                    <button type="submit" class="btn btn-secondary btn-sm me-3">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
        <router-view />
    </div>
</template>

<script>
import { csrf, user } from "../main.js";

export default {
    mounted() {
        console.log("App main component mounted.");
    },
    data() {
        return {
            csrf: csrf,
            user: user,
        };
    },

    methods: {
        getAvatar() {
            return this.user.avatar;
        },
    },
};
</script>
<style scoped>
.profile-img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}
</style>
