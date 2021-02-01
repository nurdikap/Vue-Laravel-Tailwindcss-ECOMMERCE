import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "/",
            name: "home",
            component: require("./components/pages/index.vue").default
        },
        {
            path: "/categorias/",
            name: "categorias",
            component: require("./components/pages/CategoriasPage.vue").default
        },
        {
            path: "/:category/:subcategory",
            name: "subcategory",
            component: require("./components/pages/ProductsPage.vue").default
        },
        {
            path: "/:product",
            name: "product",
            component: require("./components/pages/ProductPage.vue").default
        }
    ],
    mode: "history"
});
