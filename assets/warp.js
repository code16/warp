class Warp {

    constructor () {
        this.payload = window.warp
    }

    get(key) {
        return this.payload[key]
    }

    /**
     * Install Plugin
     * @param  {[type]} Vue [description]
     * @return {[type]}     [description]
     */
    install(Vue) {
        if (this.installed) {
            warn('already installed.')
            return
        }

        Vue.prototype.$warp = this
    }
    
}

if (typeof window !== 'undefined' && window.Vue) {
    window.Vue.use(new Warp)
}

export default Warp