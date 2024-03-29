import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import mitt from 'mitt';
const appName = 'Admin';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const appVue = createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } });
            appVue.config.globalProperties.emitter = mitt()
            appVue.config.globalProperties.toast = mitt()
            appVue.mount(el);
        return appVue;
    },
});

InertiaProgress.init({ color: '#4B5563' });
