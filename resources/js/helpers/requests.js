export const post = async (url, body) => {
    return axios.post(url, body);
};

export const patch = async (url, body) => {
    return axios.patch(url, body);
};

export const get = async (url, params) => {
    return axios.get(url, { params });
};
