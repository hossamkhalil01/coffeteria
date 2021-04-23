import * as request from "@helpers/requests.js";
import { apiBase } from "@helpers/urls.js";

export const getUsersResource = (params, url = "") => {
    if (!url) return request.get(apiBase + "users", params);

    return request.get(url, params);
};
