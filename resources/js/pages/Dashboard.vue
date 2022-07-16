<template>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            Dashboard Page {{ authstore.getToken }}
        </div>
    </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axiosClient from '../axios';
import { useAuthStore } from '../stores/auth';

const authstore = useAuthStore();
const user = ref([]);
const loadUser = async() => {
    const res = await axiosClient.get('/user')
    .then((response) => {
        console.log(response);
        user.value = response.data;
    })
    .catch((err) => {
        console.log(err);
    });
}

onMounted(()=>{
    loadUser()
})

</script>
