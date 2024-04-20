<template>
    <div class="container">
      <div class="row">
        <div v-for="movie in movies" :key="movie.id" class="card mb-3 me-3 p-0" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img :src="'/storage/posters/' + movie.poster" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ movie.title }}</h5>
                <p class="card-text">{{ movie.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  
  let movies = ref([]);
  
  const fetchMovies = () => {
    fetch("http://localhost/api/movies", {
      method: 'GET',
      headers: {
        'accept': 'application/json',
        'authorization': `Bearer ${localStorage.getItem('token')}`
      }
    })
    .then(response => response.json())
    .then(data => {
      movies.value = data.movies;
      localStorage.setItem('isLoggedIn', true);

    })
    .catch(error => {
      console.error('Error:', error);
    });
  };
  
  onMounted(fetchMovies);
  
  </script>
  
  <style scoped>
  /* Add your custom CSS styles or Bootstrap classes here */
  </style>
  