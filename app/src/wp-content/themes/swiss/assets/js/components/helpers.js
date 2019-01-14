const helpers = {

    /**
     * Helper method to toggle attribute between true/false on a given element.
     * @param  {[type]} el   Element to target
     * @param  {[type]} attr Attribute to toggle
     * @return {[type]}      [description]
     */
    toggleAttr(el, attr) {
        if (el.attr(attr) === 'false') {
            el.attr(attr, 'true');
        } else {
            el.attr(attr, 'false');
        }
    },

    /**
     * [setCookie description]
     * @param {[type]} name  [description]
     * @param {[type]} value [description]
     * @param {[type]} days  [description]
     */
    setCookie(name, value, days) {
        let d = new Date;
        d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
        document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
    },

    /**
     * [getCookie description]
     * @param  {[type]} name [description]
     * @return {[type]}      [description]
     */
    getCookie(name) {
        let v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return v ? v[2] : null;
    },

    /**
     * [deleteCookie description]
     * @param  {[type]} name [description]
     * @return {[type]}      [description]
     */
    deleteCookie(name) {
        helpers.setCookie(name, '', -1);
    }

};

export default helpers;