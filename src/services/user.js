import axios from "axios";

const url = 'http://infohic3.beget.tech/';
//const url = 'http://brain-server/';

const userRegistration = (email, username, password) => {
    return axios.post(url + 'api/registration', {email: email, username: username, password: password}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const userLogin = (username, password) => {
    return axios.post(url + 'api/login', {username: username, password: password}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const userCheckToken = (token) => {
    return axios.post(url + 'api/checkauth', {token: token}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const getUserInfo = (token) => {
    return axios.post(url + 'api/getuserinfo', {token: token}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const setUserInfo = (token, username = undefined, email = undefined, password = undefined) => {
    return axios.post(url + 'api/changeinfo', {token: token, username: username, email: email, password: password}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const like = (id, token) => {
    return axios.post(url + 'api/like', {token: token, id: id}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const getSettings = () => {
    return axios.get(url + 'api/settings.get');
}

export default {userRegistration, userLogin, userCheckToken, getUserInfo, setUserInfo, like, getSettings}