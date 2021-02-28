import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "/admin/products/create",
            name: "adminProductsCreate",
            component: require("./components/Admin/Pages/products/create.vue").default
        },
        {
            path: "/admin/variations",
            name: "adminVariations",
            component: require("./components/Admin/Pages/variations/index.vue").default
        },
        {
            path: "/admin/variations/:variation/edit",
            name: "adminVariationsEdit",
            component: require("./components/Admin/Pages/variations/edit.vue").default
        },
        {
            path: "/admin/attributes/create",
            name: "adminAttributesCreate",
            component: require("./components/Admin/Pages/attributes/create.vue").default
        },
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
            path: "/carrito",
            name: "carrito",
            component: require("./components/pages/Carrito.vue").default
        },
        {
            path: "/checkout",
            name: "checkout",
            component: require("./components/pages/Checkout.vue").default
        },
        {
            path: "/:product",
            name: "product",
            component: require("./components/pages/ProductPage.vue").default
        },
       
       
    ],
    mode: "history"
});
