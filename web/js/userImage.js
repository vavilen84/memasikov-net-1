$(document).ready(function(){new(Backbone.View.extend({el:".container",imageSelector:"#user-image img",json:null,events:{"click #download":"downloadImage","click .copy-image-link":"copyImageLink"},initialize:function(){this.deserializeUserImageJson()},downloadImage:function(e){e.preventDefault();var n=this;$(n.imageSelector).memeGenerator("download")},copyImageLink:function(){document.getElementById("image-link").select(),document.execCommand("Copy");var e=$("#copy-link-button");e.text("Скопировано!").removeClass("btn-primary").addClass("btn-success"),setTimeout(function(){e.removeClass("btn-success").addClass("btn-primary").text("Скопировать ссылку на картинку")},1e3)},deserializeUserImageJson:function(){var e=this;e.json=$("#json").val(),$(e.imageSelector).memeGenerator({drawingAboveText:!1,showAdvancedSettings:!1,dragResizeEnabled:!1,previewMode:"css",onInit:function(){this.deserialize(e.json)}})}}))});