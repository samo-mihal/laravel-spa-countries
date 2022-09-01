function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'countries.list', component: page('countries/list.vue') },
  { path: '/countries/:country', name: 'countries.detail', component: page('countries/detail.vue') },

  { path: '*', component: page('errors/404.vue') }
]
