<template>
    <div class="container">
      <div class="row">
        <div v-for="movie in movies" :key="movie.id" class="col-md-4">
          <div class="card mb-3">
            <img :src="'/storage/posters/' + movie.poster" class="card-img-top" alt="Movie Poster">
            <div class="card-body">
              <h5 class="card-title">{{ movie.title }}</h5>
              <p class="card-text">{{ movie.description }}</p>
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
      }
    })
    .then(response => response.json())
    .then(data => {
      movies.value = data.movies;
      console.log("This is movies: ", movies.value);
      // for (let i = 0; i < movies.value.length; i++) {
      //   console.log("This is title: ", movies.value[i].title);
      //   console.log("This is description: ", movies.value[i].description);
      //   console.log("This is poster: ", movies.value[i].poster);
      // }
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
  