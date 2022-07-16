<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Login Form</h4>
                        <p v-if="error" class="text-danger">{{ error }}</p>
                        <form @submit.prevent="login">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" v-model="form.email" name="email" class="form-control" placeholder="Enter Your Email Address">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" v-model="form.password" name="password" class="form-control" placeholder="Enter Your password">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-4">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { reactive, ref } from 'vue';
import axiosClient from '../axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth';

let form = reactive({
    email: '',
    password: '',
});

let error = ref('');

const router = useRouter();
const authstore = useAuthStore();

const login = async() => {
    const response = await axiosClient.post('/auth/login', form)
    .then((res) => {
        authstore.setToken(res.data.data.user.token)
        authstore.setUserName(res.data.data.user.name)
        router.push({name: 'Dashboard'});
    })
    .catch((err) => {
        error.value = err.response.data.message;
    });
}

</script>
