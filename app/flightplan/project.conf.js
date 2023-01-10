/**
 * Project specific settings for flightplan.
 */

var config = {

    //relative web root to this local build
    webRoot: '/dist',

    targets: {

        local:{},

        staging: {
            hosts: {
                host: 'staging.em87.io',
                username: 'evermadeweb',
                privateKey: '',
                passphrase: process.env.EVERMADEWEB_PASSPHRASE,
                agentForward: true,
                agent: process.env.SSH_AUTH_SOCK
            },
            options: {
                buildRoot: '/srv/www/helsinkiliikkuu.staging.em87.io', // No trailing slash
                webRoot: '/dist', //relative from build root
                url: 'http://helsinkiliikkuu.staging.em87.io', // No trailing slash
                dbPush: true,
                log: true
            }
        },

        production: {
            hosts: {
                host: '94.237.11.20',
                username: 'evermade',
                privateKey: '',
                passphrase: process.env.EVERMADEWEB_PASSPHRASE,
                agentForward: true,
                agent: process.env.SSH_AUTH_SOCK
            },
            options: {
                buildRoot: '/srv/www/www.helsinkiliikkuu.fi', // No trailing slash
                webRoot: '/dist', //relative from build root
                url: 'http://www.helsinkiliikkuu.fi', // No trailing slash
                dbPush: false,
                log: false
            }
        }

    }

};

module.exports = config;