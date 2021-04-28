const dateFormat = require("dateformat");

export const priceFormatter = (price) => {
    const formatter = Intl.NumberFormat("eg-US", {
        style: "currency",
        currency: "EGP",
        minimumFractionDigits: 2,
    });
    return formatter.format(price);
};

export const dateFormatter = (dateString) => {
    const date = new Date(dateString);
    return dateFormat(date, "ddd, mmm d, yyyy, h:MM TT ");
};

export const getTodayDateString = () => {
    let today = new Date();

    const dd = String(today.getDate()).padStart(2, "0");
    const mm = String(today.getMonth() + 1).padStart(2, "0");
    const yyyy = today.getFullYear();

    today = yyyy + "-" + mm + "-" + dd;
    return today;
};
