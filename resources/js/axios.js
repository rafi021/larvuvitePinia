import axios from "axios";

const axiosClient = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/v1'
})


axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${localStorage.getItem('token')}`
    return config;
})

//   axiosClient.interceptors.response.use(response => {
//     return response;
//   }, error => {
//     if (error.response.status === 401) {
//       sessionStorage.removeItem('TOKEN')
//       router.push({name: 'HomePage'})
//     } else if (error.response.status === 404) {
//       router.push({name: 'NotFound'})
//     }
//     throw error;
//   })

  export default axiosClient;
