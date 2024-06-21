import axios from "axios";

const url = 'https://lk.shamil-ahmadullin.ru/';
// const url = 'http://brain-server/';

const gameGetAll = (token) => {
    return axios.get(url + 'api/game.all', {params: {token: token}});
}

const gameGetLiked = (token) => {
    return axios.get(url + 'api/game.getliked', {params: {token: token}});
}

const gameGetOne = (id) => {
    return axios.get(url + 'api/game.get', {params: {id: id}});
}

const gameEnd = (data) => {
    return axios.post(url + 'api/game.end', {data: data}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const gameCreateSession = (token) => {
    return axios.post(url + 'api/game.create_session', {token: token}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}

const gameGetStats = (id) => {
    return axios.get(url + 'api/game.getstats', {params: {game_id: id}});
}

const gameGetAllStats = (token) => {
    return axios.post(url + 'api/game.getallstats', {token: token}, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});
}


export default {gameGetAll, gameGetOne, gameEnd, gameCreateSession, gameGetStats, gameGetAllStats, gameGetLiked}