<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";

import { ref } from 'vue';
import { RouterView } from 'vue-router';


// Define a reactive variable to track the user's login status
const isLoggedIn = ref(false);

// Function to handle login event
const handleLogin = (status) => {
  isLoggedIn.value = status;
};
</script>

<template>
    <Header :isLoggedIn="isLoggedIn" />
    <div class="container my-5">
        <RouterView @login="handleLogin"/>
    </div>
    <Footer />
</template>

<style scoped>

</style>
