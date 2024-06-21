import { defineStore  } from "pinia";
import jwt from "jsonwebtoken";

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            token: localStorage.getItem('token'),
        }
    },
    getters: {
        isAuthenticated: (state) => !!state.token
    },
    actions: {
        login(token) {
            this.token = token;
            localStorage.setItem('token', token);
        },
        logout() {
            this.token = null;
            localStorage.removeItem('token');
        },
        decodeToken() {
            if (this.token) {
                return jwt.decode(this.token);
            }
            return null;
        },
    }
});