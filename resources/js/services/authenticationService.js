export const csrf = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

export const currentUser = JSON.parse(
    document.querySelector('meta[name="user"]').getAttribute("content")
);
