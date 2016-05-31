
(function() {

    tinymce.create('tinymce.plugins.ytp_button', {
        init : function(ed, url) {
            var ytp_button_properties = {
                title : 'Insert YouTube Playlist',
                //image : url+'/../images/icon.jpg',
               // icon: 'ytp-icon-video-alt3',
                onclick : function() {
                    tb_show("Insert YouTube Playlist", url+"/../lib/tinymce/popup.php?");
                    tinymce.DOM.setStyle('TB_window', 'height', '400');
                }
            };

            if(typeof(ytp_admin_options) !== typeof(undefined) && ytp_admin_options.use_tinymce_icon == 1) {
                // use icon
                ytp_button_properties.icon = 'ytp-icon-video-alt3';
            }else {
                // use image
                ytp_button_properties.image = url+'/../images/icon.jpg';
            }
            ed.addButton('ytp_button', ytp_button_properties);
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Insert YouTube Playlist",
                author : 'Rik de Vos',
                authorurl : 'http://rikdevos.com/',
                infourl : 'http://rikdevos.com/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('ytp_button', tinymce.plugins.ytp_button);
    /*
    function timecodeClick(name) {
         tinymce.execCommand('mceInsertContent', false, '[timetable name="'+name+'"]');
    }*/

})();



