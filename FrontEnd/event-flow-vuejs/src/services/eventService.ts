import axios from "axios";
import type {EventStore, User} from "@/interfaces/type.ts";

const api = axios.create({
  baseURL: import.meta.env.VITE_APP_BACKEND_URL,
  withCredentials: true,
  headers:{
    'Content-Type' : 'application/json',
  }
});

const apiAuth = axios.create({
  baseURL: import.meta.env.VITE_APP_BACKEND_URL,
  withCredentials: true,
  headers:{
    'Content-Type': 'application/json',
  }
});

apiAuth.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  } else {
    console.warn('Token not found!');
  }
  return config;
}, (error) => {
  return Promise.reject(error);
});

const apiToken = axios.create({
  baseURL: import.meta.env.VITE_APP_TOKEN,
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
  }
});
export const getToken = async () => {
  return await apiToken.get('/sanctum/csrf-cookie');
}

export const signInAuthenticated = async (user : User) => {
  await getToken();
  return api.post('/signIn',{
    email: user.email,
    password: user.password
  }).then((res) => {
    console.log(res);
    const token = res.data.data.token;
    localStorage.setItem('token',token);
    return res.data;
  });
}

export const signUpAuthenticated = async (user: User) => {
  return api.post('/signUp',{
    name: user.name,
    email: user.email,
    password: user.password,
    passwordRepeat: user.passwordRepeat
  }).then((res) => {
    return res.data;
  });
}

export const getAllEvent = async () => {
  const response = await apiAuth.get('event');
  return response.data;
}

export const addEventPost = async (event : EventStore) => {
  const response = await apiAuth.post('event/create', {
    title: event.title,
    description: event.description,
    eventStart: event.eventStart,
    eventEnd: event.eventEnd,
  });
  console.log(response.data);
}

export const editEventPut = async (event : EventStore) => {
  const response = await apiAuth.put('event/edit/'+ event.id ,{
    title: event.title,
    description: event.description,
    eventStart: event.eventStart,
    eventEnd: event.eventEnd
  });
  console.log(response.data);
}

export const destroyEventDelete = async (eventId : number) => {
  const response = await apiAuth.delete('event/delete/' + eventId);
  console.log(response.data);
  return response.data;
}
