import { apiBase } from "@helpers/urls.js";
import axios from "axios";

export const post = async (url, body) => {
    return axios.post(`$(apiBase)$(url)`, body);
};

export const get = async (url, params) => {
    return axios.get(`${apiBase}${url}`, null, {
        params,
    });
};
