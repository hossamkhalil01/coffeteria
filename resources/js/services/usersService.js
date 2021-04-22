import * as request from "@helpers/requests.js";

export const getAllUsers = () => {
    return request.get("/users");
};
