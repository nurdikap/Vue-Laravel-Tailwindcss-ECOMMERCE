import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "/",
            name: "home",
            component: require("./components/index.vue").default
        },
        {
            path: "/test/:id",
            name: "test",
            component: require("./components/index.vue").default,
            
        },
    
      
      
    
    ],
    mode: "history"
});
