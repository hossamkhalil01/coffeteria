import * as request from "@helpers/requests.js";
import { apiBase } from "@helpers/urls.js";

export const getUsersResource = (params, url = "") => {
    if (!url) url = apiBase + "users";
    return request.get(url, params);
};
