/**
 * Created by Admin on 10/3/2017.
 */
revslider_migrate_jquery();

function revslider_migrate_jquery() {
    for(var k in jQuery_backup)
    {
        if(typeof jQuery[k] === 'undefined')
            jQuery[k] = jQuery_backup[k];
    }
    for(k in jQuery_backup.fn)
    {
        if(typeof jQuery.fn[k] === 'undefined')
            jQuery.fn[k] = jQuery_backup.fn[k];
    }
}