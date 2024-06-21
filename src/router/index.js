import { createRouter, createWebHistory } from 'vue-router'
import TrainerList from '../views/TrainerList.vue'
import {useAuthStore} from '../store/auth'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
  },
  {
    path: '/training',
    name: 'TrainerList',
    component: TrainerList
  },
  {
    path: '/registration',
    name: 'Registration',
    component: () => import('../views/Registration.vue'),
    meta: {
      notAuthRequired: true
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue'),
    meta: {
      notAuthRequired: true
    }
  },
  {
    path: '/game',
    name: 'Game',
    component: () => import('../views/Game.vue')
  },
  {
    path: '/profile',
    name: 'Profile',
    component: () => import('../views/Profile.vue'),
    meta: {
      authRequired: true
    }
  },
  {
    path: '/stats',
    name: 'Stats',
    component: () => import('../views/Stats.vue')
  }
]

const router = createRouter({
  mode: 'history',
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();

  if (to.meta.notAuthRequired && auth.token !== null) {
    next('/training');
  } else {
    if(to.meta.authRequired && auth.token === null) {
      next('/login');
    }else {
      next();
    }
  }
});

export default router
