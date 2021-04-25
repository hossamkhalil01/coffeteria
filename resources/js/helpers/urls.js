// base URLs
export const domainBase = "http://localhost:8000/";
export const apiBase = domainBase + "api/";
export const publicBase = domainBase + "images/";
export const imgBase = domainBase + "storage/images/";

// images urls
export const productsImgBase = imgBase + "products/";
export const avatarsImgBase = imgBase + "avatars/";

// resources URLs
export const ordersUrlBase = apiBase + "orders/";

export const getOrderUrl = (orderId) => {
    return `${ordersUrlBase}${orderId}`;
};
