(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{189:function(r,s,e){"use strict";e.r(s);var a={data:function(){return{name:"",email:"",password:"",password_confirmation:"",has_error:!1,error:"",errors:{},success:!1}},methods:{register:function(){var r=this;this.$auth.register({data:{email:r.email,password:r.password,password_confirmation:r.password_confirmation},success:function(){r.success=!0,this.$router.push({name:"login",params:{successRegistrationRedirect:!0}})},error:function(s){console.log(s.response.data.errors),r.has_error=!0,r.error=s.response.data.error,r.errors=s.response.data.errors||{}}})}}},o=e(4),t=Object(o.a)(a,(function(){var r=this,s=r.$createElement,e=r._self._c||s;return e("div",{staticClass:"container"},[e("div",{staticClass:"card card-default"},[e("div",{staticClass:"card-header"},[r._v("Inscription")]),r._v(" "),e("div",{staticClass:"card-body"},[r.has_error&&!r.success?e("div",{staticClass:"alert alert-danger"},["registration_validation_error"==r.error?e("p",[r._v("Erreur(s) de validation, veuillez consulter le(s) message(s) ci-dessous.")]):e("p",[r._v("Erreur, impossible de s'inscrire pour le moment. Si le problème persiste, veuillez contacter un administrateur.")])]):r._e(),r._v(" "),r.success?r._e():e("form",{attrs:{autocomplete:"off",method:"post"},on:{submit:function(s){return s.preventDefault(),r.register(s)}}},[e("div",{staticClass:"form-group",class:{"has-error":r.has_error&&r.errors.email}},[e("label",{attrs:{for:"email"}},[r._v("E-mail")]),r._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:r.email,expression:"email"}],staticClass:"form-control",attrs:{type:"email",id:"email",placeholder:"user@example.com"},domProps:{value:r.email},on:{input:function(s){s.target.composing||(r.email=s.target.value)}}}),r._v(" "),r.has_error&&r.errors.email?e("span",{staticClass:"help-block"},[r._v(r._s(r.errors.email))]):r._e()]),r._v(" "),e("div",{staticClass:"form-group",class:{"has-error":r.has_error&&r.errors.password}},[e("label",{attrs:{for:"password"}},[r._v("Mot de passe")]),r._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:r.password,expression:"password"}],staticClass:"form-control",attrs:{type:"password",id:"password"},domProps:{value:r.password},on:{input:function(s){s.target.composing||(r.password=s.target.value)}}}),r._v(" "),r.has_error&&r.errors.password?e("span",{staticClass:"help-block"},[r._v(r._s(r.errors.password))]):r._e()]),r._v(" "),e("div",{staticClass:"form-group",class:{"has-error":r.has_error&&r.errors.password}},[e("label",{attrs:{for:"password_confirmation"}},[r._v("Confirmation mot de passe")]),r._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:r.password_confirmation,expression:"password_confirmation"}],staticClass:"form-control",attrs:{type:"password",id:"password_confirmation"},domProps:{value:r.password_confirmation},on:{input:function(s){s.target.composing||(r.password_confirmation=s.target.value)}}})]),r._v(" "),e("button",{staticClass:"btn btn-default",attrs:{type:"submit"}},[r._v("Inscription")])])])])])}),[],!1,null,null,null);s.default=t.exports}}]);