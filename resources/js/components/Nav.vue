<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
    <router-link class="navbar-brand" :to="{name: 'Home'}">LaVuite</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link" aria-current="page" :to="{name: 'Home'}" active-class="text=white">Home</router-link>
        </li>
        <li class="nav-item" v-if="authstore.getToken == 0">
          <router-link class="nav-link" :to="{name: 'Login'}" active-class="text=white">Login</router-link>
        </li>
        <li class="nav-item" v-if="authstore.getToken == 0">
          <router-link class="nav-link" :to="{name: 'Register'}" active-class="text=white">Register</router-link>
        </li>
        <li class="nav-item" v-if="authstore.getToken != 0">
          <router-link class="nav-link" :to="{name: 'Dashboard'}" active-class="text=white">Dashboard</router-link>
        </li>

      </ul>
      <ul class="d-flex me-5 pe-1 list-unstyled" v-if="authstore.getToken != 0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ authstore.getUserName }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" @click.prevent="logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<script setup lang="ts">
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';

const authstore = useAuthStore();
const router = useRouter();

const logout = () => {
    authstore.removeToken();
    router.push({name: 'Home'});
}

</script>
