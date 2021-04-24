import * as request from "@helpers/requests.js";
import { ordersUrlBase, getOrderUrl } from "@helpers/urls.js";

export const getChecksResource = (params = {}, url = ordersUrlBase) => {
    return request.get(url, params);
};

export const getOrderProducts = (orderId, params = {}, url = "") => {
    return request.get(getOrderUrl(orderId), params);
};
