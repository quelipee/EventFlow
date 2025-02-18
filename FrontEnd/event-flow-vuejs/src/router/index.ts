import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignInView from '@/views/SignInView.vue'
import SignUpView from '@/views/SignUpView.vue'
import NewEvent from '@/views/NewEvent.vue'
import EditEvent from '@/views/EditEvent.vue'

const requireAuth = (to : RouteLocationNormalized, from : RouteLocationNormalizedLoadedGeneric, next : NavigationGuardNext) => {
  if (!localStorage.getItem('token')) {
    next('/')
  } else {
    next()
  }
};

const noRequireAuth = (to : RouteLocationNormalized, from : RouteLocationNormalizedLoadedGeneric, next : NavigationGuardNext) => {
  if (localStorage.getItem('token')) {
    next('/homepage')
  } else {
    next()
  }
};

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: SignInView,
      beforeEnter: noRequireAuth
    },
    {
      path: '/register',
      name: 'register',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: SignUpView,
      beforeEnter: noRequireAuth
    },
    {
      path: '/homepage',
      name: 'homepage',
      component: HomeView,
      beforeEnter: requireAuth
    },
    {
      path: '/newEvent',
      name: 'newEvent',
      component: NewEvent,
      beforeEnter: requireAuth
    },
    {
      path: '/editEvent/:id',
      name: 'editEvent',
      component: EditEvent,
      beforeEnter:requireAuth
    }
  ],
})

export default router
