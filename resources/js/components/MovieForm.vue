<template>
    <div>
      <div v-if="success" class="alert alert-success" role="alert">
        {{ message }}
      </div>
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
                <input type="file" name="poster"  accept="image/*" class="form-control" />
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
      },
      success: false,
      message: '',
    };
  },
  methods: {
    saveMovie() {
      
 
      fetch("http://localhost/api/movies", {
        
        method: 'POST',
        body: formData,
        headers: {
          'accept': 'application/json',
          'authorization': `Bearer ${localStorage.getItem('token')}`
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log(data); // Display a success message or handle the response
        this.success = true;
        this.message = data.message;
      })
      .catch(error => {
        console.error('Error:', error);
      });
    },

  }
}
</script>

<style lang="">

</style>
