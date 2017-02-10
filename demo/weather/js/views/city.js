define(["collections/cities","common/index","common/forecast"],function(t,e,o){var s=Backbone.View.extend({template:_.template($("#city_template").html()),alertTemplate:_.template($("#alert_template").html()),forecastTemplate:_.template($("#forecast_template").html()),events:{"click #js-bookmark_toggle":"bookmarkToggle","click #js-update_forecast":"forecastUpdate"},initialize:function(e){this.city=e,this.inBookmarks=!1,this.listenTo(t,"reset",this.setCityPage)},render:function(){e.toggleHeaderButtons(),e.setTitle("Forecast: "+this.city),$("#content").html(this.$el.html(this.template({city:this.city,inBookmarks:this.inBookmarks}))),t.fetch({reset:!0}),this.forecastRequest()},codes:{SUCCESS:200},forecastRequest:function(){var t=this,e=$("#js-update_forecast");e.addClass("active"),o.getForecast(this.city,function(o){o.cod==t.codes.SUCCESS?t.$("#city_forecast").html(t.forecastTemplate(o)):t.$("#city_forecast").html(t.alertTemplate({text:o.message})),e.removeClass("active")},function(){t.$("#city_forecast").html(t.alertTemplate({text:"Internal error"})),e.removeClass("active")})},forecastUpdate:function(t){t.preventDefault(),t.stopPropagation(),this.forecastRequest()},setCityPage:function(){this.inBookmarks=!!t.inCollection(this.city),this.setBookmarkButton()},setBookmarkButton:function(){var t=this,e=$("#js-bookmark_toggle");e.toggleClass("icon_bookmark_on",t.inBookmarks).toggleClass("icon_bookmark_off",!t.inBookmarks).attr("title",t.inBookmarks?"Remove from my cities":"Add to my cities")},bookmarkToggle:function(e){e.preventDefault(),e.stopPropagation(),t.toggleModel(this.city),this.inBookmarks=!this.inBookmarks,this.setBookmarkButton()}});return s});