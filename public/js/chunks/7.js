(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{202:function(t,e,a){"use strict";a.r(e);var i={data:function(){return{url:"rubriques",search:"",headers:[{text:"Catégorie",align:"middle",value:"text"},{text:"",align:"right",value:"actions",sortable:!1}],validationErrors:null,rubriques:[],langues:[],langue:"fr",rubrique:{id:null,text:null,text_en:null,text_fr:null,show_menu:null,image_url:null,icon:null},edit:!1}},mounted:function(){new KTImageInput("kt_user_edit_avatar")},created:function(){this.fetch()},methods:{fetch:function(){axios.get(this.url).then(function(t){this.rubriques=t.data.rubriques,this.langues=t.data.langues}.bind(this)).catch((function(t){return console.log(t)}))},deleteRubrique:function(t){swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",type:"question",showCancelButton:!0,confirmButtonText:"Yes, delete it!"}).then(function(e){var a=this;e.value&&axios.delete(this.url+"/"+t).then((function(t){swal.fire("Deleted!","Your file has been deleted.","success"),a.fetch()})).catch((function(t){return console.log(t)}))}.bind(this))},saveRubrique:function(){var t=this,e=new FormData;$.each(this.rubrique,(function(t,a){e.append(t,a||"")})),axios.post(this.url,e,{headers:{"content-type":"multipart/form-data"}}).then((function(e){t.clearForm(),$("#modal_form_rubrique").modal("toggle"),t.fetch()})).catch((function(e){422==e.response.status&&(t.validationErrors=e.response.data.errors)}))},addRubrique:function(){this.clearForm(),this.validationErrors=null},editRubrique:function(t){$("#modal_form_rubrique").modal("toggle");new KTImageInput("kt_user_edit_avatar");this.validationErrors=null,this.edit=!0,$.each(this.rubrique,function(e,a){this.rubrique[e]=t[e]}.bind(this)),console.log(this.rubrique)},clearForm:function(){$("#kt_user_edit_avatar .remove_photo").trigger("click"),$("#kt_user_edit_avatar input").val(""),$("#kt_user_edit_avatar .image-input-wrapper").css("background-image","url(https://via.placeholder.com/300/004c68/FFF?text=Upload)"),this.edit=!1,$.each(this.rubrique,function(t,e){this.rubrique[t]=null}.bind(this))},onImageChange:function(t){this.rubrique.icon=t.target.files[0]},changeLang:function(t){this.langue=t.value}}},s=a(4),r=Object(s.a)(i,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"subheader py-2 py-lg-4 subheader-solid",attrs:{id:"kt_subheader"}},[a("div",{staticClass:"container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"},[a("div",{staticClass:"d-flex align-items-center flex-wrap mr-2"},[a("h5",{staticClass:"text-dark font-weight-bold mt-2 mb-2 mr-5"},[t._v("Catégories")]),t._v(" "),a("div",{staticClass:"d-flex align-items-center",attrs:{id:"kt_subheader_search"}},[a("span",{staticClass:"text-dark-50 font-weight-bold",attrs:{id:"kt_subheader_total"}},[t._v(t._s(t.rubriques.length)+" Catégories")]),t._v(" "),a("form",{staticClass:"ml-5"},[a("div",{staticClass:"input-group input-group-sm input-group-solid",staticStyle:{"max-width":"175px"}},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.search,expression:"search"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Recherche..."},domProps:{value:t.search},on:{input:function(e){e.target.composing||(t.search=e.target.value)}}}),t._v(" "),a("div",{staticClass:"input-group-append"},[a("span",{staticClass:"input-group-text"},[a("span",{staticClass:"svg-icon"},[a("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",width:"24px",height:"24px",viewBox:"0 0 24 24",version:"1.1"}},[a("g",{attrs:{stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[a("rect",{attrs:{x:"0",y:"0",width:"24",height:"24"}}),t._v(" "),a("path",{attrs:{d:"M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z",fill:"#000000","fill-rule":"nonzero",opacity:"0.3"}}),t._v(" "),a("path",{attrs:{d:"M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z",fill:"#000000","fill-rule":"nonzero"}})])])])])])])])])]),t._v(" "),a("div",{staticClass:"d-flex align-items-center"},[a("a",{staticClass:"btn btn-primary btn-sm",attrs:{"data-toggle":"modal",href:"#modal_form_rubrique"},on:{click:function(e){return t.addRubrique()}}},[a("i",{staticClass:"ki ki-plus icon-1x"}),t._v(" Ajouter une catégorie\n        ")])])])]),t._v(" "),a("div",{staticClass:"d-flex flex-column-fluid"},[a("div",{staticClass:"container-fluid"},[a("div",{staticClass:"card card-custom gutter-b"},[t._m(0),t._v(" "),a("div",{staticClass:"card-body p-5 pt-0"},[a("v-card",{staticStyle:{"box-shadow":"none"}},[a("v-data-table",{staticClass:"table",attrs:{headers:t.headers,items:t.rubriques,search:t.search},scopedSlots:t._u([{key:"item.text",fn:function(e){var i=e.item;return[a("div",{staticClass:"d-flex align-items-center"},[a("div",{staticClass:"symbol symbol-70 symbol-light-success mr-2"},[a("img",{attrs:{src:i.avatar,alt:""}})]),t._v(" "),a("div",{staticClass:"d-flex flex-column flex-grow-1"},[a("a",{staticClass:"text-dark text-hover-primary font-weight-bold",attrs:{href:"#"}},[t._v(t._s(i.text))])])])]}},{key:"item.actions",fn:function(e){var i=e.item;return[a("a",{staticClass:"btn btn-icon btn-light btn-hover-primary btn-sm mx-3",attrs:{href:"javascript:void(0)"},on:{click:function(e){return t.editRubrique(i)}}},[a("span",{staticClass:"svg-icon svg-icon-md svg-icon-primary"},[a("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",width:"24px",height:"24px",viewBox:"0 0 24 24",version:"1.1"}},[a("g",{attrs:{stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[a("rect",{attrs:{x:"0",y:"0",width:"24",height:"24"}}),t._v(" "),a("path",{attrs:{d:"M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z",fill:"#000000","fill-rule":"nonzero",transform:"translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"}}),t._v(" "),a("path",{attrs:{d:"M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z",fill:"#000000","fill-rule":"nonzero",opacity:"0.3"}})])])])]),t._v(" "),a("a",{staticClass:"btn d-none btn-icon btn-light btn-hover-primary btn-sm",attrs:{href:"#"}},[a("span",{staticClass:"svg-icon svg-icon-md svg-icon-primary"},[a("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",width:"24px",height:"24px",viewBox:"0 0 24 24",version:"1.1"}},[a("g",{attrs:{stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[a("rect",{attrs:{x:"0",y:"0",width:"24",height:"24"}}),t._v(" "),a("path",{attrs:{d:"M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z",fill:"#000000","fill-rule":"nonzero"}}),t._v(" "),a("path",{attrs:{d:"M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z",fill:"#000000",opacity:"0.3"}})])])])])]}}])})],1)],1)])])]),t._v(" "),a("div",{staticClass:"modal fade",attrs:{id:"modal_form_rubrique",tabindex:"-1",role:"dialog","aria-labelledby":"exampleModalLabel","aria-hidden":"true"}},[a("div",{staticClass:"modal-dialog",attrs:{role:"document"}},[a("div",{staticClass:"modal-content"},[a("div",{staticClass:"modal-header"},[t.rubrique.id?t._e():a("h5",{staticClass:"modal-title",attrs:{id:"exampleModalLabel"}},[t._v("Ajouter une catégorie.")]),t._v(" "),t.rubrique.id?a("h5",{staticClass:"modal-title",attrs:{id:"exampleModalLabel"}},[t._v("Modifier une catégorie")]):t._e(),t._v(" "),t._m(1)]),t._v(" "),a("form",{staticClass:"mb-3",on:{submit:function(e){return e.preventDefault(),t.saveRubrique(e)}}},[a("div",{staticClass:"modal-body"},[a("ul",{staticClass:"nav nav-tabs pl-0",attrs:{id:"myTab",role:"tablist"}},t._l(t.langues,(function(e){return a("li",{key:e.value,staticClass:"nav-item",on:{click:function(a){return t.changeLang(e)}}},[a("a",{staticClass:"nav-link",class:{active:t.langue==e.value},attrs:{id:"home-tab","data-toggle":"tab",href:"#"}},[t._m(2,!0),t._v(" "),a("span",{staticClass:"nav-text"},[t._v(t._s(e.text))])])])})),0),t._v(" "),a("div",{staticClass:"form-group mt-5 text-center"},[a("label",{staticClass:"d-block text-center"},[t._v("Image")]),t._v(" "),a("div",{staticClass:"image-input image-input-empty image-input-outline",style:{"background-image":"url("+t.rubrique.image_url+")"},attrs:{id:"kt_user_edit_avatar"}},[a("div",{staticClass:"image-input-wrapper"}),t._v(" "),a("label",{staticClass:"btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow",attrs:{"data-action":"change","data-toggle":"tooltip",title:"","data-original-title":"Change avatar"}},[a("i",{staticClass:"fa fa-pen icon-sm text-muted"}),t._v(" "),a("input",{attrs:{type:"file",name:"image",accept:".png, .jpg, .jpeg, .svg"},on:{change:t.onImageChange}}),t._v(" "),a("input",{attrs:{type:"hidden",name:"profile_avatar_remove"}})]),t._v(" "),t._m(3),t._v(" "),t._m(4)]),t._v(" "),t._m(5)]),t._v(" "),t._l(t.langues,(function(e){return a("div",{key:e.value,class:{"d-none":t.langue!=e.value}},[a("div",{staticClass:"form-group"},[a("label",{staticClass:"form-control-label",attrs:{for:"recipient-name"}},[t._v("Titre")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.rubrique["text_"+e.value],expression:"rubrique['text_'+l.value]"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Titre "+e.value},domProps:{value:t.rubrique["text_"+e.value]},on:{input:function(a){a.target.composing||t.$set(t.rubrique,"text_"+e.value,a.target.value)}}})])])})),t._v(" "),a("div",{staticClass:"form-group"},[a("div",{staticClass:"checkbox-list"},[a("label",{staticClass:"checkbox"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.rubrique.show_menu,expression:"rubrique.show_menu"}],attrs:{type:"checkbox",name:"Checkboxes1"},domProps:{checked:Array.isArray(t.rubrique.show_menu)?t._i(t.rubrique.show_menu,null)>-1:t.rubrique.show_menu},on:{change:function(e){var a=t.rubrique.show_menu,i=e.target,s=!!i.checked;if(Array.isArray(a)){var r=t._i(a,null);i.checked?r<0&&t.$set(t.rubrique,"show_menu",a.concat([null])):r>-1&&t.$set(t.rubrique,"show_menu",a.slice(0,r).concat(a.slice(r+1)))}else t.$set(t.rubrique,"show_menu",s)}}}),t._v(" "),a("span"),t._v("Afficher la catégorie sur le slider du page d'accueil\n                ")])])]),t._v(" "),t.validationErrors?a("validation-errors",{attrs:{errors:t.validationErrors}}):t._e()],2),t._v(" "),a("div",{staticClass:"modal-footer"},[a("button",{staticClass:"btn btn-secondary",attrs:{type:"button","data-dismiss":"modal"},on:{click:function(e){return t.clearForm()}}},[t._v("Fermer")]),t._v(" "),a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Enregistrer")])])])])])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"card-header"},[e("div",{staticClass:"card-title"},[e("h3",{staticClass:"card-label"},[this._v("Liste des Catégories")])])])},function(){var t=this.$createElement,e=this._self._c||t;return e("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[e("i",{staticClass:"ki ki-close",attrs:{"aria-hidden":"true"}})])},function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"nav-icon"},[e("i",{staticClass:"far fa-flag"})])},function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow",attrs:{"data-action":"cancel","data-toggle":"tooltip",title:"Cancel avatar"}},[e("i",{staticClass:"ki ki-bold-close icon-xs text-muted"})])},function(){var t=this.$createElement,e=this._self._c||t;return e("span",{staticClass:"btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow",attrs:{"data-action":"remove","data-toggle":"tooltip",title:"Remove avatar"}},[e("i",{staticClass:"ki ki-bold-close icon-xs text-muted"})])},function(){var t=this.$createElement,e=this._self._c||t;return e("label",{staticClass:"d-block text-center"},[e("small",[this._v("700px/850px")])])}],!1,null,null,null);e.default=r.exports}}]);