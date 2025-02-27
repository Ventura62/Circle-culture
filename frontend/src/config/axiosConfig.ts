import axios from "axios";

const axiosInstance = axios.create({
  baseURL: process.env.NEXT_API_BASE_URL,
  headers: {
    "Content-Type": "application/json",
  },
});
// queries to this instance will not show success in the browser
export const axiosPrivateInstance = axios.create({
  baseURL: process.env.NEXT_API_BASE_URL,
  headers: {
    "Content-Type": "application/json",
  },
});

// // Add a request interceptor
// axiosInstance.interceptors.request.use(
//   async (config) => {
//     const token = await getToken();
//     config.headers.Authorization = `Bearer ${token}`;
//     return config;
//   },
//   (error) => {
//     return Promise.reject(error);
//   }
// );

// Add a request interceptor
// axiosPrivateInstance.interceptors.request.use(
//   async (config) => {
//     const token = await GetMSALAccessToken();
//     config.headers.Authorization = `Bearer ${token}`;
//     return config;
//   },
//   (error) => {
//     return Promise.reject(error);
//   }
// );

//

export default axiosInstance;
