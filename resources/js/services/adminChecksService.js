import * as request from "@helpers/requests.js";

export const getAllChecks = () => {
    return request.get("orders");
};

export const getChecksByParmas = ({ owner_id, from, to }) => {
    return request.get("orders", { owner_id, from, to });
};
