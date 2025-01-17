import { createInertiaApp } from "@inertiajs/vue3";
import axios from "axios";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, DefineComponent, h } from "vue";
import { ZiggyVue } from "ziggy-js";
import "bootstrap";

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${ title ? title + " - " : "" }${ appName }`,
    resolve: (name) =>
        resolvePageComponent(
            `./views/${ name }.vue`,
            import.meta.glob<DefineComponent>("./views/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
