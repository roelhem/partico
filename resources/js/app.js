require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import { createHttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';
import { ApolloClient } from 'apollo-client';
import PortalVue from 'portal-vue';
import VueApollo from 'vue-apollo';
import VTooltip from 'v-tooltip';
import VSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

// Vue
Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueApollo);
Vue.use(VTooltip);
Vue.component('v-select', VSelect);

// Apollo

const token = document.head.querySelector('meta[name="csrf-token"]');
const apolloClient = new ApolloClient({
    link: createHttpLink({
        uri: '/graphql',
        credentials: 'include',
        headers: {
            "X-CSRF-TOKEN": token.content,
            "X-Requested-With": "XMLHttpRequest",
        }
    }),
    connectToDevTools: true,
    cache: new InMemoryCache({
    }),
});

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
    apolloProvider: new VueApollo({
        defaultClient: apolloClient,
    }),
}).$mount(app);
