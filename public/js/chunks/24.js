(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{220:function(t,e,a){"use strict";a.r(e);var s=a(2),i={components:{TiptapVuetify:s.o},data:function(){return{url:"traductions/table",search:"",validationErrors:null,overlay:null,traductions:[],rubriques:[],langues:[],filter:{rubrique:null,langue:null,service:null},extensions:[s.g,s.j,s.q,s.n,s.i,s.k,s.c,s.b],edit:!1}},mounted:function(){new KTImageInput("kt_user_edit_avatar")},created:function(){this.fetch()},methods:{fetch:function(){var t=this;this.overlay=!0;var e={};$.each(this.filter,(function(t,a){e[t]=a})),axios.get(this.url,{params:e}).then(function(t){this.filter.langue=t.data.langue,this.langues=t.data.langues,this.rubriques=t.data.rubriques,this.traductions=t.data.traductions,this.overlay=!1}.bind(this)).catch((function(e){t.overlay=!1,console.log("check error: ",t.error)}))},saveTraduction:function(t,e){var a=this;t.target.disabled=!0,t.target.classList.toggle("spinner");var s=new FormData;$.each(e,(function(t,e){s.append(t,e)})),s.append("langue",this.filter.langue),axios.post("traductions/save_partie",s,{headers:{"content-type":"multipart/form-data"}}).then((function(e){t.target.disabled=!1,t.target.classList.toggle("spinner"),a.fetch()})).catch((function(e){t.target.disabled=!1,t.target.classList.toggle("spinner"),422==e.response.status&&(a.validationErrors=e.response.data.errors)}))}}},n=a(4),r=Object(n.a)(i,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._m(0),t._v(" "),a("div",{staticClass:"d-flex flex-column-fluid"},[a("div",{staticClass:"container-fluid"},[a("div",{staticClass:"card card-custom gutter-b",class:{"overlay overlay-block":t.overlay}},[a("div",{staticClass:"card-header"},[t._m(1),t._v(" "),a("div",{staticClass:"d-flex align-items-center"},[a("v-autocomplete",{attrs:{items:t.rubriques,outlined:"",dense:"",filled:"",label:"Rubrique"},on:{change:function(e){return t.fetch()}},model:{value:t.filter.rubrique,callback:function(e){t.$set(t.filter,"rubrique",e)},expression:"filter.rubrique"}}),t._v(" "),a("v-autocomplete",{staticStyle:{width:"100px","margin-left":"15px"},attrs:{items:t.langues,outlined:"",dense:"",filled:"",label:"Langue"},on:{change:function(e){return t.fetch()}},model:{value:t.filter.langue,callback:function(e){t.$set(t.filter,"langue",e)},expression:"filter.langue"}})],1)]),t._v(" "),a("div",{staticClass:"overlay-wrapper"},[a("div",{staticClass:"card-body p-5 pt-0"},[a("div",{staticClass:"table-responsive"},[a("table",{staticClass:"table table-head-custom table-vertical-center",attrs:{id:"kt_advance_table_widget_1"}},[t._m(2),t._v(" "),a("tbody",t._l(t.traductions,(function(e){return a("tr",{key:e.id},[a("td",{staticClass:"text-right",staticStyle:{"vertical-align":"top","padding-top":"20px"}},[a("span",{staticClass:"font-weight-bold"},[t._v(t._s(e.label))])]),t._v(" "),a("td",{},["input"==e.type?a("input",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"traduction.value"}],staticClass:"form-control",attrs:{type:"text",placeholder:e.label},domProps:{value:e.value},on:{input:function(a){a.target.composing||t.$set(e,"value",a.target.value)}}}):t._e(),t._v(" "),"textarea"==e.type?a("textarea",{directives:[{name:"model",rawName:"v-model",value:e.value,expression:"traduction.value"}],staticClass:"form-control",attrs:{rows:"2"},domProps:{value:e.value},on:{input:function(a){a.target.composing||t.$set(e,"value",a.target.value)}}}):t._e(),t._v(" "),"editor"==e.type?a("tiptap-vuetify",{attrs:{extensions:t.extensions},model:{value:e.value,callback:function(a){t.$set(e,"value",a)},expression:"traduction.value"}}):t._e()],1),t._v(" "),a("td",{staticStyle:{"vertical-align":"top"}},[a("button",{staticClass:"btn btn-sm btn-light-info mr-2 spinner-darker-info spinner-right",on:{click:function(a){return t.saveTraduction(a,e)}}},[t._m(3,!0),t._v("\n                        Enregistrer\n                      ")])])])})),0)])])])]),t._v(" "),t.overlay?a("div",{staticClass:"overlay-layer bg-dark-o-10"},[a("div",{staticClass:"spinner spinner-primary"})]):t._e()])])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"subheader py-2 py-lg-4 subheader-solid",attrs:{id:"kt_subheader"}},[e("div",{staticClass:"container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"},[e("div",{staticClass:"d-flex align-items-center flex-wrap mr-2"},[e("h5",{staticClass:"text-dark font-weight-bold mt-2 mb-2 mr-5"},[this._v("Contenu de site")]),this._v(" "),e("div",{staticClass:"d-flex align-items-center",attrs:{id:"kt_subheader_search"}})])])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"card-title"},[e("h3",{staticClass:"card-label"},[this._v("Contenu de site")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("thead",[e("tr",{staticClass:"text-left"},[e("th",{staticStyle:{width:"200px"}},[this._v("Partie")]),this._v(" "),e("th",[this._v("Valeur")]),this._v(" "),e("th",{staticStyle:{width:"200px"}})])])},function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"svg-icon svg-icon-info svg-icon-lg"},[e("i",{staticClass:"la la-check"})])}],!1,null,null,null);e.default=r.exports}}]);