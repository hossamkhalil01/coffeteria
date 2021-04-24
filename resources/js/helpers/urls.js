// base URLs
export const base = "http://localhost:8000/";
export const apiBase = base + "api/";
export const publicBase = base + "public/";
export const imgBase = base + "storage/images/";

// images urls
export const productsImgBase = imgBase + "products/";
export const avatarsImgBase = imgBase + "avatars/";

// resources URLs
export const ordersUrlBase = apiBase + "orders/";

export const getOrderUrl = (orderId) => {
    return `${ordersUrlBase}${orderId}`;
};
