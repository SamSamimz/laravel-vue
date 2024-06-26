export function auth(router) {
    if (!localStorage.getItem("auth_token")) {
        router.push({ name: "Login" });
        return false;
    }else {
        return true;
    }
}