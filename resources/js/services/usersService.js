import * as request from "@helpers/requests.js";
import { apiBase, avatarsImgBase } from "@helpers/urls.js";

export const getUsersResource = (params, url = "") => {
    if (!url) url = apiBase + "users";
    return request.get(url, params);
};

export const getUserAvatar = (user) => {
    // not joined with social auths
    if (!user.provider) {
        return avatarsImgBase + user.avatar;
    }
    return user.avatar;
};
