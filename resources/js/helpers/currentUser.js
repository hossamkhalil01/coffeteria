import { currentUser } from "@services/authenticationService.js";

export const role = currentUser.is_admin ? "admin" : "user";
export const avatar = currentUser.avatar;
export const email = currentUser.email;
export const roomId = currentUser.room_id;
export const id = currentUser.id;
