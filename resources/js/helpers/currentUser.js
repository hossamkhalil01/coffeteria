import { currentUser } from "@services/authenticationService.js";

export const name = currentUser.name;
export const role = currentUser.is_admin ? "admin" : "user";
export const avatar = currentUser.avatar;
export const provider = currentUser.provider;
export const email = currentUser.email;
export const roomId = currentUser.room_id;
export const id = currentUser.id;
