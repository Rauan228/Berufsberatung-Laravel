import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '../src/assets/main.css'

createInertiaApp({
    resolve: name => import(`./components/${name}.vue`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})
