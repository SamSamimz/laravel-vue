export function guest(router) {
    if (localStorage.getItem("auth_token")) {
        router.push({ name: "Home" });
        return false;
    }else {
        return true;
    }
}