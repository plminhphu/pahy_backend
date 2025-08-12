// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  css: ['~~/assets/css/tailwind.css'],
  ui: {
    prefix: 'Nuxt',
    fonts: false,
    colorMode: false
  },
  modules: [
    '@nuxt/ui',
    '@nuxt/image',
    '@nuxt/eslint',
    '@nuxt/content',
    '@nuxt/scripts',
    '@nuxt/test-utils'
  ]
})