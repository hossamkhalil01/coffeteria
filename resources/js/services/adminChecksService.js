import * as request from "@helpers/requests.js";
import { apiBase } from "@helpers/urls.js";

export const getChecksResource = (params, url = "") => {
    if (!url) return request.get(apiBase + "orders", params);

    return request.get(url, params);
};
