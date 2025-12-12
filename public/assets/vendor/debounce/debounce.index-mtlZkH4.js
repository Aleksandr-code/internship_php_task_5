/**
 * Bundled by jsDelivr using Rollup v2.79.2 and Terser v5.39.0.
 * Original file: /npm/debounce@3.0.0/index.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
function t(t,e=100,o={}){if("function"!=typeof t)throw new TypeError(`Expected the first parameter to be a function, got \`${typeof t}\`.`);if(e<0)throw new RangeError("`wait` must not be negative.");if("boolean"==typeof o)throw new TypeError("The `options` parameter must be an object, not a boolean. Use `{immediate: true}` instead.");const{immediate:r}=o;let n,i,a,f,c;function s(){const e=n,o=i;return n=void 0,i=void 0,c=t.apply(e,o),c}function d(){const t=Date.now()-f;t<e&&t>=0?a=setTimeout(d,e-t):(a=void 0,r||(c=s()))}const u=function(...t){if(n&&this!==n&&Object.getPrototypeOf(this)===Object.getPrototypeOf(n))throw new Error("Debounced method called with different contexts of the same prototype.");n=this,i=t,f=Date.now();const o=r&&!a;if(a||(a=setTimeout(d,e)),o)return c=s(),c};return Object.defineProperty(u,"isPending",{get:()=>void 0!==a}),u.clear=()=>{a&&(clearTimeout(a),a=void 0,n=void 0,i=void 0)},u.flush=()=>{a&&u.trigger()},u.trigger=()=>{c=s(),u.clear()},u}export{t as default};
