module.exports = {
  pages: {
    index: {
      entry: 'src/main.js',
      title: 'Manage Todo',
    },
  },
  pwa: {
    name: 'Todo manager',
    themeColor: '#FFFFFF',
    msTileColor: '#FFFFFF',
    appleMobileWebAppCapable: 'yes',
    appleMobileWebAppStatusBarStyle: 'black',

    manifestOptions: {
        display: 'standalone',
        background_color: '#FFFFFF'
    }
  },
}
