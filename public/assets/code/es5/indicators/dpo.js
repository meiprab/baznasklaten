/**
 * Highstock JS v11.3.0 (2024-01-10)
 *
 * Indicator series type for Highcharts Stock
 *
 * (c) 2010-2024 Wojciech Chmiel
 *
 * License: www.highcharts.com/license
 */!function(t){"object"==typeof module&&module.exports?(t.default=t,module.exports=t):"function"==typeof define&&define.amd?define("highcharts/indicators/dpo",["highcharts","highcharts/modules/stock"],function(e){return t(e),t.Highcharts=e,t}):t("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(t){"use strict";var e=t?t._modules:{};function o(t,e,o,n){t.hasOwnProperty(e)||(t[e]=n.apply(null,o),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:e,module:t[e]}})))}o(e,"Stock/Indicators/DPO/DPOIndicator.js",[e["Core/Series/SeriesRegistry.js"],e["Core/Utilities.js"]],function(t,e){var o,n=this&&this.__extends||(o=function(t,e){return(o=Object.setPrototypeOf||({__proto__:[]})instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&(t[o]=e[o])})(t,e)},function(t,e){if("function"!=typeof e&&null!==e)throw TypeError("Class extends value "+String(e)+" is not a constructor or null");function n(){this.constructor=t}o(t,e),t.prototype=null===e?Object.create(e):(n.prototype=e.prototype,new n)}),r=t.seriesTypes.sma,i=e.extend,s=e.merge,a=e.correctFloat,u=e.pick;function c(t,e,o,n,r){var i=u(e[o][n],e[o]);return r?a(t-i):a(t+i)}var p=function(t){function e(){return null!==t&&t.apply(this,arguments)||this}return n(e,t),e.prototype.getValues=function(t,e){var o,n,r,i,s,a=e.period,p=e.index,f=a+Math.floor(a/2+1),d=t.xData||[],l=t.yData||[],h=l.length,y=[],g=[],m=[],v=0;if(!(d.length<=f)){for(i=0;i<a-1;i++)v=c(v,l,i,p);for(s=0;s<=h-f;s++)n=s+a-1,r=s+f-1,v=c(v,l,n,p),o=u(l[r][p],l[r])-v/a,v=c(v,l,s,p,!0),y.push([d[r],o]),g.push(d[r]),m.push(o);return{values:y,xData:g,yData:m}}},e.defaultOptions=s(r.defaultOptions,{params:{index:0,period:21}}),e}(r);return i(p.prototype,{nameBase:"DPO"}),t.registerSeriesType("dpo",p),p}),o(e,"masters/indicators/dpo.src.js",[],function(){})});