(window.webpackJsonp=window.webpackJsonp||[]).push([[47],{214:function(t,s,e){"use strict";e.r(s);var a={data:function(){return{url:"rembourssements/"+this.$route.params.id,search:"",validationErrors:null,rembourssements:[],trakings:[],statuts:[],rembourssement:null,edit:!1}},created:function(){this.fetch()},methods:{fetch:function(){axios.get(this.url).then(function(t){this.rembourssement=t.data.rembourssement,this.trakings=t.data.trakings,this.statuts=t.data.statuts}.bind(this)).catch((function(t){return console.log(t)}))},clearForm:function(){this.edit=!1,$.each(this.traking,function(t,s){this.traking[t]=null}.bind(this))},deleteColis:function(t){swal.fire({title:"Êtes-vous sûr ?",text:"Vous êtes sur le point de supprimer ce colis !",type:"question",showCancelButton:!0,confirmButtonText:"Supprimer",cancelButtonText:"Annuler"}).then(function(t){var s=this;t.value&&axios.delete(this.url).then((function(t){s.$router.push({path:"/rembourssements"}),swal.fire("Colis supprimé !","Le Colis a été supprimé avec succés.","success")})).catch((function(t){return console.log(t)}))}.bind(this))}}},i=e(2),l=Object(i.a)(a,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",[e("div",{staticClass:"subheader py-2 py-lg-4 subheader-solid",attrs:{id:"kt_subheader"}},[e("div",{staticClass:"container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap"},[e("div",{staticClass:"d-flex align-items-center flex-wrap mr-2"},[e("h5",{staticClass:"text-dark font-weight-bold mt-2 mb-2 mr-5"},[t._v("Détails du rembourssement")]),t._v(" "),e("div",{staticClass:"subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"}),t._v(" "),e("ul",{staticClass:"breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 mr-3 font-size-sm"},[e("li",{staticClass:"breadcrumb-item"},[e("router-link",{staticClass:"text-muted",attrs:{to:"/rembourssement"}},[t._v("Rembourssements")])],1)]),t._v(" "),t.rembourssement?e("div",{staticClass:"d-flex align-items-center",attrs:{id:"kt_subheader_search"}},[e("span",{staticClass:"text-dark-50 font-weight-bold",attrs:{id:"kt_subheader_total"}},[t._v("#"+t._s(t.rembourssement.id))])]):t._e()])])]),t._v(" "),t.rembourssement?e("div",{staticClass:"d-flex flex-column-fluid"},[e("div",{staticClass:"container"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-xl-5"},[1==t.$auth.user().role_id?e("div",{staticClass:"card card-custom gutter-b"},[e("div",{staticClass:"card-body"},[e("div",{staticClass:"d-flex"},[e("div",{staticClass:"flex-shrink-0 mr-7"},[e("div",{staticClass:"symbol symbol-80 symbol-light-success mr-2"},[e("img",{attrs:{src:t.rembourssement.client_image,alt:""}})])]),t._v(" "),e("div",{staticClass:"flex-grow-1"},[e("div",{staticClass:"d-flex align-items-center justify-content-between flex-wrap"},[e("div",{staticClass:"mr-3"},[e("div",{staticClass:"d-flex align-items-center mr-3"},[e("a",{staticClass:"d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3",attrs:{href:"#"}},[t._v(t._s(t.rembourssement.client_label))]),t._v(" "),e("span",{staticClass:"label label-light-success label-inline font-weight-bolder mr-1"},[t._v("Client")])]),t._v(" "),e("div",{staticClass:"d-flex flex-wrap my-2"},[e("a",{staticClass:"text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2",attrs:{href:"#"}},[e("span",{staticClass:"svg-icon svg-icon-md svg-icon-gray-500 mr-1"},[e("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",width:"24px",height:"24px",viewBox:"0 0 24 24",version:"1.1"}},[e("g",{attrs:{stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[e("rect",{attrs:{x:"0",y:"0",width:"24",height:"24"}}),t._v(" "),e("path",{attrs:{d:"M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z",fill:"#000000"}}),t._v(" "),e("circle",{attrs:{fill:"#000000",opacity:"0.3",cx:"19.5",cy:"17.5",r:"2.5"}})])])]),t._v("\n                          "+t._s(t.rembourssement.client_email)+"\n                        ")]),t._v(" "),e("a",{staticClass:"text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2",attrs:{href:"#"}},[e("span",{staticClass:"svg-icon svg-icon-md svg-icon-gray-500 mr-1"},[e("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",width:"24px",height:"24px",viewBox:"0 0 24 24",version:"1.1"}},[e("g",{attrs:{stroke:"none","stroke-width":"1",fill:"none","fill-rule":"evenodd"}},[e("rect",{attrs:{x:"0",y:"0",width:"24",height:"24"}}),t._v(" "),e("path",{attrs:{d:"M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z",fill:"#000000",opacity:"0.3"}}),t._v(" "),e("path",{attrs:{d:"M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z M8,1 L16,1 C17.5187831,1 18.75,2.23121694 18.75,3.75 L18.75,20.25 C18.75,21.7687831 17.5187831,23 16,23 L8,23 C6.48121694,23 5.25,21.7687831 5.25,20.25 L5.25,3.75 C5.25,2.23121694 6.48121694,1 8,1 Z M9.5,1.75 L14.5,1.75 C14.7761424,1.75 15,1.97385763 15,2.25 L15,3.25 C15,3.52614237 14.7761424,3.75 14.5,3.75 L9.5,3.75 C9.22385763,3.75 9,3.52614237 9,3.25 L9,2.25 C9,1.97385763 9.22385763,1.75 9.5,1.75 Z",fill:"#000000","fill-rule":"nonzero"}})])])]),t._v("\n                          "+t._s(t.rembourssement.client_tel)+"\n                        ")])])])])])])])]):t._e(),t._v(" "),e("div",{staticClass:"card card-custom"},[t._m(0),t._v(" "),e("div",{staticClass:"card-body py-4"},[e("div",{staticClass:"form-group row my-2"},[e("label",{staticClass:"col-4 col-form-label"},[t._v("Mode de paiement")]),t._v(" "),e("div",{staticClass:"col-8 p-0"},[e("span",{staticClass:"form-control-plaintext font-weight-bolder"},[t._v(t._s(t.rembourssement.mode_label))])])]),t._v(" "),e("div",{staticClass:"form-group row my-2"},[e("label",{staticClass:"col-4 col-form-label"},[t._v("Compte bancaire")]),t._v(" "),e("div",{staticClass:"col-8 p-0"},[e("div",{staticClass:"d-flex align-items-center"},[e("div",{staticClass:"symbol symbol-40 symbol-light-success mr-2",staticStyle:{border:"1px solid #e9e9e9"}},[e("img",{attrs:{src:t.rembourssement.compte_image,alt:""}})]),t._v(" "),e("div",{staticClass:"d-flex flex-column flex-grow-1"},[e("a",{staticClass:"text-dark text-hover-primary font-weight-bold",attrs:{href:"#"}},[t._v(t._s(t.rembourssement.compte_label))])])])])]),t._v(" "),e("div",{staticClass:"form-group row my-2"},[e("label",{staticClass:"col-4 col-form-label"},[t._v("Montant :")]),t._v(" "),e("div",{staticClass:"col-8 p-0"},[e("span",{staticClass:"form-control-plaintext"},[e("span",{staticClass:"label label-inline label-primary label-bold"},[t._v(t._s(t.rembourssement.montant)+" MAD")])])])]),t._v(" "),e("div",{staticClass:"form-group row my-2"},[e("label",{staticClass:"col-4 col-form-label"},[t._v("N° de référence :")]),t._v(" "),e("div",{staticClass:"col-8 p-0"},[e("span",{staticClass:"form-control-plaintext font-weight-bolder"},[t._v(t._s(t.rembourssement.reference))])])]),t._v(" "),e("div",{staticClass:"form-group row my-2"},[e("label",{staticClass:"col-4 col-form-label"},[t._v("Remarque :")]),t._v(" "),e("div",{staticClass:"col-8 p-0"},[e("span",{staticClass:"form-control-plaintext font-weight-bolder"},[t._v(t._s(t.rembourssement.commentaire))])])]),t._v(" "),e("div",{staticClass:"form-group row my-2"},[e("label",{staticClass:"col-4 col-form-label"},[t._v("Date de paiement :")]),t._v(" "),e("div",{staticClass:"col-8 p-0"},[e("span",{staticClass:"form-control-plaintext font-weight-bolder"},[t._v(t._s(t.rembourssement.date_paiement))])])])])])]),t._v(" "),e("div",{staticClass:"col-xl-7"},[e("div",{staticClass:"card card-custom gutter-b"},[t._m(1),t._v(" "),e("div",{staticClass:"card-body px-0"},[e("div",{staticClass:"tab-content pt-5"},[e("div",{staticClass:"tab-pane active",attrs:{id:"kt_apps_contacts_view_tab_1",role:"tabpanel"}},[e("div",{staticClass:"container m-auto text-center"},[e("img",{staticClass:"img-fluid rounded",attrs:{src:t.rembourssement.file_path,alt:""}})])])])])])])])])]):t._e()])}),[function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"card-header h-auto py-4"},[s("div",{staticClass:"card-title"},[s("h3",{staticClass:"card-label"},[this._v("Informations")])])])},function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"card-header h-auto py-4"},[s("div",{staticClass:"card-title"},[s("h3",{staticClass:"card-label"},[this._v("Justificatif de paiement")])])])}],!1,null,null,null);s.default=l.exports}}]);