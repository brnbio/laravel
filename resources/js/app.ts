import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, DefineComponent, h } from "vue";
import { ZiggyVue } from "ziggy-js";

createInertiaApp({
    title: (title) => `${ title ? title + ' - ' : '' }App Name`,
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
