/**
 * Cookie functions.
 *
 * @output js/cookies.js
 */

/* global the7Cookies*/

window.the7Cookies = {

// The following functions are from Cookie.js class in TinyMCE 3, Moxiecode, used under LGPL.

    each: function( obj, cb, scope ) {
        var n, l;

        if ( ! obj ) {
            return 0;
        }

        scope = scope || obj;

        if ( typeof( obj.length ) !== 'undefined' ) {
            for ( n = 0, l = obj.length; n < l; n++ ) {
                if ( cb.call( scope, obj[n], n, obj ) === false ) {
                    return 0;
                }
            }
        } else {
            for ( n in obj ) {
                if ( obj.hasOwnProperty(n) ) {
                    if ( cb.call( scope, obj[n], n, obj ) === false ) {
                        return 0;
                    }
                }
            }
        }
        return 1;
    },

    /**
     * Get a multi-values cookie.
     * Returns a JS object with the name: 'value' pairs.
     */
    getHash: function( name ) {
        var cookie = this.get( name ), values;

        if ( cookie ) {
            this.each( cookie.split('&'), function( pair ) {
                pair = pair.split('=');
                values = values || {};
                values[pair[0]] = pair[1];
            });
        }

        return values;
    },

    /**
     * Set a multi-values cookie.
     *
     * 'values_obj' is the JS object that is stored. It is encoded as URI in wpCookies.set().
     */
    setHash: function( name, values_obj, expires, path, domain, secure ) {
        var str = '';

        this.each( values_obj, function( val, key ) {
            str += ( ! str ? '' : '&' ) + key + '=' + val;
        });

        this.set( name, str, expires, path, domain, secure );
    },

    /**
     * Get a cookie.
     */
    get: function( name ) {
        var e, b,
            cookie = document.cookie,
            p = name + '=';

        if ( ! cookie ) {
            return;
        }

        b = cookie.indexOf( '; ' + p );

        if ( b === -1 ) {
            b = cookie.indexOf(p);

            if ( b !== 0 ) {
                return null;
            }
        } else {
            b += 2;
        }

        e = cookie.indexOf( ';', b );

        if ( e === -1 ) {
            e = cookie.length;
        }

        return decodeURIComponent( cookie.substring( b + p.length, e ) );
    },

    /**
     * Set a cookie.
     *
     * The 'expires' arg can be either a JS Date() object set to the expiration date (back-compat)
     * or the number of seconds until expiration
     */
    set: function( name, value, expires, path, domain, secure ) {
        var d = new Date();

        if ( typeof( expires ) === 'object' && expires.toGMTString ) {
            expires = expires.toGMTString();
        } else if ( parseInt( expires, 10 ) ) {
            d.setTime( d.getTime() + ( parseInt( expires, 10 ) * 1000 ) ); // Time must be in milliseconds.
            expires = d.toGMTString();
        } else {
            expires = '';
        }

        document.cookie = name + '=' + encodeURIComponent( value ) +
            ( expires ? '; expires=' + expires : '' ) +
            ( path    ? '; path=' + path       : '' ) +
            ( domain  ? '; domain=' + domain   : '' ) +
            ( secure  ? '; secure'             : '' );
    },

    /**
     * Remove a cookie.
     *
     * This is done by setting it to an empty value and setting the expiration time in the past.
     */
    remove: function( name, path, domain, secure ) {
        this.set( name, '', -1000, path, domain, secure );
    }
};
