import * as request from "@helpers/requests.js";

export const getChecks = (params) => {
    return request.get("orders", params);
};

// export const getChecksByParmas = ({ owner_id, from, to }) => {
//     return request.get("orders", { owner_id, from, to });
// };
