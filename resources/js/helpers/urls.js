// base URLs
export const domainBase = process.env.MIX_APP_URL + "/";
console.log(process.env.MIX_APP_URL);
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
