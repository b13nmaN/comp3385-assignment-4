<script setup>
import { defineProps } from 'vue';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';


// Router instance
const router = useRouter();



// Define a prop to receive isLoggedIn status from parent component
const props = defineProps({
  isLoggedIn: Boolean
});

// Function to handle logout
const logout = () => {
    // Make AJAX request to logout endpoint
    fetch('/api/v1/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}` // Include JWT access token
        }
    })
    .then(response => {
        if (response.ok) {
            localStorage.removeItem('token');
            // Clear isLoggedIn status and update localStorage
            props.isLoggedIn = false;
            localStorage.setItem('isLoggedIn', false);
            
            // Redirect to login page
            router.push('/login');
        } else {
            throw new Error('Logout failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error (e.g., show error message to user)
    });
};
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">COMP3385</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/'}" to="/">Home</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/about'}" to="/about">About</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/movies/create'}" to="/movies/create">Add Movie</RouterLink>
                    </li>
                    <li class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/movies'}" to="/movies">Movies</RouterLink>
                    </li>
                    <!-- Conditional rendering for login/logout links -->
                    <li v-if="!isLoggedIn" class="nav-item">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/login'}" to="/login">Login</RouterLink>
                    </li>
                    <li v-if="isLoggedIn" class="nav-item">
                        <a class="nav-link" @click="logout" style="cursor: pointer;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
