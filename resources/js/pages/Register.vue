<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register Form</h4>
                        <form @submit.prevent="register">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" v-model="form.name" name="name" class="form-control" placeholder="Enter Your Name">
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" v-model="form.email" name="email" class="form-control" placeholder="Enter Your Email Address">
                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" v-model="form.password" name="password" class="form-control" placeholder="Enter Your password">
                                <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" v-model="form.password_confirmation" name="password_confirmation" class="form-control" placeholder="Enter Your password">
                                <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mt-4">Register</button>
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
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';

const authstore = useAuthStore();
const router = useRouter();

let form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

let errors = ref([]);

const register = async() => {
    axiosClient.post('/auth/register', form)
    .then((response) => {
         authstore.setToken(response.data.data.user.token)
        authstore.setUserName(response.data.data.user.name)
        router.push({ name: 'Dashboard'});
    })
    .catch((err) => {
        errors.value = err.response.data.message;
    })
}
</script>
