import * as request from "@helpers/requests.js";
import { roomsUrlBase } from "@helpers/urls.js";

export const getRoomsResource = (url = roomsUrlBase) => {
    return request.get(url);
};
