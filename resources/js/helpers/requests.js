import axios from "axios";

export const post = async (url, body) => {
    return axios.post(url, body);
};

export const get = async (url, params) => {
    return axios.get(url, { params });
};
