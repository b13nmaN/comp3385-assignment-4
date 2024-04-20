<template>
    <div class="container">
      <h2>Login</h2>
      <form @submit.prevent="login" id="login-form" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" v-model="email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      login() {
        let loginForm = document.getElementById('login-form');
        const formData = new FormData(loginForm);

        fetch('http://localhost/api/v1/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
          email: this.email,
          password: this.password
        })
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          // Store token in localStorage
          localStorage.setItem('token', data.access_token);
          localStorage.setItem('isLoggedIn', true);
          // Emit an event to notify parent component about login status change
          this.$emit('login', true);
          // Redirect to another route upon successful login
          this.$router.push('/movies'); // Change '/dashboard' to your desired route
        })
        .catch(error => {
          console.error('Error:', error);
          // Handle error (e.g., show error message to user)
        });
      }

      
    }
  };
  </script>
  
  <style scoped>
  /* Add your custom CSS styles or Bootstrap classes here */
  </style>
  