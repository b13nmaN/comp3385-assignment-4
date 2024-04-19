<template>
    <div>
        <h1>Movie Form</h1>
        <form @submit.prevent="saveMovie" enctype="multipart/form-data" id="movie-form">
            <div class="form-group mb-3">
                <label for="title" class="form-label">Movie Title</label>
                <input type="text" name="title" v-model="movie.title" class="form-control" />
            </div>
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" v-model="movie.description" class="form-control"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" name="poster" @change="handleFileUpload" accept="image/*" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary">Save Movie</button>
        </form>
    </div>
</template>

<script>
export default {
  data() {
    return {
      movie: {
        title: '',
        description: '',
        poster: null, // Now this will be a File object
      }
    };
  },
  methods: {
    saveMovie() {
      let movieForm = document.getElementById('movie-form');
      const formData = new FormData(movieForm);

      if (this.movie.poster instanceof File) {
        formData.append('poster', this.movie.poster);
      }

      const movieData = { ...this.movie, poster: undefined };
      console.log("This is movieData: ", movieData);
      formData.append('movie', movieData);

      
      console.log("This is formData: ", formData);
      fetch("http://localhost/api/movies", {
        
        method: 'POST',
        body: formData,
        headers: {
          'accept': 'application/json',
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log(data); // Display a success message or handle the response
      })
      .catch(error => {
        console.error('Error:', error);
      });
    },
    handleFileUpload(event) {
      this.movie.poster = event.target.files[0];
      console.log("This is this.movie: ", this.movie);
    }
  }
}
</script>

<style lang="">

</style>
